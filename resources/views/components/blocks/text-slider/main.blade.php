@props([
    'slides' => [],
    'title' => '',
    'mainLink' => '',
    'mainLinkLabel' => '',
    'mainTarget' => '_self',
    'sliderId' => null,
    'customClass' => '',
])

@php
    $finalId = $sliderId ? $sliderId : uniqid('ts-');
@endphp

@if(count($slides) > 0)
    <section id="text-slider-section-{{ $finalId }}"
             class="textSliderSection mainWrapper {{ $customClass }}"
             x-data="splideBlock('textSlider', @js(['sliderSelector' => '#text-slider-'.$finalId, 'gsap' => ['rootSelector' => '#text-slider-section-'.$finalId]]))">

        <div class="ccPage">
            <div class="ccPageInner medium">

                <div class="textSliderWrapper flex flexColumn justifyCenter">
                    @if($title)
                        <div class="textSliderMainTitle textCenter" data-stagger-child>
                            {{ BaseFacade::UpperCase($title) }}
                        </div>
                    @endif

                    <div class="textSliderMainWrapper">
                        <div id="text-slider-{{ $finalId }}" class="splide textSliderMain">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach($slides as $slide)
                                        <x-blocks.text-slider.item
                                            :title="data_get($slide, 'title', '')"
                                            :text="data_get($slide, 'text', '')"
                                        />
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <x-blocks.slider-controls
                            :total="count($slides)"
                        />
                    </div>

                    @if($mainLink && $mainLinkLabel)
                        <div class="textSliderMainButtonWrapper flex justifyCenter marginTop50">
                            <a class="generalButton bigButton primary" href="{{ $mainLink }}" target="{{ $mainTarget }}" data-stagger-child>
                                {{ BaseFacade::UpperCase($mainLinkLabel) }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif

@pushonce('footer_styles_stack','textSliderCSS')
    @vite([
        'resources/sass/themes/default/components/elements/splide/text-slider.scss'
    ])
@endpushonce

@pushonce('footer_styles_stack','splideCSS')
    @vite([
        'resources/sass/themes/default/components/elements/splide/custom-splide.scss'
    ])
@endpushonce

@pushonce('footer_scripts_stack', 'splideJS')
    @vite([
        'resources/js/utils/splide.js'
    ])
@endpushonce

@pushonce('footer_scripts_stack', 'splideAlpineSliders')
    @vite(['resources/js/alpine/components/splide-block.js'])
@endpushonce
