<?php
/**
 * Migrate Qubely Calendar Data → glory_event CPT
 *
 * Parses the old calendar page (ID 9374) which uses Qubely tabs blocks
 * with paragraphs in the format "M/DD　description", and creates
 * glory_event posts with _glory_event_date meta.
 *
 * Usage (inside Docker container):
 *   wp --allow-root eval-file /var/www/html/wp-content/themes/glory-theme/../../scripts/migrate-calendar.php
 *
 * Or via the wrapper shell script:
 *   ./scripts/migrate-calendar.sh [--dry-run]
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

// ---------- Configuration ----------

$calendar_page_id = 9374;
$dry_run          = in_array('--dry-run', $argv ?? [], true);
$post_type        = 'glory_event';
$meta_key         = '_glory_event_date';

// ---------- Helpers ----------

/**
 * Extract plain text from an HTML paragraph, stripping tags and decoding entities.
 */
function glory_strip_paragraph(string $html): string {
    $text = strip_tags($html);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = str_replace("\xC2\xA0", ' ', $text); // &nbsp;
    return trim($text);
}

/**
 * Parse a single event line like "1/04　得榮少年獎助學金..." into [month, day, description].
 * Returns null if the line is a continuation or not parseable.
 *
 * Supported formats:
 *   M/DD　description
 *   M/DD description
 *   M/DD-DD description  (multi-day → uses first day)
 *   M/DD ~ M/DD description (range → uses first day)
 */
function glory_parse_event_line(string $text): ?array {
    // Normalize various whitespace chars (full-width space, tabs, multiple spaces)
    $text = preg_replace('/[\x{3000}\t]+/u', ' ', $text);
    $text = preg_replace('/\s{2,}/', ' ', $text);
    $text = trim($text);

    if ($text === '' || $text === '待更新') {
        return null;
    }

    // Match: M/DD or MM/DD at the start, followed by separator and description
    // Also handles M/DD-DD and M/DD ~ M/DD patterns
    if (preg_match('/^(\d{1,2})\/(\d{1,2})(?:\s*[-~]\s*\d{1,2}(?:\/\d{1,2})?)?\s+(.+)$/u', $text, $m)) {
        $month = (int) $m[1];
        $day   = (int) $m[2];
        $desc  = trim($m[3]);

        if ($month >= 1 && $month <= 12 && $day >= 1 && $day <= 31 && $desc !== '') {
            return [$month, $day, $desc];
        }
    }

    return null;
}

// ---------- Main ----------

WP_CLI::log('');
WP_CLI::log('=== Qubely Calendar → glory_event Migration ===');
WP_CLI::log('');

if ($dry_run) {
    WP_CLI::log('*** DRY RUN — no posts will be created ***');
    WP_CLI::log('');
}

// 1. Load the calendar page content
$page = get_post($calendar_page_id);
if (!$page) {
    WP_CLI::error("Calendar page (ID {$calendar_page_id}) not found.");
}

$content = $page->post_content;
WP_CLI::log("Loaded calendar page: \"{$page->post_title}\" (ID {$calendar_page_id}, " . strlen($content) . " bytes)");

// 2. Split content into year sections by <h2>YYYY年大事記</h2> headings
//    Each section: heading → qubely/tabs block with 12 month tabs
$year_sections = preg_split(
    '/<!-- wp:heading[^>]*-->.*?<h2[^>]*>(\d{4})年大事記<\/h2>.*?<!-- \/wp:heading -->/su',
    $content,
    -1,
    PREG_SPLIT_DELIM_CAPTURE
);

// $year_sections: [preamble, year1, content1, year2, content2, ...]
$events_by_year = [];
for ($i = 1; $i < count($year_sections); $i += 2) {
    $year    = (int) $year_sections[$i];
    $section = $year_sections[$i + 1] ?? '';
    $events_by_year[$year] = $section;
}

if (empty($events_by_year)) {
    WP_CLI::error('No year sections found in the calendar page content.');
}

WP_CLI::log('Found year sections: ' . implode(', ', array_keys($events_by_year)));
WP_CLI::log('');

// 3. Parse each year section — extract tab contents (months 1-12)
$total_created  = 0;
$total_skipped  = 0;
$total_dupes    = 0;
$total_cont     = 0; // continuation lines merged

foreach ($events_by_year as $year => $section_html) {
    WP_CLI::log("--- {$year}年 ---");

    // Extract each qubely/tab block's inner content
    // Tab blocks look like: <!-- wp:qubely/tab {"id":N,...} --> <div ...>CONTENT</div> <!-- /wp:qubely/tab -->
    // The first tab has no "id" attribute, tabs 2-12 have "id":2 through "id":12
    preg_match_all(
        '/<!-- wp:qubely\/tab\s+(\{[^}]*\})\s*-->\s*<div[^>]*>(.*?)<\/div>\s*<!-- \/wp:qubely\/tab -->/su',
        $section_html,
        $tab_matches,
        PREG_SET_ORDER
    );

    if (empty($tab_matches)) {
        WP_CLI::warning("  No Qubely tab blocks found for {$year}.");
        continue;
    }

    $year_count = 0;

    foreach ($tab_matches as $tab_idx => $tab_match) {
        $tab_json  = $tab_match[1];
        $tab_html  = $tab_match[2];
        $tab_attrs = json_decode($tab_json, true);

        // Determine month: first tab has no "id" → month 1; others use "id" field
        $month = isset($tab_attrs['id']) ? (int) $tab_attrs['id'] : 1;

        if ($month < 1 || $month > 12) {
            WP_CLI::warning("  Skipping invalid month index: {$month}");
            continue;
        }

        // Extract all paragraph text from the tab
        preg_match_all('/<p[^>]*>(.*?)<\/p>/su', $tab_html, $p_matches);

        if (empty($p_matches[1])) {
            continue;
        }

        // Parse paragraphs, merging continuation lines (those starting with full-width spaces)
        $raw_lines = array_map('glory_strip_paragraph', $p_matches[1]);
        $merged_lines = [];

        foreach ($raw_lines as $line) {
            if ($line === '') {
                continue;
            }

            // Continuation line: starts with full-width spaces or lots of regular spaces (no date prefix)
            $is_continuation = (
                !empty($merged_lines)
                && !preg_match('/^\d{1,2}\/\d{1,2}/', $line)
            );

            if ($is_continuation) {
                // Append to previous line's description
                $last_idx = count($merged_lines) - 1;
                $merged_lines[$last_idx] .= $line;
                $total_cont++;
            } else {
                $merged_lines[] = $line;
            }
        }

        // Parse each merged line into an event
        foreach ($merged_lines as $line) {
            $parsed = glory_parse_event_line($line);
            if ($parsed === null) {
                // Lines without dates (e.g., "得榮少年教育專案審件")
                // Try to create an event without a specific day (use day=1 as fallback)
                $clean = preg_replace('/[\x{3000}\t\s]+/u', ' ', trim($line));
                if ($clean !== '' && $clean !== '待更新') {
                    $parsed = [$month, 0, $clean]; // day=0 means no specific day
                }
            }

            if ($parsed === null) {
                $total_skipped++;
                continue;
            }

            [$evt_month, $evt_day, $evt_desc] = $parsed;

            // Build the date string
            if ($evt_day > 0) {
                $date_str = sprintf('%04d-%02d-%02d', $year, $evt_month, $evt_day);
            } else {
                // No specific day — use the 1st of the month
                $date_str = sprintf('%04d-%02d-01', $year, $evt_month);
                $evt_desc = '※ ' . $evt_desc; // Mark as approximate date
            }

            // Validate date
            if (!checkdate($evt_month, max($evt_day, 1), $year)) {
                WP_CLI::warning("  Invalid date: {$date_str} — skipping \"{$evt_desc}\"");
                $total_skipped++;
                continue;
            }

            // Check for duplicates (same title + date)
            $existing = get_posts([
                'post_type'   => $post_type,
                'post_status' => 'any',
                'title'       => $evt_desc,
                'meta_key'    => $meta_key,
                'meta_value'  => $date_str,
                'numberposts' => 1,
            ]);

            if (!empty($existing)) {
                $total_dupes++;
                continue;
            }

            if ($dry_run) {
                WP_CLI::log("  [DRY] {$date_str} — {$evt_desc}");
                $year_count++;
                $total_created++;
                continue;
            }

            // Create the glory_event post
            $post_id = wp_insert_post([
                'post_type'   => $post_type,
                'post_title'  => $evt_desc,
                'post_status' => 'publish',
                'post_date'   => $date_str . ' 00:00:00',
            ], true);

            if (is_wp_error($post_id)) {
                WP_CLI::warning("  Failed to create: {$evt_desc} — " . $post_id->get_error_message());
                $total_skipped++;
                continue;
            }

            update_post_meta($post_id, $meta_key, $date_str);

            $year_count++;
            $total_created++;
        }
    }

    WP_CLI::log("  → {$year}: {$year_count} events");
}

// 4. Summary
WP_CLI::log('');
WP_CLI::log('=== Migration Summary ===');
WP_CLI::log("  Created:      {$total_created}");
WP_CLI::log("  Duplicates:   {$total_dupes} (skipped)");
WP_CLI::log("  Skipped:      {$total_skipped} (empty/unparseable)");
WP_CLI::log("  Merged lines: {$total_cont} (continuation lines joined)");
WP_CLI::log('');

if ($dry_run) {
    WP_CLI::log('Re-run without --dry-run to create the posts.');
} else {
    // Verify final count
    $final_count = wp_count_posts($post_type);
    $published   = $final_count->publish ?? 0;
    WP_CLI::success("Done. Total published glory_event posts: {$published}");
}
