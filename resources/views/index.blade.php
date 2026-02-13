@extends('layout.master')

@section('title', 'Gymivida')

@section('body-class', 'home-page')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 data-aos="fade-up" data-aos-delay="200">{{ __('hero.title') }}</h1>
              <p data-aos="fade-up" data-aos-delay="300">
                {{ __('hero.subtitle') }}
              </p>
              <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                <a href="#about" class="btn-primary">{{ __('hero.get_started') }}</a>
                @if($demoDocumentation && $demoDocumentation->file_path)
                  <a href="{{ $demoDocumentation->file_url }}" class="btn-secondary" download="{{ $demoDocumentation->file_name ?: basename($demoDocumentation->file_path) }}">
                    <i class="bi bi-download"></i>
                    {{ __('hero.download_demo') }}
                  </a>
                @endif
              </div>
              <div class="hero-stats" data-aos="fade-up" data-aos-delay="500">
                <div class="stat-item">
                  <div class="stat-number">100+</div>
                  <div class="stat-label">{{ __('hero.stats_gyms') }}</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">500+</div>
                  <div class="stat-label">{{ __('hero.stats_users') }}</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">200+</div>
                  <div class="stat-label">{{ __('hero.stats_services') }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="fade-left" data-aos-delay="300">
              <img src="{{ asset('assets/img/about/gymivida-about-2.png') }}" alt="Business Success" class="img-fluid">
              <div class="floating-card" data-aos="zoom-in" data-aos-delay="600">
                <div class="card-icon">
                  <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="card-content">
                  <h5>{{ __('hero.covered_cities') }}</h5>
                  <div class="growth-percentage">+20</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('about.subtitle') }}</span>
        <h2>{{ __('about.title') }}</h2>
        <p>
          {{ __('about.description') }}
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h2>{{ __('about.heading') }}</h2>
              <p class="lead">
                {{ __('about.lead') }}
              </p>
              
              <p>
                {{ __('about.paragraph1') }}
              </p>
              
              <p>
                {{ __('about.paragraph2') }}
              </p>

              <div class="stats-row">
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"></div>
                  <div class="stat-label">{{ __('about.years_experience') }}</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="850" data-purecounter-duration="1"></div>
                  <div class="stat-label">{{ __('about.projects_completed') }}</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="240" data-purecounter-duration="1"></div>
                  <div class="stat-label">{{ __('about.happy_clients') }}</div>
                </div>
              </div>

              <div class="cta-section">
                <a href="#contact" class="btn-outline">{{ __('about.meet_team') }}</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="image-wrapper">
              <img src="{{ asset('assets/img/about/gymivida-about-women.png') }}" alt="About Gymivida" class="img-fluid">
              <div class="floating-card" data-aos="zoom-in" data-aos-delay="500">
                <div class="card-content">
                  <div class="icon">
                    <i class="bi bi-award"></i>
                  </div>
                  <div class="text">
                    <h4>{{ __('about.award_winning') }}</h4>
                    <p>{{ __('about.award_description') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('services.subtitle') }}</span>
        <h2>{{ __('services.title') }}</h2>
        <p>
          {{ __('services.description') }}
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="services-slider swiper init-swiper" data-aos="fade-up" data-aos-delay="150">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 4000
              },
              "slidesPerView": 1,
              "spaceBetween": 30,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "breakpoints": {
                "768": {
                  "slidesPerView": 2
                },
                "1200": {
                  "slidesPerView": 3
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            @foreach($services as $index => $service)
              <div class="swiper-slide" data-aos="fade-up" data-aos-delay="{{ 200 + ($index % 3) * 100 }}">
                <div class="service-item">
                  <div class="service-icon">
                    <i class="{{ $service->icon }}"></i>
                  </div>
                  <h3>{{ $service->getTranslation('title', app()->getLocale()) }}</h3>
                  <p>{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                </div>
              </div>
            @endforeach
          </div>

          <div class="swiper-navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Services Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('why_us.subtitle') }}</span>
        <h2>{{ __('why_us.title') }}</h2>
        <p>
          {{ __('why_us.description') }}
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h2>{{ __('why_us.heading') }}</h2>
              <p>
                {{ __('why_us.paragraph') }}
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="image-wrapper">
              <img src="{{ asset('assets/img/about/gymivida-about.png') }}" alt="Gymivida platform dashboard" class="img-fluid">
            </div>
          </div>
        </div>

        <div class="features-grid" data-aos="fade-up" data-aos-delay="400">
          <div class="row g-5">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="feature-item">
                <div class="icon-wrapper">
                  <i class="bi bi-lightbulb"></i>
                </div>
                <div class="feature-content">
                  <h3>{{ __('why_us.smart_scalable') }}</h3>
                  <p>
                    {{ __('why_us.smart_scalable_description') }}
                  </p>
                </div>
              </div>
            </div><!-- End Feature Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <div class="feature-item">
                <div class="icon-wrapper">
                  <i class="bi bi-award"></i>
                </div>
                <div class="feature-content">
                  <h3>{{ __('why_us.trusted_expertise') }}</h3>
                  <p>
                    {{ __('why_us.trusted_expertise_description') }}
                  </p>
                </div>
              </div>
            </div><!-- End Feature Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
              <div class="feature-item">
                <div class="icon-wrapper">
                  <i class="bi bi-headset"></i>
                </div>
                <div class="feature-content">
                  <h3>{{ __('why_us.responsive_support') }}</h3>
                  <p>
                    {{ __('why_us.responsive_support_description') }}
                  </p>
                </div>
              </div>
            </div><!-- End Feature Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
              <div class="feature-item">
                <div class="icon-wrapper">
                  <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="feature-content">
                  <h3>{{ __('why_us.maximum_efficiency') }}</h3>
                  <p>
                    {{ __('why_us.maximum_efficiency_description') }}
                  </p>
                </div>
              </div>
            </div><!-- End Feature Item -->

          </div>
        </div>

      </div>

    </section>
    <!-- /Why Us Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('pricing.subtitle') }}</span>
        <h2>{{ __('pricing.title') }}</h2>
        <p>
          {{ __('pricing.description') }}
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Billing Toggle -->
        <div class="pricing-toggle" data-aos="fade-up" data-aos-delay="200">
          <div class="toggle-wrapper">
            <span class="toggle-label" id="monthlyLabel">{{ __('pricing.monthly') }}</span>
            <label class="toggle-switch">
              <input type="checkbox" id="billingToggle">
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label" id="yearlyLabel">{{ __('pricing.yearly') }} <span class="badge">{{ __('pricing.save') }} {{ $averageDiscount ?? 17 }}%</span></span>
          </div>
        </div>

        <!-- No-Payment Trial Highlight -->
        <div class="pricing-trial-highlight" data-aos="fade-up" data-aos-delay="250">
          <div class="pricing-trial-highlight-inner">
            <i class="bi bi-shield-check"></i>
            <div class="pricing-trial-highlight-text">
              <strong>{{ __('pricing.no_payment_required') }}</strong>
            </div>
          </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="300">

          @foreach($products as $index => $product)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 300 + ($index * 100) }}">
              <div class="pricing-card {{ $product->name === 'Professional' ? 'featured' : '' }}">
                
                @if($product->getTranslation('name', 'en') === 'Professional')
                  <div class="featured-badge">{{ __('pricing.most_popular') }}</div>
                @endif

                <div class="pricing-header">
                  <h3>{{ $product->getTranslation('name', app()->getLocale()) }}</h3>
                  <p class="pricing-description">{{ $product->getTranslation('description', app()->getLocale()) }}</p>
                </div>

                <div class="pricing-price">
                  <div class="price-wrapper">
                    <span class="currency">{{ $product->currency }}</span>
                    <span class="amount monthly-price">{{ number_format($product->monthly_price, 0) }}</span>
                    <span class="amount yearly-price" style="display: none;">{{ number_format($product->yearly_price / 12, 0) }}</span>
                    <span class="period">
                      <span class="monthly-period">{{ __('pricing.month') }}</span>
                      <span class="yearly-period" style="display: none;">{{ __('pricing.month') }}</span>
                    </span>
                  </div>
                  <div class="yearly-total" style="display: none;">
                    {{ __('pricing.billed_annually', ['amount' => $product->currency . number_format($product->yearly_price, 0)]) }}
                  </div>
                  @if($product->trial_period_days > 0)
                    <div class="trial-period">
                      <span class="trial-badge">
                        <i class="bi bi-gift"></i>
                        {{ __('pricing.days_free_trial', ['days' => $product->trial_period_days]) }}
                      </span>
                    </div>
                  @endif
                </div>

                <div class="pricing-features">
                  <ul>
                    @foreach($product->features as $feature)
                      <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ $feature->getTranslation('name', app()->getLocale()) }}</span>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <div class="pricing-footer">
                  <a href="#contact" class="pricing-btn {{ $product->getTranslation('name', 'en') === 'Professional' ? 'btn-featured' : '' }}">
                    {{ __('pricing.get_started') }}
                  </a>
                </div>

              </div>
            </div>
          @endforeach

        </div>

        <!-- Pricing Note -->
        <div class="pricing-note" data-aos="fade-up" data-aos-delay="600">
          <p><i class="bi bi-info-circle"></i> {{ __('pricing.all_plans_note') }}
            @if($demoDocumentation && $demoDocumentation->file_path)
              <a href="{{ $demoDocumentation->file_url }}" class="text-decoration-underline fw-semibold" download="{{ $demoDocumentation->file_name ?: basename($demoDocumentation->file_path) }}">{{ __('pricing.download_demo_link') }}</a>.
            @endif
          </p>
        </div>

      </div>

    </section>
    <!-- /Pricing Section -->

    <!-- Pricing Comparison -->
    <section id="pricing-compare" class="pricing-compare section">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <span class="subtitle">{{ __('pricing.compare_subtitle') }}</span>
          <h2>{{ __('pricing.compare_title') }}</h2>
          <p>{{ __('pricing.compare_description') }}</p>
        </div>

        @if(!empty($comparisonFeatures))
          <div class="comparison-table-wrapper" data-aos="fade-up" data-aos-delay="150">
            <table class="comparison-table">
              <thead>
                <tr>
                  <th scope="col">{{ __('pricing.feature') }}</th>
                  @foreach($products as $product)
                    <th scope="col">{{ $product->getTranslation('name', app()->getLocale()) }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach($comparisonFeatures as $feature)
                  @php
                    $featureKey = $feature['key'];
                    $featureName = $feature['name'];
                    $featureDescription = $feature['description'] ?? null;
                  @endphp
                  <tr>
                    <td data-label="{{ __('pricing.feature') }}">
                      <div class="feature-label">
                        <span>{{ $featureName }}</span>
                        @if(!empty($featureDescription))
                          <button type="button" class="feature-tooltip" data-tooltip="{{ $featureDescription }}" aria-label="{{ __('pricing.feature') }}: {{ $featureName }}">
                            <i class="bi bi-info-circle"></i>
                          </button>
                        @endif
                      </div>
                    </td>
                    @foreach($products as $product)
                      @php
                        $hasFeature = $product->features->contains('key', $featureKey);
                      @endphp
                      <td data-label="{{ $product->getTranslation('name', app()->getLocale()) }}">
                        @if($hasFeature)
                          <span class="compare-icon compare-icon-true" aria-label="{{ __('pricing.included') }}">
                            <i class="bi bi-check-circle-fill"></i>
                          </span>
                        @else
                          <span class="compare-icon compare-icon-false" aria-label="{{ __('pricing.not_included') }}">
                            <i class="bi bi-x-circle"></i>
                          </span>
                        @endif
                      </td>
                    @endforeach
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="comparison-empty" data-aos="fade-up" data-aos-delay="150">
            <p><i class="bi bi-info-circle"></i> Feature details will appear here once they are configured for each plan.</p>
          </div>
        @endif
      </div>
    </section>
    <!-- /Pricing Comparison -->

    <!-- System Section -->
    <section id="system" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('system.subtitle') }}</span>
        <h2>{{ __('system.title') }}</h2>
        <p>{{ __('system.description') }}</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
            <li data-filter="*" class="filter-active">{{ __('system.all') }}</li>
            <li data-filter=".filter-dashboard">{{ __('system.dashboard') }}</li>
            <li data-filter=".filter-membership">{{ __('system.membership') }}</li>
            <li data-filter=".filter-trainers">{{ __('system.trainers') }}</li>
            <li data-filter=".filter-reports">{{ __('system.reports') }}</li>
            <li data-filter=".filter-branches">{{ __('system.branches') }}</li>
          </ul>
          <!-- End Portfolio Filters -->

          <div class="row gy-5 isotope-container" data-aos="fade-up" data-aos-delay="300">

            <!-- Dashboard -->
            <div class="col-lg-12 portfolio-item isotope-item filter-dashboard">
              <article class="portfolio-card">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="project-visual">
                      <img src="{{ asset('assets/img/portfolio/dashboard/dashboard-stat.png') }}" alt="Gymivida Dashboard" class="img-fluid" loading="lazy">
                      <div class="project-overlay">
                        <div class="overlay-content">
                          <a href="{{ asset('assets/img/portfolio/dashboard/dashboard-stat.png') }}" class="view-project glightbox" aria-label="View project image">
                            <i class="bi bi-eye"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="project-details">
                      <div class="project-header">
                        <span class="project-category">{{ __('system.dashboard') }}</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">{{ __('system.dashboard_title') }}</h3>
                      <p class="project-description">{{ __('system.dashboard_description') }}</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">{{ __('system.scope_realtime') }}</span>
                          <span class="scope-item">{{ __('system.scope_kpis') }}</span>
                          <span class="scope-item">{{ __('system.scope_smart_filters') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <!-- Membership Management -->
            <div class="col-lg-12 portfolio-item isotope-item filter-membership">
              <article class="portfolio-card">
                <div class="row g-4">
                  <div class="col-md-6 order-md-2">
                    <div class="project-visual">
                      <img src="{{ asset('assets/img/portfolio/memberships/membership-stats.png') }}" alt="Membership Management" class="img-fluid" loading="lazy">
                    </div>
                  </div>
                  <div class="col-md-6 order-md-1">
                    <div class="project-details">
                      <div class="project-header">
                        <span class="project-category">{{ __('system.membership') }}</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">{{ __('system.membership_title') }}</h3>
                      <p class="project-description">{{ __('system.membership_description') }}</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">{{ __('system.scope_auto_renewal') }}</span>
                          <span class="scope-item">{{ __('system.scope_payment_tracking') }}</span>
                          <span class="scope-item">{{ __('system.scope_freeze_resume') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <!-- Trainer Management -->
            <div class="col-lg-12 portfolio-item isotope-item filter-trainers">
              <article class="portfolio-card">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="project-visual">
                      <img src="{{ asset('assets/img/portfolio/staff/staff-stats.png') }}" alt="Trainer Scheduling" class="img-fluid" loading="lazy">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="project-details">
                      <div class="project-header">
                        <span class="project-category">{{ __('system.trainers') }}</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">{{ __('system.trainers_title') }}</h3>
                      <p class="project-description">{{ __('system.trainers_description') }}</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">{{ __('system.scope_scheduling') }}</span>
                          <span class="scope-item">{{ __('system.scope_trainer_profiles') }}</span>
                          <span class="scope-item">{{ __('system.scope_performance_reports') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <!-- Reports -->
            <div class="col-lg-12 portfolio-item isotope-item filter-reports">
              <article class="portfolio-card">
                <div class="row g-4">
                  <div class="col-md-6 order-md-2">
                    <div class="project-visual">
                      <img src="{{ asset('assets/img/portfolio/dashboard/dashboard-stat.png') }}" alt="Analytics Reports" class="img-fluid" loading="lazy">
                    </div>
                  </div>
                  <div class="col-md-6 order-md-1">
                    <div class="project-details">
                      <div class="project-header">
                        <span class="project-category">{{ __('system.reports') }}</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">{{ __('system.reports_title') }}</h3>
                      <p class="project-description">{{ __('system.reports_description') }}</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">{{ __('system.scope_pdf_csv') }}</span>
                          <span class="scope-item">{{ __('system.scope_custom_filters') }}</span>
                          <span class="scope-item">{{ __('system.scope_kpi_analysis') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>

            <!-- Branch Management -->
            <div class="col-lg-12 portfolio-item isotope-item filter-branches">
              <article class="portfolio-card">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="project-visual">
                      <img src="{{ asset('assets/img/portfolio/branches/multi-branch.png') }}" alt="Branch Management" class="img-fluid" loading="lazy">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="project-details">
                      <div class="project-header">
                        <span class="project-category">{{ __('system.branches') }}</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">{{ __('system.branches_title') }}</h3>
                      <p class="project-description">{{ __('system.branches_description') }}</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">{{ __('system.scope_centralized') }}</span>
                          <span class="scope-item">{{ __('system.scope_area_scoring') }}</span>
                          <span class="scope-item">{{ __('system.scope_branch_analytics') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>

          </div>
        </div>

        <div class="portfolio-conclusion" data-aos="fade-up" data-aos-delay="400">
          <div class="conclusion-content">
            <h4>{{ __('system.see_in_action') }}</h4>
            <p>{{ __('system.see_in_action_description') }}</p>
            <div class="conclusion-actions">
              <a href="#contact" class="primary-action">
                {{ __('system.book_demo') }} <i class="bi bi-arrow-right"></i>
              </a>
              <a href="{{ config('app.gymivida_website') }}" class="secondary-action" target="_blank">
                {{ __('system.explore_website') }}
              </a>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /System Section -->

    <!-- Team Section -->
    {{-- Hidden for now --}}
    {{-- <section id="team" class="team section">

      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">Team</span>
        <h2>Meet the Minds Behind Gymivida</h2>
        <p>Our team brings together a unique blend of technology, fitness expertise, and business strategy — all focused on helping gyms thrive in a digital-first world.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 justify-content-center">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('assets/img/person/person-m-12.webp') }}" class="img-fluid" alt="Assem Mohsen" loading="lazy">
              </div>
              <div class="member-info">
                <h4>Assem Mohsen</h4>
                <span>Founder & Chief Executive Officer</span>
                <p>A passionate developer and system architect dedicated to transforming how gyms operate through smart technology. With a deep focus on performance, automation, and scalability.</p>
                <div class="social">
                  <a href="https://www.instagram.com/assem__mohsen/" target="_blank"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/assem-m-89a61414b/" target="_blank"><i class="bi bi-linkedin"></i></a>
                  <a href=https://www.facebook.com/asem.semsm" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="https://github.com/Asem-mohsen" target="_blank"><i class="bi bi-github"></i></a>
                  <a href="mailto:asemmohsen911@gmail.com" target="_blank"><i class="bi bi-envelope"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section> --}}
    <!-- /Team Section -->

    <!-- Testimonials Section -->
    {{-- <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">Testimonials</span>
        <h2>What Our Partners Say</h2>
        <p>Discover how Gymivida is helping gym owners streamline operations, improve member experiences, and grow their business — all from one powerful platform.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="testimonial-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 4000
              },
              "slidesPerView": 1,
              "spaceBetween": 30,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "breakpoints": {
                "768": {
                  "slidesPerView": 2
                },
                "1200": {
                  "slidesPerView": 3
                }
              }
            }
          </script>

          <div class="swiper-wrapper">

            <!-- Testimonial Slide 1 -->
            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="200">
                <div class="testimonial-header">
                  <img src="{{ asset('assets/img/person/person-f-12.webp') }}" alt="Client" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Gymivida transformed how we manage our entire gym chain. From scheduling trainers to tracking memberships, everything is organized and effortless now.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Jessica Martinez</h5>
                  <span>Owner, FitZone Cairo</span>
                  <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
                </div>
              </div>
            </div>

            <!-- Testimonial Slide 2 -->
            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="300">
                <div class="testimonial-header">
                  <img src="{{ asset('assets/img/person/person-m-8.webp') }}" alt="Client" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>We manage multiple branches across Egypt — Gymivida made it easy to monitor performance, track member growth, and keep everything connected in real-time.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>David Rodriguez</h5>
                  <span>Regional Operations Manager, IronCore Gyms</span>
                  <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
                </div>
              </div>
            </div>

            <!-- Testimonial Slide 3 -->
            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="400">
                <div class="testimonial-header">
                  <img src="{{ asset('assets/img/person/person-f-6.webp') }}" alt="Client" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Their support team helped us migrate all our data from our old system without downtime. Within days, our staff and trainers were fully onboard.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Amanda Wilson</h5>
                  <span>Co-Founder, Pulse Fitness</span>
                  <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
                </div>
              </div>
            </div>

            <!-- Testimonial Slide 4 -->
            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="500">
                <div class="testimonial-header">
                  <img src="{{ asset('assets/img/person/person-m-12.webp') }}" alt="Client" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>The scoring system feature is brilliant — it helps us track and compare gym performance across our city and plan our marketing smarter.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Ryan Thompson</h5>
                  <span>Branch Director, ShapeUp Gyms</span>
                  <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
                </div>
              </div>
            </div>

            <!-- Testimonial Slide 5 -->
            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="600">
                <div class="testimonial-header">
                  <img src="{{ asset('assets/img/person/person-f-10.webp') }}" alt="Client" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Gymivida is not just software — it’s like having an extra manager. It saves us hours every week and keeps our team completely in sync.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Rachel Chen</h5>
                  <span>General Manager, CoreZone Gym</span>
                  <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
                </div>
              </div>
            </div>

          </div>

          <div class="swiper-navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>

    </section> --}}
    <!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">{{ __('contact.subtitle') }}</span>
        <h2>{{ __('contact.title') }}</h2>
        <p>{{ __('contact.description') }}</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5">

            <div class="info-item">
              <div class="info-icon">
                <i class="bi bi-chat-dots"></i>
              </div>
              <div class="info-content">
                <h4>{{ __('contact.we_here_to_help') }}</h4>
                <p>{{ __('contact.we_here_to_help_description') }}</p>
              </div>
            </div>

            <div class="contact-details">

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-envelope-open"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">{{ __('contact.email_us') }}</span>
                  <span class="detail-value">{{ config('app.gymivida_email') }}</span>
                </div>
              </div>

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-telephone-outbound"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">{{ __('contact.call_us') }}</span>
                  <span class="detail-value">{{ config('app.gymivida_phone') }}</span>
                </div>
              </div>

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">{{ __('contact.visit_us') }}</span>
                  <span class="detail-value">Gymivida HQ<br>New Cairo, Egypt</span>
                </div>
              </div>

              @if($registrationDemo && $registrationDemo->file_path)
                <div class="detail-item">
                  <div class="detail-icon">
                    <i class="bi bi-file-earmark-pdf"></i>
                  </div>
                  <div class="detail-content">
                    <span class="detail-label">{{ __('contact.registration_demo') }}</span>
                    <span class="detail-value">
                      <a href="{{ $registrationDemo->file_url }}" download="{{ $registrationDemo->file_name ?: basename($registrationDemo->file_path) }}" style="text-decoration: underline;">
                        {{ __('contact.download_registration_demo') }}
                      </a>
                    </span>
                  </div>
                </div>
              @endif

            </div>

          </div>

          <div class="col-lg-7">
            <div class="form-wrapper">
              <div class="form-header">
                <h3>{{ __('contact.send_message') }}</h3>
                <p>{{ __('contact.send_message_description') }}</p>
              </div>

              <form id="contactForm" class="contact-form">
                @csrf

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>{{ __('contact.full_name') }} <span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" required>
                      <span class="error-text text-danger" id="name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>{{ __('contact.email_address') }} <span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" class="form-control" required>
                      <span class="error-text text-danger" id="email-error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>{{ __('contact.phone_number') }}</label>
                      <input type="text" name="phone" id="phone" class="form-control">
                      <span class="error-text text-danger" id="phone-error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>{{ __('contact.subject') }}</label>
                      <input type="text" name="subject" id="subject" class="form-control">
                      <span class="error-text text-danger" id="subject-error"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_id">{{ __('contact.interested_plan') }}</label>
                  <select name="product_id" id="product_id" class="form-control">
                    <option value="">{{ __('contact.select_plan') }}</option>
                  </select>
                  <span class="error-text text-danger" id="product_id-error"></span>
                </div>

                <div class="form-group">
                  <label for="message">{{ __('contact.message') }} <span class="text-danger">*</span></label>
                  <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                  <span class="error-text text-danger" id="message-error"></span>
                </div>

                <div class="form-group">
                  <label class="custom-checkbox-container d-flex">
                    <input type="checkbox" name="wants_registration_email" id="wants_registration_email" value="1">
                    <span class="checkmark"></span>
                    <span class="checkbox-content">
                      <span class="checkbox-title">{{ __('contact.send_registration_link') }}</span>
                      <span class="checkbox-description">{{ __('contact.send_registration_link_description') }}</span>
                    </span>
                  </label>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                  <span id="btnText">{{ __('contact.send_message_button') }}</span>
                  <i class="bi bi-arrow-right" id="btnIcon"></i>
                  <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </span>
                </button>

              </form>

            </div>

          </div>

        </div>
      </div>

    </section>
    <!-- /Contact Section -->
@endsection

@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        
        loadProducts();
        
        const billingToggle = document.getElementById('billingToggle');
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        const yearlyPrices = document.querySelectorAll('.yearly-price');
        const monthlyPeriods = document.querySelectorAll('.monthly-period');
        const yearlyPeriods = document.querySelectorAll('.yearly-period');
        const yearlyTotals = document.querySelectorAll('.yearly-total');
        const monthlyLabel = document.getElementById('monthlyLabel');
        const yearlyLabel = document.getElementById('yearlyLabel');

        if (billingToggle) {
            billingToggle.addEventListener('change', function() {
                const isYearly = this.checked;
                
                monthlyPrices.forEach(price => {
                    price.style.display = isYearly ? 'none' : 'inline';
                });
                
                yearlyPrices.forEach(price => {
                    price.style.display = isYearly ? 'inline' : 'none';
                });
                
                monthlyPeriods.forEach(period => {
                    period.style.display = isYearly ? 'none' : 'inline';
                });
                
                yearlyPeriods.forEach(period => {
                    period.style.display = isYearly ? 'inline' : 'none';
                });
                
                yearlyTotals.forEach(total => {
                    total.style.display = isYearly ? 'block' : 'none';
                });

                // Update label styling
                if (isYearly) {
                    monthlyLabel.style.opacity = '0.6';
                    yearlyLabel.style.opacity = '1';
                    yearlyLabel.style.fontWeight = '600';
                    monthlyLabel.style.fontWeight = '400';
                } else {
                    monthlyLabel.style.opacity = '1';
                    yearlyLabel.style.opacity = '0.6';
                    monthlyLabel.style.fontWeight = '600';
                    yearlyLabel.style.fontWeight = '400';
                }
            });
        }


        const contactForm = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const btnSpinner = document.getElementById('btnSpinner');

        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                clearErrors();

                // Disable submit button and show loading state
                submitBtn.disabled = true;
                btnText.textContent = '{{ __('contact.sending') }}';
                btnIcon.classList.add('d-none');
                btnSpinner.classList.remove('d-none');

                // Prepare form data
                const formData = new FormData(contactForm);

                // Send AJAX request
                fetch('/api/v1/contact', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success toastr
                        toastr.success(data.message, 'Success!');
                        
                        // Reset form
                        contactForm.reset();
                        
                        // Scroll to top of form smoothly
                        contactForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        // Handle validation errors
                        if (data.errors) {
                            displayErrors(data.errors);
                            toastr.error('Please check the form and fix the errors.', 'Validation Error');
                        } else {
                            toastr.error(data.message || 'Something went wrong. Please try again.', 'Error!');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An error occurred. Please try again later.', 'Error!');
                })
                .finally(() => {
                    // Re-enable submit button and restore original state
                    submitBtn.disabled = false;
                    btnText.textContent = '{{ __('contact.send_message_button') }}';
                    btnIcon.classList.remove('d-none');
                    btnSpinner.classList.add('d-none');
                });
            });
        }

        /**
         * Clear all error messages
         */
        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-text');
            errorElements.forEach(element => {
                element.textContent = '';
            });

            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.classList.remove('is-invalid');
            });
        }

        /**
         * Display validation errors
         */
        function displayErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.getElementById(`${field}-error`);
                const inputElement = document.getElementById(field);
                
                if (errorElement && messages.length > 0) {
                    errorElement.textContent = messages[0];
                }
                
                if (inputElement) {
                    inputElement.classList.add('is-invalid');
                }
            }
        }

        // Clear error on input change
        const formInputs = document.querySelectorAll('#contactForm input, #contactForm textarea, #contactForm select');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                const errorElement = document.getElementById(`${this.id}-error`);
                if (errorElement) {
                    errorElement.textContent = '';
                }
                this.classList.remove('is-invalid');
            });
        });

        function loadProducts() {
            fetch('/api/v1/products', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const productSelect = document.getElementById('product_id');
                    if (productSelect) {
                        data.data.forEach(product => {
                            const option = document.createElement('option');
                            option.value = product.id;
                            option.textContent = product.name;
                            productSelect.appendChild(option);
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error loading products:', error);
            });
        }

        // Prevent swipe gestures on comparison table
        const comparisonTableWrapper = document.querySelector('.comparison-table-wrapper');
        if (comparisonTableWrapper) {
            let touchStartX = 0;
            let touchStartY = 0;
            let touchStartTime = 0;
            let lastTouchX = 0;
            let lastTouchY = 0;
            let isScrolling = false;

            comparisonTableWrapper.addEventListener('touchstart', function(e) {
                touchStartX = e.touches[0].clientX;
                touchStartY = e.touches[0].clientY;
                lastTouchX = touchStartX;
                lastTouchY = touchStartY;
                touchStartTime = Date.now();
                isScrolling = false;
            }, { passive: true });

            comparisonTableWrapper.addEventListener('touchmove', function(e) {
                const touchX = e.touches[0].clientX;
                const touchY = e.touches[0].clientY;
                const deltaX = touchX - lastTouchX;
                const deltaY = touchY - lastTouchY;
                const totalDeltaX = Math.abs(touchX - touchStartX);
                const totalDeltaY = Math.abs(touchY - touchStartY);

                lastTouchX = touchX;
                lastTouchY = touchY;

                // If there's significant vertical movement, it's scrolling
                if (totalDeltaY > 10) {
                    isScrolling = true;
                }

                // Check if this is a horizontal swipe gesture (not table scrolling)
                if (Math.abs(deltaX) > Math.abs(deltaY) && totalDeltaX > 30 && !isScrolling) {
                    const scrollLeft = comparisonTableWrapper.scrollLeft;
                    const scrollWidth = comparisonTableWrapper.scrollWidth;
                    const clientWidth = comparisonTableWrapper.clientWidth;
                    const maxScroll = scrollWidth - clientWidth;

                    // Only prevent if we're trying to swipe beyond scroll boundaries
                    const tryingToSwipeLeft = deltaX < 0 && scrollLeft <= 5;
                    const tryingToSwipeRight = deltaX > 0 && scrollLeft >= (maxScroll - 5);

                    if (tryingToSwipeLeft || tryingToSwipeRight || maxScroll <= 0) {
                        // This is a swipe gesture, prevent it
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                }
            }, { passive: false });

            comparisonTableWrapper.addEventListener('touchend', function(e) {
                const touchEndX = e.changedTouches[0].clientX;
                const touchEndY = e.changedTouches[0].clientY;
                const deltaX = touchEndX - touchStartX;
                const deltaY = Math.abs(touchEndY - touchStartY);
                const deltaTime = Date.now() - touchStartTime;
                const minSwipeDistance = 50;
                const maxSwipeTime = 400;

                // Prevent fast horizontal swipes that aren't scrolling
                if (!isScrolling && 
                    Math.abs(deltaX) > deltaY && 
                    Math.abs(deltaX) > minSwipeDistance && 
                    deltaTime < maxSwipeTime) {
                    // This is a swipe gesture - prevent any navigation
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                }
            }, { passive: true });
        }

        // Fix tooltip positioning to prevent clipping (only for comparison table)
        const comparisonTableTooltips = document.querySelectorAll('.comparison-table-wrapper .feature-tooltip');
        comparisonTableTooltips.forEach(function(button) {
            let tooltipElement = null;
            let closeHandler = null;

            function showTooltip() {
                if (tooltipElement) {
                    return;
                }

                const tooltipText = button.getAttribute('data-tooltip');
                if (!tooltipText) return;

                // Hide CSS tooltip by adding a class
                button.classList.add('js-tooltip-active');

                const rect = button.getBoundingClientRect();
                tooltipElement = document.createElement('div');
                tooltipElement.className = 'dynamic-tooltip';
                tooltipElement.textContent = tooltipText;
                
                // Calculate position
                const leftPos = rect.left + (rect.width / 2);
                const bottomPos = window.innerHeight - rect.top + 10;
                
                tooltipElement.style.cssText = `
                    position: fixed;
                    background: #111;
                    color: #fff;
                    padding: 8px 12px;
                    border-radius: 6px;
                    font-size: 12px;
                    line-height: 1.4;
                    max-width: 220px;
                    z-index: 99999;
                    pointer-events: none;
                    opacity: 0;
                    transition: opacity 0.2s ease;
                    left: ${leftPos}px;
                    bottom: ${bottomPos}px;
                    transform: translateX(-50%);
                    white-space: normal;
                    word-wrap: break-word;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                `;
                document.body.appendChild(tooltipElement);

                // Show tooltip
                setTimeout(() => {
                    tooltipElement.style.opacity = '1';
                }, 10);
            }

            function hideTooltip() {
                if (tooltipElement) {
                    tooltipElement.style.opacity = '0';
                    setTimeout(() => {
                        if (tooltipElement && tooltipElement.parentNode) {
                            tooltipElement.remove();
                        }
                        tooltipElement = null;
                    }, 200);
                }
                // Remove class to restore CSS tooltip
                button.classList.remove('js-tooltip-active');
                
                // Remove close handler if exists
                if (closeHandler) {
                    document.removeEventListener('click', closeHandler);
                    closeHandler = null;
                }
            }

            // For mobile (touch devices) - click to toggle
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (tooltipElement) {
                    hideTooltip();
                } else {
                    showTooltip();
                    // Close on outside click
                    setTimeout(() => {
                        closeHandler = function(event) {
                            if (!button.contains(event.target) && (!tooltipElement || !tooltipElement.contains(event.target))) {
                                hideTooltip();
                            }
                        };
                        document.addEventListener('click', closeHandler);
                    }, 100);
                }
            });

            // For desktop (hover) - use JavaScript tooltip to prevent clipping
            button.addEventListener('mouseenter', showTooltip);
            button.addEventListener('mouseleave', hideTooltip);
            button.addEventListener('focus', showTooltip);
            button.addEventListener('blur', hideTooltip);
        });
    });
</script>
@endsection