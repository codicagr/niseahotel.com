@props([
    'reviews' => [],
    'mainTitle' => '',
    'mainText' => '',
    'sliderId' => null,
    'customClass' => '',
])

@php
    $finalId = $sliderId ? 'reviews-' . $sliderId : uniqid('reviews-');
@endphp

@if(count($reviews) > 0)
    <section id="{{ $finalId }}-section"
             class="reviewsSection {{ $customClass }}"
             x-data="splideBlock('reviews', @js(['sliderSelector' => '#'.$finalId.'-slider', 'gsap' => ['rootSelector' => '#'.$finalId.'-section']]))">

        <div class="floatBox flex flexWrap justifyCenter">

            @if($mainTitle || $mainText)
                <div class="reviewsHeaderContainer ccPage">
                    <div class="ccPageInner medium">
                        <div class="reviewsHeader flex flexColumn itemsCenter gap30">
                            @if($mainTitle)
                                <h3 class="reviewsMainTitle textCenter" data-stagger-child>
                                    {{ $mainTitle }}
                                </h3>
                            @endif
                            @if($mainText)
                                <h4 class="reviewsMainText textCenter" data-stagger-child>
                                    {!! $mainText !!}
                                </h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="reviewsSliderMainWrapper">
                <div id="{{ $finalId }}-slider" class="splide reviewsSplide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($reviews as $review)
                                @php
                                    $platform     = data_get($review, 'platform', '');
                                    $platformLogo = data_get($review, 'platform_logo', '')
                                                    ? \BaseFacade::getImage(data_get($review, 'platform_logo', ''))
                                                    : '';
                                    $reviewerName = data_get($review, 'reviewer_name', '');
                                    $date         = data_get($review, 'date', '') ? \Carbon\Carbon::parse(data_get($review, 'date'))->format('d/m/Y') : '';
                                    $rating       = data_get($review, 'rating', 5);
                                    $text         = data_get($review, 'text', '');
                                @endphp

                                <x-blocks.reviews-slider.item
                                    :platform="$platform"
                                    :platformLogo="$platformLogo"
                                    :reviewerName="$reviewerName"
                                    :date="$date"
                                    :rating="$rating"
                                    :text="$text"
                                />
                            @endforeach
                        </ul>
                    </div>
                </div>

                <x-blocks.slider-controls :showCounter="false" />
            </div>

        </div>
    </section>
@endif

@pushonce('footer_styles_stack', 'reviewsSliderCSS')
    @vite(['resources/sass/themes/default/components/elements/splide/reviews-slider.scss'])
@endpushonce

@pushonce('footer_styles_stack', 'splideCSS')
    @vite(['resources/sass/themes/default/components/elements/splide/custom-splide.scss'])
@endpushonce

@pushonce('footer_scripts_stack', 'splideJS')
    @vite(['resources/js/utils/splide.js'])
@endpushonce

@pushonce('footer_scripts_stack', 'splideAlpineSliders')
    @vite(['resources/js/alpine/components/splide-block.js'])
@endpushonce
