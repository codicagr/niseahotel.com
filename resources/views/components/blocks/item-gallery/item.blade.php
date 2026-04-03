@props([
    'imgUrl' => '',
    'alt' => ''
])

<li {{ $attributes->merge(['class' => 'splide__slide']) }}>
    <a href="{{ $imgUrl }}" data-fancybox="room-gallery" class="splide__slide__link">
        <img src="{{ $imgUrl }}" alt="{{ $alt }}" class="itemGalleryMainImage" loading="lazy">
        <div class="zoom-overlay">
            {{--<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                <line x1="11" y1="8" x2="11" y2="14"></line>
                <line x1="8" y1="11" x2="14" y2="11"></line>
            </svg>--}}
            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="26" height="26"></rect>
                <line x1="15" y1="11" x2="15" y2="19"></line>
                <line x1="11" y1="15" x2="19" y2="15"></line>
            </svg>
        </div>
    </a>
</li>
