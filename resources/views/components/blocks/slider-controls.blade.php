@props([
    'total' => 0,
    'alpineSlider' => 'slider',
    'alpineCurrent' => 'currentSlide',
    'customClass' => '',
    'showCounter' => true
])

<div class="customSliderArrows flex justifyCenter itemsCenter gap30 {{ $customClass }}">
    <button type="button"
            class="sliderBtn prevBtn flex itemsCenter justifyCenter"
            @click="{{ $alpineSlider }}?.go('<')"
            aria-label="{{ __('site/general.previous_slide') }}">
        <svg width="60" height="20" viewBox="0 0 60 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10H1M1 10L10 1M1 10L10 19" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
        </svg>
    </button>

    @if($showCounter)
        <div class="sliderCounter flex itemsCenter justifyCenter">
            <span class="current" x-text="{{ $alpineCurrent }}">1</span>
            <span class="separator">/</span>
            <span class="total">{{ $total }}</span>
        </div>
    @endif

    <button type="button"
            class="sliderBtn nextBtn flex itemsCenter justifyCenter"
            @click="{{ $alpineSlider }}?.go('>')"
            aria-label="{{ __('site/general.next_slide') }}">
        <svg width="60" height="20" viewBox="0 0 60 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 10H59M59 10L50 1M59 10L50 19" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
        </svg>
    </button>
</div>
