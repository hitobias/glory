<?php
/**
 * Download missing attachment files from the live glory.org.tw site.
 * Run inside WordPress container: php /tmp/download-attachments.php
 */

// Bootstrap WordPress
define('ABSPATH', '/var/www/html/');
define('WPINC', 'wp-includes');
require_once ABSPATH . 'wp-load.php';

$live_base = 'https://www.glory.org.tw/wp-content/uploads/';
$local_base = ABSPATH . 'wp-content/uploads/';

// Query all image attachments
$attachments = new WP_Query([
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_status'    => 'inherit',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$total     = $attachments->found_posts;
$downloaded = 0;
$skipped   = 0;
$failed    = 0;
$count     = 0;

echo "Found {$total} image attachments. Starting download...\n";

while ($attachments->have_posts()) {
    $attachments->the_post();
    $count++;

    $meta = wp_get_attachment_metadata(get_the_ID());
    $file = get_post_meta(get_the_ID(), '_wp_attached_file', true);

    if (empty($file)) {
        $failed++;
        continue;
    }

    $local_path = $local_base . $file;

    // Skip if already exists
    if (file_exists($local_path)) {
        $skipped++;
        if ($count % 100 === 0) {
            echo "Progress: {$count}/{$total} (downloaded: {$downloaded}, skipped: {$skipped}, failed: {$failed})\n";
        }
        continue;
    }

    // Create directory
    $dir = dirname($local_path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    // Build URL - encode each path segment separately
    $segments = explode('/', $file);
    $encoded = array_map('rawurlencode', $segments);
    $url = $live_base . implode('/', $encoded);

    // Download with curl
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code === 200 && !empty($data) && strlen($data) > 100) {
        file_put_contents($local_path, $data);
        $downloaded++;

        // Also try to download common thumbnail sizes
        if (!empty($meta['sizes'])) {
            $dir_part = dirname($file);
            foreach ($meta['sizes'] as $size_data) {
                if (empty($size_data['file'])) continue;
                $thumb_file = $dir_part . '/' . $size_data['file'];
                $thumb_local = $local_base . $thumb_file;
                if (file_exists($thumb_local)) continue;

                $thumb_segments = explode('/', $thumb_file);
                $thumb_encoded = array_map('rawurlencode', $thumb_segments);
                $thumb_url = $live_base . implode('/', $thumb_encoded);

                $ch2 = curl_init($thumb_url);
                curl_setopt_array($ch2, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_TIMEOUT        => 15,
                    CURLOPT_CONNECTTIMEOUT => 5,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0',
                    CURLOPT_SSL_VERIFYPEER => false,
                ]);
                $thumb_data = curl_exec($ch2);
                $thumb_code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                curl_close($ch2);

                if ($thumb_code === 200 && !empty($thumb_data) && strlen($thumb_data) > 100) {
                    file_put_contents($thumb_local, $thumb_data);
                }
            }
        }
    } else {
        $failed++;
    }

    if ($count % 50 === 0) {
        echo "Progress: {$count}/{$total} (downloaded: {$downloaded}, skipped: {$skipped}, failed: {$failed})\n";
    }

    // Small delay to avoid hammering the server
    usleep(100000); // 100ms
}

wp_reset_postdata();

echo "\n=== COMPLETE ===\n";
echo "Total: {$total}\n";
echo "Downloaded: {$downloaded}\n";
echo "Skipped (exists): {$skipped}\n";
echo "Failed: {$failed}\n";
