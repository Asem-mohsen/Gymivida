@extends('layout.master')

@section('title', __('faq.title'))

@section('body-class', 'faqs-page')

@section('content')
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => $currentLocale]) }}"><i class="bi bi-house"></i> {{ __('nav.home') }}</a></li>
            <li class="breadcrumb-item active current">{{ __('faq.breadcrumb') }}</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>{{ __('faq.title') }}</h1>
        <p>{{ __('faq.intro') }}</p>
      </div>
    </div>

    <section id="faqs" class="faq section faq-page-section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-9 col-xl-8">
            @if($faqs->isEmpty())
              <p class="text-center text-muted faq-page-empty">{{ __('faq.section_description') }}</p>
            @else
              <x-faq-accordion :faqs="$faqs" :products="$products" accordion-id="faqPageAccordion" />
            @endif
          </div>
        </div>
      </div>
    </section>
@endsection
