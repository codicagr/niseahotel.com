@props([
    'slides' => [],
    'title' => '',
    'text' => '',
    'itemTitle' => ''
])

@if (count($slides) > 0)
    @if ($title || $text)
        <div class="itemPreGalleryContainer">
            <div class="ccPage">
                <div class="ccPageInner medium">
                    <div class="itemPreGallery flex flexColumn itemsCenter justifyCenter gap15 textCenter">
                        @if($title)
                            <h4 class="itemPreGalleryTitle">
                                {{ $title }}
                            </h4>
                        @endif
                        @if($text)
                            <h5 class="itemPreGalleryText">
                                {!! $text !!}
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="itemGalleryContainer mainWrapper" x-data="splideBlock('roomGallery', @js(['sliderSelector' => '#room-main-slider', 'fancyboxSelector' => '[data-fancybox="room-gallery"]']))">
        <div id="room-main-slider" class="splide itemGalleryMain">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($slides as $slide)
                        <x-blocks.item-gallery.item
                            :imgUrl="BaseFacade::getImage(data_get($slide,'image',''))"
                            :alt="$itemTitle . ' - Photo'"
                        />
                    @endforeach
                </ul>
            </div>
        </div>

        <x-blocks.slider-controls
            :total="count($slides)"
        />
    </div>
@endif

@pushonce('header_scripts_stack', 'fancyboxJS')
    @vite([
        'resources/js/utils/fancybox.js'
    ])
@endpushonce

@pushonce('header_scripts_stack', 'splideJS')
    @vite([
        'resources/js/utils/splide.js'
    ])
@endpushonce

@pushonce('footer_scripts_stack', 'splideAlpineSliders')
    @vite(['resources/js/alpine/components/splide-block.js'])
@endpushonce

@pushonce('header_styles_stack', 'itemGalleryCSS')
    @vite([
        'resources/sass/themes/default/components/elements/splide/item-gallery.scss'
    ])
@endpushonce

@pushonce('footer_styles_stack','splideCSS')
    @vite([
        'resources/sass/themes/default/components/elements/splide/custom-splide.scss'
    ])
@endpushonce

@pushonce('footer_styles_stack','fancyboxThemeCSS')
    @vite([
        'resources/sass/themes/default/components/elements/fancybox/fancybox-theme.scss'
    ])
@endpushonce
