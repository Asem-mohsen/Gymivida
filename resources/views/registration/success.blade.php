@extends('layout.master')

@section('title', __('registration.success_title') . ' — Gymivida')

@section('body-class', 'registration-page-body')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">
@endpush

@section('content')
<div class="page-title">
  <div class="breadcrumbs">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home', ['locale' => $locale]) }}"><i class="bi bi-house"></i> {{ __('nav.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('registration.show', ['locale' => $locale]) }}">{{ __('registration.page_title') }}</a></li>
        <li class="breadcrumb-item active current">{{ __('registration.success_title') }}</li>
      </ol>
    </nav>
  </div>
  <div class="title-wrapper">
    <h1>{{ __('registration.success_title') }}</h1>
    <p>{{ __('registration.success_body') }}</p>
  </div>
</div>
@endsection
