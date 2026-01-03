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
              <h1 data-aos="fade-up" data-aos-delay="200">Empower Your Gym. Simplify Management. Grow Faster.</h1>
              <p data-aos="fade-up" data-aos-delay="300">
                Take full control of your gym operations — from memberships and trainers to reports and real-time tracking — all in one powerful platform. Gymivida helps you save time, reduce costs, and elevate the member experience.
              </p>
              <div class="hero-cta" data-aos="fade-up" data-aos-delay="400">
                <a href="#about" class="btn-primary">Get Started Today</a>
                @if($demoDocumentation && $demoDocumentation->file_path)
                  <a href="{{ $demoDocumentation->file_url }}" class="btn-secondary" download="{{ $demoDocumentation->file_name ?: basename($demoDocumentation->file_path) }}">
                    <i class="bi bi-download"></i>
                    Download Demo
                  </a>
                @endif
              </div>
              <div class="hero-stats" data-aos="fade-up" data-aos-delay="500">
                <div class="stat-item">
                  <div class="stat-number">100+</div>
                  <div class="stat-label">Gyms & Fitness Centers</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">500+</div>
                  <div class="stat-label">Users</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">200+</div>
                  <div class="stat-label">Services & Classes</div>
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
                  <h5>Covered Cities</h5>
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
        <span class="subtitle">About</span>
        <h2>About Gymivida</h2>
        <p>
          At Gymivida, we believe managing a gym should be as powerful and energizing as a great workout. Our mission is to simplify operations for fitness centers of all sizes — helping owners manage members, trainers, schedules, and finances from one smart, intuitive platform.
          We combine technology and fitness insight to help you focus on what truly matters — growing your business and empowering healthier lives.
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h2>Empowering Gyms Through Smart Innovation</h2>
              <p class="lead">
                At Gymivida, we blend technology and passion for fitness to help gym owners manage, grow, and elevate their businesses effortlessly.
              </p>
              
              <p>
                We understand the challenges of running a fitness center — from handling memberships and trainer schedules to tracking performance and payments. That’s why we built a powerful, all-in-one platform designed to simplify operations and enhance the member experience.
              </p>
              
              <p>
                With automation, real-time insights, and seamless control, Gymivida enables you to focus on what truly matters — building stronger communities, achieving growth, and inspiring healthier lifestyles every day.
              </p>

              <div class="stats-row">
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"></div>
                  <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="850" data-purecounter-duration="1"></div>
                  <div class="stat-label">Projects Completed</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="240" data-purecounter-duration="1"></div>
                  <div class="stat-label">Happy Clients</div>
                </div>
              </div>

              <div class="cta-section">
                <a href="#contact" class="btn-outline">Meet Our Team</a>
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
                    <h4>Award Winning</h4>
                    <p>Recognized for excellence in our industry</p>
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
        <span class="subtitle">Our Solutions</span>
        <h2>What Gymivida Offers</h2>
        <p>
          Gymivida is your all-in-one platform to manage, grow, and elevate your fitness business. From daily operations to advanced analytics, we provide the tools you need to deliver a smarter, more efficient gym experience.
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
                  <h3>{{ $service->title }}</h3>
                  <p>{{ $service->description }}</p>
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
        <span class="subtitle">Why Gymivida</span>
        <h2>Why Choose Gymivida</h2>
        <p>
          Because running a gym shouldn’t be complicated. Gymivida empowers fitness businesses with powerful tools, real-time insights, and a seamless experience designed to simplify operations and accelerate growth.
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h2>Built for Gym Owners Who Want to Grow</h2>
              <p>
                Gymivida combines innovation, usability, and reliability to give gym owners full control of their business — from managing members to tracking performance. We’re not just another software; we’re your digital partner in success.
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
                  <h3>Smart & Scalable Technology</h3>
                  <p>
                    Our system grows with your gym — from a single branch to a nationwide network. Enjoy fast, reliable, and scalable performance built on modern technology.
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
                  <h3>Trusted Expertise</h3>
                  <p>
                    Developed by a team that understands both fitness and technology, Gymivida delivers a platform tailored to real gym workflows and industry needs.
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
                  <h3>Responsive Support</h3>
                  <p>
                    Our support team is always ready to help — whether you’re onboarding, setting up new features, or optimizing your daily operations.
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
                  <h3>Maximum Efficiency</h3>
                  <p>
                    Save time and resources through automation and data-driven insights — so you can focus more on growing your gym, not managing it.
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
        <span class="subtitle">Pricing</span>
        <h2>Choose Your Plan</h2>
        <p>
          Flexible pricing options designed to fit gyms of all sizes — from boutique fitness studios to multi-branch chains. Start growing smarter today.
        </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Billing Toggle -->
        <div class="pricing-toggle" data-aos="fade-up" data-aos-delay="200">
          <div class="toggle-wrapper">
            <span class="toggle-label" id="monthlyLabel">Monthly</span>
            <label class="toggle-switch">
              <input type="checkbox" id="billingToggle">
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label" id="yearlyLabel">Yearly <span class="badge">Save {{ $averageDiscount ?? 17 }}%</span></span>
          </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="300">

          @foreach($products as $index => $product)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 300 + ($index * 100) }}">
              <div class="pricing-card {{ $product->name === 'Professional' ? 'featured' : '' }}">
                
                @if($product->name === 'Professional')
                  <div class="featured-badge">Most Popular</div>
                @endif

                <div class="pricing-header">
                  <h3>{{ $product->name }}</h3>
                  <p class="pricing-description">{{ $product->description }}</p>
                </div>

                <div class="pricing-price">
                  <div class="price-wrapper">
                    <span class="currency">{{ $product->currency }}</span>
                    <span class="amount monthly-price">{{ number_format($product->monthly_price, 0) }}</span>
                    <span class="amount yearly-price" style="display: none;">{{ number_format($product->yearly_price / 12, 0) }}</span>
                    <span class="period">
                      <span class="monthly-period">/month</span>
                      <span class="yearly-period" style="display: none;">/month</span>
                    </span>
                  </div>
                  <div class="yearly-total" style="display: none;">
                    Billed {{ $product->currency . number_format($product->yearly_price, 0) }} annually
                  </div>
                  @if($product->trial_period_days > 0)
                    <div class="trial-period">
                      <span class="trial-badge">
                        <i class="bi bi-gift"></i>
                        {{ $product->trial_period_days }} days free trial
                      </span>
                    </div>
                  @endif
                </div>

                <div class="pricing-features">
                  <ul>
                    @foreach($product->features as $feature)
                      <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ $feature->name }}</span>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <div class="pricing-footer">
                  <a href="#contact" class="pricing-btn {{ $product->name === 'Professional' ? 'btn-featured' : '' }}">
                    Get Started
                  </a>
                </div>

              </div>
            </div>
          @endforeach

        </div>

        <!-- Pricing Note -->
        <div class="pricing-note" data-aos="fade-up" data-aos-delay="600">
          <p><i class="bi bi-info-circle"></i> All plans include free onboarding support and regular updates. Custom enterprise solutions available upon request. 
            @if($demoDocumentation && $demoDocumentation->file_path)
              <a href="{{ $demoDocumentation->file_url }}" class="text-decoration-underline fw-semibold" download="{{ $demoDocumentation->file_name ?: basename($demoDocumentation->file_path) }}">Click here to download a demo</a>.
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
          <span class="subtitle">Compare Plans</span>
          <h2>Feature Breakdown</h2>
          <p>See exactly what each plan includes so you can choose the coverage that fits your branches, trainers, and growth goals.</p>
        </div>

        @if(!empty($comparisonFeatures))
          <div class="comparison-table-wrapper" data-aos="fade-up" data-aos-delay="150">
            <table class="comparison-table">
              <thead>
                <tr>
                  <th scope="col">Feature</th>
                  @foreach($products as $product)
                    <th scope="col">{{ $product->name }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach($comparisonFeatures as $feature)
                  @php
                    $featureName = $feature['name'];
                    $featureDescription = $feature['description'] ?? null;
                  @endphp
                  <tr>
                    <td data-label="Feature">
                      <div class="feature-label">
                        <span>{{ $featureName }}</span>
                        @if(!empty($featureDescription))
                          <button type="button" class="feature-tooltip" data-tooltip="{{ $featureDescription }}" aria-label="More info about {{ $featureName }}">
                            <i class="bi bi-info-circle"></i>
                          </button>
                        @endif
                      </div>
                    </td>
                    @foreach($products as $product)
                      @php
                        $hasFeature = $product->features->contains(function($feature) use ($featureName) {
                          return $feature->name === $featureName;
                        });
                      @endphp
                      <td data-label="{{ $product->name }}">
                        @if($hasFeature)
                          <span class="compare-icon compare-icon-true" aria-label="Included">
                            <i class="bi bi-check-circle-fill"></i>
                          </span>
                        @else
                          <span class="compare-icon compare-icon-false" aria-label="Not included">
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
        <span class="subtitle">System Preview</span>
        <h2>Explore Gymivida in Action</h2>
        <p>Take a closer look at how Gymivida transforms your gym operations into a smart, efficient, and fully connected management experience.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-dashboard">Dashboard</li>
            <li data-filter=".filter-membership">Membership</li>
            <li data-filter=".filter-trainers">Trainers</li>
            <li data-filter=".filter-reports">Reports</li>
            <li data-filter=".filter-branches">Branches</li>
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
                        <span class="project-category">Dashboard</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">All-in-One Control Panel</h3>
                      <p class="project-description">Monitor gym performance, attendance, revenue, and trainer activity in real-time. The Gymivida dashboard provides instant insights into every corner of your business.</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">Real-Time Data</span>
                          <span class="scope-item">KPIs & Charts</span>
                          <span class="scope-item">Smart Filters</span>
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
                        <span class="project-category">Membership</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">Membership & Subscription Management</h3>
                      <p class="project-description">Easily manage active memberships, renewals, freeze requests, and payment tracking — all integrated with your billing system for a seamless experience.</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">Auto Renewal</span>
                          <span class="scope-item">Payment Tracking</span>
                          <span class="scope-item">Freeze / Resume</span>
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
                        <span class="project-category">Trainers</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">Trainer & Staff Management</h3>
                      <p class="project-description">Organize trainer schedules, assign classes, and track performance. Empower your team with easy communication tools and performance analytics.</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">Scheduling</span>
                          <span class="scope-item">Trainer Profiles</span>
                          <span class="scope-item">Performance Reports</span>
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
                        <span class="project-category">Reports</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">Analytics & Reports</h3>
                      <p class="project-description">Generate detailed reports on member activity, income, trainer performance, and more — helping you make data-driven decisions effortlessly.</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">PDF & CSV Exports</span>
                          <span class="scope-item">Custom Filters</span>
                          <span class="scope-item">KPI Analysis</span>
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
                        <span class="project-category">Branches</span>
                        <time class="project-year">2025</time>
                      </div>
                      <h3 class="project-title">Multi-Branch Management</h3>
                      <p class="project-description">Manage all your branches from one central system — monitor performance by city, staff, and member engagement across locations.</p>
                      <div class="project-meta">
                        <div class="project-scope">
                          <span class="scope-item">Centralized Control</span>
                          <span class="scope-item">Area-Based Scoring</span>
                          <span class="scope-item">Branch Analytics</span>
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
            <h4>See Gymivida in Action</h4>
            <p>Discover how Gymivida helps you streamline operations, empower your staff, and elevate the member experience — all from a single platform.</p>
            <div class="conclusion-actions">
              <a href="#contact" class="primary-action">
                Book a Demo <i class="bi bi-arrow-right"></i>
              </a>
              <a href="{{ config('app.gymivida_website') }}" class="secondary-action" target="_blank">
                Explore Gymivida Website
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
        <span class="subtitle">Contact</span>
        <h2>Get in Touch with Gymivida</h2>
        <p>Whether you're managing a single gym or a growing fitness network, our team is here to help you streamline operations and unlock your gym’s full potential. Let’s start the conversation today.</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5">

            <div class="info-item">
              <div class="info-icon">
                <i class="bi bi-chat-dots"></i>
              </div>
              <div class="info-content">
                <h4>We’re Here to Help</h4>
                <p>Our support and partnership teams are available to answer your questions, guide you through setup, and help you grow with Gymivida.</p>
              </div>
            </div>

            <div class="contact-details">

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-envelope-open"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">Email Us</span>
                  <span class="detail-value">{{ config('app.gymivida_email') }}</span>
                </div>
              </div>

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-telephone-outbound"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">Call Us</span>
                  <span class="detail-value">{{ config('app.gymivida_phone') }}</span>
                </div>
              </div>

              <div class="detail-item">
                <div class="detail-icon">
                  <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="detail-content">
                  <span class="detail-label">Visit Us</span>
                  <span class="detail-value">Gymivida HQ<br>New Cairo, Egypt</span>
                </div>
              </div>

              @if($registrationDemo && $registrationDemo->file_path)
                <div class="detail-item">
                  <div class="detail-icon">
                    <i class="bi bi-file-earmark-pdf"></i>
                  </div>
                  <div class="detail-content">
                    <span class="detail-label">Registration Demo</span>
                    <span class="detail-value">
                      <a href="{{ $registrationDemo->file_url }}" download="{{ $registrationDemo->file_name ?: basename($registrationDemo->file_path) }}" style="text-decoration: underline;">
                        Download Registration Demo Documentation
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
                <h3>Send Us a Message</h3>
                <p>Have a question or want a demo? Fill out the form and our team will get back to you shortly.</p>
              </div>

              <form id="contactForm" class="contact-form">
                @csrf

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Full Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" required>
                      <span class="error-text text-danger" id="name-error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email Address <span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" class="form-control" required>
                      <span class="error-text text-danger" id="email-error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" name="phone" id="phone" class="form-control">
                      <span class="error-text text-danger" id="phone-error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" name="subject" id="subject" class="form-control">
                      <span class="error-text text-danger" id="subject-error"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_id">Interested Subscription Plan (Optional)</label>
                  <select name="product_id" id="product_id" class="form-control">
                    <option value="">-- Select a Subscription Plan --</option>
                  </select>
                  <span class="error-text text-danger" id="product_id-error"></span>
                </div>

                <div class="form-group">
                  <label for="message">Message <span class="text-danger">*</span></label>
                  <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                  <span class="error-text text-danger" id="message-error"></span>
                </div>

                <div class="form-group">
                  <label class="custom-checkbox-container d-flex">
                    <input type="checkbox" name="wants_registration_email" id="wants_registration_email" value="1">
                    <span class="checkmark"></span>
                    <span class="checkbox-content">
                      <span class="checkbox-title">Send me a complete registration link</span>
                      <span class="checkbox-description">I want to receive an email to set up my gym and complete the registration process</span>
                    </span>
                  </label>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                  <span id="btnText">Send Message</span>
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
                btnText.textContent = 'Sending...';
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
                    btnText.textContent = 'Send Message';
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