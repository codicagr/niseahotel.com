@props([
    'imgUrl' => '',
    'alt' => '',
    'caption' => ''
])

<div class="masonryItem" data-masonry-item>
    <a href="{{ $imgUrl }}"
       data-fancybox="masonry-gallery"
       data-caption="{{ $caption ?: $alt }}"
       class="masonryLink">

        <img src="{{ $imgUrl }}" alt="{{ $alt }}" class="masonryImage" loading="lazy">

        <div class="hoverOverlay flex itemsCenter justifyCenter">
            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="26" height="26"></rect>
                <line x1="15" y1="11" x2="15" y2="19"></line>
                <line x1="11" y1="15" x2="19" y2="15"></line>
            </svg>
        </div>
    </a>
</div>
