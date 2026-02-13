<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('home', ['locale' => $currentLocale]) }}" class="logo d-flex align-items-center">
        <h1 class="sitename">Gymivida</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}">{{ __('nav.home') }}</a></li>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}#about">{{ __('nav.about') }}</a></li>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}#services">{{ __('nav.services') }}</a></li>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}#pricing">{{ __('nav.pricing') }}</a></li>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}#system">{{ __('nav.system') }}</a></li>
          <li><a href="{{ route('home', ['locale' => $currentLocale]) }}#contact">{{ __('nav.contact') }}</a></li>
          <li class="lang-switcher-mobile-item d-xl-none">
            @include('components.language-switcher')
          </li>
        </ul>
        <div class="language-switcher-wrapper d-none d-xl-block">
          @include('components.language-switcher')
        </div>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
</header>
