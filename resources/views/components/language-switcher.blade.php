@php
    $localization = app(\App\Support\Localization::class);
    $currentLocale = $localization->getCurrentLocale();
    $supportedLocales = $localization->getSupportedLocales();
    $currentPath = request()->path();
@endphp

<div class="lang-switcher-dropdown">
    <button type="button" class="lang-switcher-trigger" aria-expanded="false" aria-haspopup="true" aria-label="{{ __('common.select_language') }}">
        <img src="{{ asset('assets/img/flags/' . ($currentLocale === 'en' ? 'united-kingdom' : 'egypt') . '.png') }}" alt="" class="lang-flag" width="24" height="18">
        <span class="lang-code">{{ strtoupper($currentLocale) }}</span>
        <i class="bi bi-chevron-down lang-chevron" aria-hidden="true"></i>
    </button>
    <div class="lang-switcher-menu" role="menu" aria-hidden="true">
        @foreach($supportedLocales as $locale)
            @if($locale !== $currentLocale)
                <form method="POST" action="{{ route('locale.switch') }}" role="none" class="lang-switcher-form">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $locale }}">
                    <input type="hidden" name="current_path" value="{{ $currentPath }}">
                    <button type="submit" class="lang-switcher-option" role="menuitem">
                        <img src="{{ asset('assets/img/flags/' . ($locale === 'en' ? 'united-kingdom' : 'egypt') . '.png') }}" alt="" class="lang-flag" width="24" height="18">
                        <span>{{ $localization->getLocaleName($locale) }}</span>
                    </button>
                </form>
            @endif
        @endforeach
    </div>
</div>

<style>
.lang-switcher-dropdown {
    position: relative;
    margin-left: 1rem;
}
.lang-switcher-trigger {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 0.75rem;
    background: var(--surface-color, #fff);
    border: 1px solid rgba(0,0,0,.1);
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.9rem;
    color: var(--nav-color, #666);
    transition: border-color .2s, color .2s, box-shadow .2s;
}
.lang-switcher-trigger:hover {
    color: var(--nav-hover-color, #000);
    border-color: rgba(0,0,0,.2);
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.lang-switcher-trigger .lang-flag {
    flex-shrink: 0;
    border-radius: 2px;
    object-fit: cover;
}
.lang-switcher-trigger .lang-code {
    font-weight: 600;
    min-width: 1.5rem;
}
.lang-switcher-trigger .lang-chevron {
    font-size: 0.7rem;
    transition: transform .2s;
}
/* Improve touch on mobile - remove 300ms delay */
.lang-switcher-trigger {
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
}
.lang-switcher-dropdown.is-open .lang-switcher-trigger .lang-chevron {
    transform: rotate(180deg);
}
.lang-switcher-menu {
    position: absolute;
    top: calc(100% + 6px);
    right: 0;
    left: auto;
    min-width: 160px;
    padding: 0.35rem;
    background: var(--nav-dropdown-background-color, #fff);
    border: 1px solid rgba(0,0,0,.08);
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0,0,0,.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-6px);
    transition: opacity .2s, visibility .2s, transform .2s;
    z-index: 1100;
}
.lang-switcher-dropdown.is-open .lang-switcher-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.lang-switcher-form {
    margin: 0;
}
.lang-switcher-option {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: none;
    border-radius: 6px;
    background: transparent;
    cursor: pointer;
    font-size: 0.9rem;
    color: var(--nav-dropdown-color, #666);
    text-align: left;
    transition: background .15s, color .15s;
}
.lang-switcher-option:hover {
    background: rgba(0,0,0,.05);
    color: var(--nav-dropdown-hover-color, #313131);
}
.lang-switcher-option .lang-flag {
    border-radius: 2px;
    object-fit: cover;
}
[dir="rtl"] .lang-switcher-menu {
    right: auto;
    left: 0;
}
[dir="rtl"] .lang-switcher-option {
    text-align: right;
}
/* Mobile: dropdown escapes overflow by using fixed positioning */
@media (max-width: 1199px) {
    .lang-switcher-mobile-item .lang-switcher-dropdown .lang-switcher-menu {
        z-index: 10002;
    }
    .lang-switcher-mobile-item .lang-switcher-dropdown.is-open .lang-switcher-menu {
        position: fixed;
        top: auto;
        left: 20px;
        right: 20px;
        width: auto;
        min-width: 0;
        z-index: 10002;
    }
}
</style>

<script>
(function() {
    function initLangSwitcher() {
        document.querySelectorAll('.lang-switcher-dropdown').forEach(function(dropdown) {
            var trigger = dropdown.querySelector('.lang-switcher-trigger');
            var menu = dropdown.querySelector('.lang-switcher-menu');
            if (!trigger || !menu || dropdown.dataset.langInit) return;
            dropdown.dataset.langInit = '1';

            var isMobileItem = dropdown.closest('.lang-switcher-mobile-item');

            function open() {
                dropdown.classList.add('is-open');
                menu.setAttribute('aria-hidden', 'false');
                trigger.setAttribute('aria-expanded', 'true');
                if (isMobileItem) {
                    var rect = trigger.getBoundingClientRect();
                    menu.style.position = 'fixed';
                    menu.style.top = (rect.bottom + 6) + 'px';
                    menu.style.left = Math.max(20, rect.left) + 'px';
                    menu.style.right = 'auto';
                    menu.style.width = Math.min(Math.max(rect.width, 160), 280) + 'px';
                }
            }
            function close() {
                dropdown.classList.remove('is-open');
                menu.setAttribute('aria-hidden', 'true');
                trigger.setAttribute('aria-expanded', 'false');
                if (isMobileItem) {
                    menu.style.position = '';
                    menu.style.top = '';
                    menu.style.left = '';
                    menu.style.right = '';
                    menu.style.width = '';
                }
            }

            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                if (dropdown.classList.contains('is-open')) close(); else open();
            });

            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target)) close();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') close();
            });
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLangSwitcher);
    } else {
        initLangSwitcher();
    }
})();
</script>
