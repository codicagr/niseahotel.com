@props([
    'slides' => [],
    'mainTitle' => '',
    'mainText' => '',
    'mainLink' => '',
    'mainLinkLabel' => '',
    'mainTarget' => '_self',
    'sliderId' => null,
    'customClass' => '',
    'linkLabel' => __('site/general.more'),
])

@php
    $finalId = $sliderId ? 'collections-' . $sliderId : uniqid('collections-');
@endphp

@if(count($slides) > 0)
    <section id="{{ $finalId }}-section"
             class="collectionsSection mainWrapper {{ $customClass }}"
             x-data="splideBlock('collectionsSlider', @js(['sliderSelector' => '#'.$finalId.'-slider', 'gsap' => ['rootSelector' => '#'.$finalId.'-section']]))">

        <div class="floatBox flex flexWrap justifyCenter">
            @if($mainTitle || $mainText)
                <div class="collectionsHeaderContainer ccPage">
                    <div class="ccPageInner medium">
                        <div class="collectionsHeader flex flexColumn itemsCenter gap30">
                            @if($mainTitle)
                                <h3 class="collectionsMainTitle textCenter" data-stagger-child>
                                    {{ $mainTitle }}
                                </h3>
                            @endif
                            @if($mainText)
                                <h4 class="collectionsMainText textCenter" data-stagger-child>
                                    {!! $mainText !!}
                                </h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="collectionsSliderMainWrapper">
                <div id="{{ $finalId }}-slider" class="splide collectionsSplide">
                    <div class="splide__track">
                        <ul class="splide__list">

                            @foreach($slides as $index => $slide)
                                @php
                                    $image = \BaseFacade::getImage(data_get($slide, 'image', ''));
                                    $title = data_get($slide, 'title', '');
                                    $text  = data_get($slide, 'text', '');
                                    $link  = data_get($slide, 'link', '');
                                    $target  = data_get($slide, 'target', '_self');
                                    $sizeClass = ($index % 2 === 0) ? 'is-portrait' : 'is-landscape';
                                @endphp

                                <x-blocks.collections-slider.item
                                    :image="$image"
                                    :title="$title"
                                    :text="$text"
                                    :link="$link"
                                    :linkLabel="$linkLabel"
                                    :target="$target"
                                    :sizeClass="$sizeClass"
                                />
                            @endforeach

                        </ul>
                    </div>
                </div>

                <x-blocks.slider-controls
                    :showCounter="false"
                />
            </div>

            @if($mainLink && $mainLinkLabel)
                <div class="collectionsSliderMainButtonContainer ccPage marginTop50">
                    <div class="ccPageInner">
                        <div class="collectionsSliderMainButtonWrapper flex justifyCenter">
                            <a class="generalButton bigButton primary" href="{{ $mainLink }}" target="{{ $mainTarget }}" data-stagger-child>
                                {{ BaseFacade::UpperCase($mainLinkLabel) }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif

@pushonce('footer_styles_stack','collectionsSliderCSS')
    @vite([
        'resources/sass/themes/default/components/elements/splide/collections.scss'
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
