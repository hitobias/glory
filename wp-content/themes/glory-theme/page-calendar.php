<?php
/**
 * Page Template: 行事曆
 * Slug: calendar (Page ID: 9374)
 *
 * Queries glory_event CPT and renders a year-accordion + month-tabs UI.
 * Events are managed via WP Admin → 行事曆 → 新增活動.
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;

get_header();

/*
 * ---------- Query all events, grouped by year → month ----------
 */
$months_labels = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
$months_short  = ['01','02','03','04','05','06','07','08','09','10','11','12'];

$all_events = get_posts([
    'post_type'      => 'glory_event',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => '_glory_event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
]);

// Group by year → month
$years_data = [];
foreach ($all_events as $evt) {
    $date = get_post_meta($evt->ID, '_glory_event_date', true);
    if (!$date || !preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $dm)) {
        continue;
    }
    $year  = $dm[1];
    $month = (int) $dm[2] - 1; // 0-indexed
    $day   = $dm[3];

    if (!isset($years_data[$year])) {
        $years_data[$year] = array_fill(0, 12, []);
    }

    $years_data[$year][$month][] = [
        'date' => ((int) $dm[2]) . '/' . $day,
        'desc' => get_the_title($evt),
    ];
}

// Sort years descending (newest first)
krsort($years_data);
?>

<main id="main-content" class="site-main">

    <!-- Hero -->
    <section class="bg-gradient-to-br from-accent-green to-dark py-12 md:py-16">
        <div class="container-content text-center">
            <h1 class="text-h2 md:text-h1 text-white mb-2" data-animate="fade-up">
                <?php echo glory_get_icon('calendar', 'w-8 h-8 md:w-10 md:h-10 inline-block mr-2 align-middle'); ?>
                得榮基金會行事曆
            </h1>
            <p class="text-white/80 text-body md:text-body-lg" data-animate="fade-up">
                基金會年度活動與重要事記一覽
            </p>
        </div>
    </section>

    <!-- Calendar -->
    <section class="section">
        <div class="container-content max-w-5xl">

            <?php if (empty($years_data)) : ?>
                <p class="text-center text-dark-400 py-12">目前沒有行事曆資料。</p>
            <?php else : ?>

                <?php $y_idx = 0; foreach ($years_data as $year => $months) :
                    $is_first = ($y_idx === 0);

                    // Count total events for the year
                    $total = 0;
                    foreach ($months as $m) { $total += count($m); }
                ?>

                <div class="calendar-year <?php echo $y_idx > 0 ? 'mt-6' : ''; ?>" data-animate="fade-up">

                    <!-- Year Header -->
                    <button
                        class="w-full flex items-center justify-between rounded-2xl px-6 py-5 transition-all duration-300 group
                               <?php echo $is_first
                                   ? 'bg-gradient-to-r from-accent-green to-accent-green/80 text-white shadow-lg'
                                   : 'bg-white border border-gray-200 hover:border-accent-green/40 hover:shadow-md'; ?>"
                        aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                        data-year-toggle
                    >
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                        <?php echo $is_first ? 'bg-white/20' : 'bg-accent-green/10'; ?>">
                                <?php echo glory_get_icon('calendar', 'w-6 h-6 ' . ($is_first ? 'text-white' : 'text-accent-green')); ?>
                            </div>
                            <div class="text-left">
                                <h2 class="text-h3 m-0 <?php echo $is_first ? 'text-white' : 'text-dark'; ?>"><?php echo esc_html($year); ?>年大事記</h2>
                                <span class="text-sm <?php echo $is_first ? 'text-white/70' : 'text-dark-400'; ?>">共 <?php echo $total; ?> 筆活動紀錄</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 transition-transform duration-300 <?php echo $is_first ? 'text-white rotate-180' : 'text-dark-400'; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Year Body -->
                    <div class="calendar-year-body <?php echo $is_first ? '' : 'hidden'; ?> mt-5">

                        <!-- Month Tabs — horizontal scroll on mobile -->
                        <div class="relative">
                            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide" role="tablist" aria-label="<?php echo esc_attr($year); ?>年月份">
                                <?php foreach ($months_labels as $m_idx => $label) :
                                    $has_events = !empty($months[$m_idx]);
                                    $event_count = count($months[$m_idx]);
                                    $tab_id = "tab-{$year}-{$m_idx}";
                                    $panel_id = "panel-{$year}-{$m_idx}";
                                    $is_active = ($m_idx === 0);
                                ?>
                                    <button
                                        role="tab"
                                        id="<?php echo $tab_id; ?>"
                                        aria-controls="<?php echo $panel_id; ?>"
                                        aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                                        class="calendar-tab flex-shrink-0 flex flex-col items-center gap-1 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 border-2
                                            <?php if ($is_active) : ?>
                                                border-accent-green bg-accent-green text-white shadow-md
                                            <?php elseif ($has_events) : ?>
                                                border-gray-200 bg-white text-dark-600 hover:border-accent-green/40 hover:bg-accent-green-50
                                            <?php else : ?>
                                                border-gray-100 bg-gray-50 text-dark-300
                                            <?php endif; ?>"
                                        data-month-tab="<?php echo $m_idx; ?>"
                                        data-year-group="<?php echo esc_attr($year); ?>"
                                    >
                                        <span class="text-xs opacity-70"><?php echo $months_short[$m_idx]; ?></span>
                                        <span class="font-bold"><?php echo esc_html($label); ?></span>
                                        <?php if ($has_events) : ?>
                                            <span class="text-[0.65rem] leading-none px-1.5 py-0.5 rounded-full
                                                <?php echo $is_active ? 'bg-white/25 text-white' : 'bg-accent-green/10 text-accent-green'; ?>">
                                                <?php echo $event_count; ?>
                                            </span>
                                        <?php endif; ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Month Panels -->
                        <?php foreach ($months_labels as $m_idx => $label) :
                            $events = $months[$m_idx];
                            $tab_id = "tab-{$year}-{$m_idx}";
                            $panel_id = "panel-{$year}-{$m_idx}";
                        ?>
                            <div
                                role="tabpanel"
                                id="<?php echo $panel_id; ?>"
                                aria-labelledby="<?php echo $tab_id; ?>"
                                class="calendar-panel mt-5 <?php echo ($m_idx === 0) ? '' : 'hidden'; ?>"
                                data-month-panel="<?php echo $m_idx; ?>"
                                data-year-group="<?php echo esc_attr($year); ?>"
                            >
                                <?php if (empty($events)) : ?>
                                    <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                        <?php echo glory_get_icon('calendar', 'w-10 h-10 mx-auto mb-3 text-dark-200'); ?>
                                        <p class="text-dark-400 text-body-sm">本月暫無活動紀錄</p>
                                    </div>
                                <?php else : ?>
                                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                                        <!-- Panel Header -->
                                        <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-b border-gray-100">
                                            <h3 class="text-body font-bold text-dark m-0">
                                                <?php echo esc_html($year); ?>年 <?php echo esc_html($label); ?>
                                            </h3>
                                            <span class="text-xs text-dark-400 bg-white px-2.5 py-1 rounded-full border border-gray-200">
                                                <?php echo count($events); ?> 筆活動
                                            </span>
                                        </div>
                                        <!-- Events List -->
                                        <div class="divide-y divide-gray-50">
                                            <?php foreach ($events as $e_idx => $event) : ?>
                                                <div class="flex items-start gap-4 px-6 py-4 hover:bg-accent-green-50/30 transition-colors <?php echo ($e_idx % 2 === 1) ? 'bg-gray-50/50' : ''; ?>">
                                                    <?php if (!empty($event['date'])) : ?>
                                                        <span class="flex-shrink-0 w-14 text-center py-1.5 rounded-lg bg-accent-green/10 text-accent-green text-sm font-bold">
                                                            <?php echo esc_html($event['date']); ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <span class="flex-shrink-0 w-14"></span>
                                                    <?php endif; ?>
                                                    <span class="text-dark-600 text-body-sm leading-relaxed pt-1"><?php echo esc_html($event['desc']); ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php $y_idx++; endforeach; ?>

            <?php endif; ?>

        </div>
    </section>

</main>

<script>
(function () {
  // Year accordion
  document.querySelectorAll('[data-year-toggle]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var body = btn.closest('.calendar-year').querySelector('.calendar-year-body');
      var arrow = btn.querySelector('svg');
      var expanded = btn.getAttribute('aria-expanded') === 'true';

      if (expanded) {
        body.classList.add('hidden');
        arrow.classList.remove('rotate-180');
        btn.setAttribute('aria-expanded', 'false');
      } else {
        body.classList.remove('hidden');
        arrow.classList.add('rotate-180');
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // Month tabs
  document.querySelectorAll('[data-month-tab]').forEach(function (tab) {
    tab.addEventListener('click', function () {
      var yearGroup = tab.dataset.yearGroup;
      var monthIdx = tab.dataset.monthTab;

      // Deactivate all tabs
      document.querySelectorAll('[data-month-tab][data-year-group="' + yearGroup + '"]').forEach(function (t) {
        t.classList.remove('border-accent-green', 'bg-accent-green', 'text-white', 'shadow-md');
        var badge = t.querySelector('span:last-child');
        var hasEvents = badge && badge.textContent.trim().match(/^\d+$/);
        if (hasEvents) {
          t.classList.add('border-gray-200', 'bg-white', 'text-dark-600');
          badge.classList.remove('bg-white/25', 'text-white');
          badge.classList.add('bg-accent-green/10', 'text-accent-green');
        } else {
          t.classList.add('border-gray-100', 'bg-gray-50', 'text-dark-300');
        }
        t.setAttribute('aria-selected', 'false');
      });

      // Activate clicked tab
      tab.classList.remove('border-gray-200', 'border-gray-100', 'bg-white', 'bg-gray-50', 'text-dark-600', 'text-dark-300');
      tab.classList.add('border-accent-green', 'bg-accent-green', 'text-white', 'shadow-md');
      tab.setAttribute('aria-selected', 'true');
      var badge = tab.querySelector('span:last-child');
      if (badge && badge.textContent.trim().match(/^\d+$/)) {
        badge.classList.remove('bg-accent-green/10', 'text-accent-green');
        badge.classList.add('bg-white/25', 'text-white');
      }

      // Switch panels
      document.querySelectorAll('[data-month-panel][data-year-group="' + yearGroup + '"]').forEach(function (p) {
        p.classList.add('hidden');
      });
      var panel = document.querySelector('[data-month-panel="' + monthIdx + '"][data-year-group="' + yearGroup + '"]');
      if (panel) panel.classList.remove('hidden');
    });
  });
})();
</script>

<?php get_footer(); ?>
