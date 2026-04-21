<?php
/**
 * Template Part: Theme Switcher (Preview Only)
 *
 * Floating widget for live-previewing alternate color themes.
 * Saves user's choice to localStorage. Default = green (Glory brand).
 *
 * TO REMOVE: delete the get_template_part('template-parts/theme-switcher')
 * call from footer.php, or delete this file.
 *
 * @package GloryTheme
 */

defined('ABSPATH') || exit;
?>

<!-- ========== Theme Switcher Widget (preview only) ========== -->
<div id="gl-theme-switcher" class="gl-theme-switcher" data-theme-switcher>
    <button class="gl-ts__toggle" data-ts-toggle aria-label="切換色系預覽" aria-expanded="false">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8"/>
            <path d="M12 2a10 10 0 0 0 0 20V2z" fill="currentColor"/>
        </svg>
        <span class="gl-ts__toggle-label">色系</span>
    </button>

    <div class="gl-ts__panel" data-ts-panel aria-hidden="true">
        <div class="gl-ts__header">
            <div class="gl-ts__title">色系預覽 · Preview</div>
            <div class="gl-ts__subtitle">即時切換,刷新頁面會保留</div>
        </div>

        <div class="gl-ts__options">
            <button class="gl-ts__option" data-theme="green">
                <span class="gl-ts__swatch">
                    <span style="background:#195630"></span>
                    <span style="background:#fcc800"></span>
                    <span style="background:#f4eee0"></span>
                </span>
                <span class="gl-ts__label">
                    <strong>深綠 · 現行</strong>
                    <em>品牌傳統色</em>
                </span>
            </button>

            <button class="gl-ts__option" data-theme="charcoal">
                <span class="gl-ts__swatch">
                    <span style="background:#222520"></span>
                    <span style="background:#fcc800"></span>
                    <span style="background:#faf9f6"></span>
                </span>
                <span class="gl-ts__label">
                    <strong>墨黑 · 編輯質感</strong>
                    <em>Charity:Water 風</em>
                </span>
            </button>

            <button class="gl-ts__option" data-theme="wine">
                <span class="gl-ts__swatch">
                    <span style="background:#6b2818"></span>
                    <span style="background:#fcc800"></span>
                    <span style="background:#fbf6f1"></span>
                </span>
                <span class="gl-ts__label">
                    <strong>酒紅 · 人文沉靜</strong>
                    <em>書香氣,台灣獨家</em>
                </span>
            </button>

            <button class="gl-ts__option" data-theme="navy">
                <span class="gl-ts__swatch">
                    <span style="background:#1a3558"></span>
                    <span style="background:#fcc800"></span>
                    <span style="background:#f5f7fa"></span>
                </span>
                <span class="gl-ts__label">
                    <strong>深藍 · 可信專業</strong>
                    <em>機構、學術感</em>
                </span>
            </button>
        </div>

        <div class="gl-ts__footer">
            目前色系 · <strong data-ts-current>深綠</strong>
        </div>
    </div>
</div>

<style>
.gl-theme-switcher {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    font-family: -apple-system, "PingFang TC", "Microsoft JhengHei", sans-serif;
}

.gl-ts__toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    color: #2a3548;
    border: 1px solid rgba(42, 53, 72, 0.08);
    border-radius: 999px;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08),
                0 2px 6px rgba(0, 0, 0, 0.04);
    transition: transform 0.15s, box-shadow 0.2s;
}
.gl-ts__toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12),
                0 3px 8px rgba(0, 0, 0, 0.06);
}
.gl-ts__toggle svg {
    color: var(--theme-primary, #195630);
    flex-shrink: 0;
    transition: transform 0.3s;
}
.gl-theme-switcher.is-open .gl-ts__toggle svg {
    transform: rotate(180deg);
}
.gl-ts__toggle-label { letter-spacing: 0.05em; }

.gl-ts__panel {
    position: absolute;
    bottom: calc(100% + 12px);
    right: 0;
    width: 280px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12),
                0 6px 16px rgba(0, 0, 0, 0.06);
    padding: 16px;
    opacity: 0;
    transform: translateY(8px);
    pointer-events: none;
    transition: opacity 0.2s, transform 0.2s;
    border: 1px solid rgba(42, 53, 72, 0.06);
}
.gl-theme-switcher.is-open .gl-ts__panel {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.gl-ts__header {
    padding: 4px 8px 14px;
    border-bottom: 1px solid rgba(42, 53, 72, 0.06);
    margin-bottom: 8px;
}
.gl-ts__title {
    font-size: 14px;
    font-weight: 700;
    color: #2a3548;
    margin-bottom: 2px;
}
.gl-ts__subtitle {
    font-size: 11px;
    color: #8fa0b8;
    letter-spacing: 0.02em;
}

.gl-ts__options {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.gl-ts__option {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 10px 8px;
    background: transparent;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    text-align: left;
    transition: background 0.15s;
    font-family: inherit;
}
.gl-ts__option:hover {
    background: rgba(42, 53, 72, 0.04);
}
.gl-ts__option.is-active {
    background: rgba(42, 53, 72, 0.06);
}
.gl-ts__option.is-active::after {
    content: "✓";
    margin-left: auto;
    color: var(--theme-primary, #195630);
    font-weight: 700;
    font-size: 14px;
}

.gl-ts__swatch {
    display: inline-flex;
    width: 52px;
    height: 32px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 1px 2px rgba(0,0,0,0.08);
}
.gl-ts__swatch span {
    flex: 1;
    display: block;
}

.gl-ts__label {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 0;
}
.gl-ts__label strong {
    font-size: 13px;
    font-weight: 600;
    color: #2a3548;
    line-height: 1.3;
    margin-bottom: 2px;
}
.gl-ts__label em {
    font-style: normal;
    font-size: 11px;
    color: #8fa0b8;
    letter-spacing: 0.02em;
}

.gl-ts__footer {
    padding: 10px 8px 4px;
    margin-top: 8px;
    border-top: 1px solid rgba(42, 53, 72, 0.06);
    font-size: 11px;
    color: #8fa0b8;
    letter-spacing: 0.03em;
    text-align: center;
}
.gl-ts__footer strong {
    color: #2a3548;
    font-weight: 700;
    letter-spacing: 0.05em;
}

/* Mobile — shrink to icon-only */
@media (max-width: 640px) {
    .gl-ts__toggle-label { display: none; }
    .gl-ts__toggle { padding: 10px; }
    .gl-ts__panel { width: calc(100vw - 32px); right: 0; max-width: 320px; }
    .gl-theme-switcher { bottom: 16px; right: 16px; }
}
</style>

<script>
(function() {
    var STORAGE_KEY = 'glory.theme';
    var VALID = ['green', 'charcoal', 'wine', 'navy'];
    var LABELS = { green: '深綠', charcoal: '墨黑', wine: '酒紅', navy: '深藍' };

    function getTheme() {
        try {
            var t = localStorage.getItem(STORAGE_KEY);
            return VALID.indexOf(t) > -1 ? t : 'green';
        } catch (e) { return 'green'; }
    }

    function applyTheme(theme) {
        var body = document.body;
        VALID.forEach(function(t) { body.classList.remove('theme-' + t); });
        body.classList.add('theme-' + theme);
        try { localStorage.setItem(STORAGE_KEY, theme); } catch (e) {}

        // Update active state on buttons
        document.querySelectorAll('[data-theme]').forEach(function(btn) {
            btn.classList.toggle('is-active', btn.dataset.theme === theme);
        });
        var label = document.querySelector('[data-ts-current]');
        if (label) label.textContent = LABELS[theme] || theme;
    }

    // Apply stored theme on load
    var initial = getTheme();
    applyTheme(initial);

    document.addEventListener('DOMContentLoaded', function() {
        var widget = document.querySelector('[data-theme-switcher]');
        if (!widget) return;

        var toggle = widget.querySelector('[data-ts-toggle]');
        var panel = widget.querySelector('[data-ts-panel]');

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = widget.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        });

        // Click outside to close
        document.addEventListener('click', function(e) {
            if (!widget.contains(e.target)) {
                widget.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
            }
        });

        // Escape to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                widget.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
            }
        });

        // Theme option clicks
        widget.querySelectorAll('[data-theme]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                applyTheme(btn.dataset.theme);
            });
        });

        // Re-sync active state on open (panel is populated at load, but rerun for safety)
        applyTheme(getTheme());
    });

    // Apply theme BEFORE DOM ready to prevent flash — inline body class
    // (This runs during script execution, before DOMContentLoaded)
})();
</script>
