@props([
    'image' => '',
    'alt' => '',
    'title' => ''
])

<div {{ $attributes->merge(['class' => 'pageHeaderContainer']) }} x-ref="headerContainer">

    <div class="pageHeaderImage" :style="`filter: blur(${blurAmount}px); transform: scale(${imageScale});`">
        @if($image)
            <img src="{{ $image }}" alt="{{ $alt }}" />
        @endif
    </div>

    <div class="pageHeaderOverlay" :style="`opacity: ${overlayOpacity};`"></div>

    @if($title)
        <div class="pageHeaderWrapper" x-ref="titleWrapper" :style="`transform: translateY(calc(-50% + ${titleOffset}px));`">
            <div class="ccPage">
                <div class="ccPageInner medium">
                    <div class="pageHeader flex justifyCenter">
                        <div class="pageHeaderInner flex justifyCenter itemsCenter">
                            <h1 class="pageHeaderTitle textCenter" data-stagger-child>
                                {{ $title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-ui.scroll-indicator />
</div>
