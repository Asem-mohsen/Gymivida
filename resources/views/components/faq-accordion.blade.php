@props([
    'faqs',
    'products',
    'accordionId' => 'faqAccordion',
])

<div class="faq-list-wrapper">
  <div class="accordion faq-accordion" id="{{ $accordionId }}">
  @foreach($faqs as $index => $faq)
    @php
      $headingId = $accordionId . '-h' . $faq->id;
      $collapseId = $accordionId . '-c' . $faq->id;
    @endphp
    <div class="accordion-item">
      <h2 class="accordion-header" id="{{ $headingId }}">
        <button
          class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#{{ $collapseId }}"
          aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
          aria-controls="{{ $collapseId }}"
        >
          <span class="faq-q-icon" aria-hidden="true"><i class="bi bi-chat-square-text"></i></span>
          <span class="faq-q-text">{{ $faq->questionForLocale() }}</span>
        </button>
      </h2>
      <div
        id="{{ $collapseId }}"
        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
        aria-labelledby="{{ $headingId }}"
        data-bs-parent="#{{ $accordionId }}"
      >
        <div class="accordion-body">
          @if($faq->kind === \App\Enums\FaqKind::FreeTrial)
            <p class="faq-answer-lead">{{ __('faq.free_trial_lead') }}</p>
            @if($products->isEmpty())
              <p class="mb-0 text-muted">{{ __('faq.no_trial_configured') }}</p>
            @else
            <ul class="mb-0 faq-free-trial-plans">
              @foreach($products as $product)
                <li>
                  <span class="faq-plan-name">{{ $product->getTranslation('name', app()->getLocale()) }}</span>
                  <span class="text-muted">—</span>
                  @if($product->trial_period_days > 0)
                    {{ __('pricing.days_free_trial', ['days' => $product->trial_period_days]) }}
                  @else
                    {{ __('faq.no_trial_configured') }}
                  @endif
                </li>
              @endforeach
            </ul>
            @endif
          @else
            <div class="faq-answer">{!! nl2br(e($faq->answerForLocale())) !!}</div>
            @if($faq->documentation_type)
              @php
                $doc = \App\Models\Documentation::getByType($faq->documentation_type);
              @endphp
              @if($doc && $doc->file_path)
                <p class="faq-doc-download mb-0">
                  <a
                    href="{{ $doc->file_url }}"
                    class="faq-doc-link"
                    download="{{ $doc->file_name ?: 'guide.pdf' }}"
                    rel="nofollow"
                  >
                    <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i>
                    <span>
                      @if($faq->documentation_type === 'registration')
                        {{ __('faq.download_registration_link') }}
                      @else
                        {{ __('faq.download_documentation_link') }}
                      @endif
                    </span>
                  </a>
                </p>
              @endif
            @endif
          @endif
        </div>
      </div>
    </div>
  @endforeach
  </div>
</div>
