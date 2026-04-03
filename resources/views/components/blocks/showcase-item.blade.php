@props([
    'itemId' => null,
    'direction' => 'imageLeft',
    'image' => null,
    'imageLink' => false,
    'alt' => '',
    'title' => null,
    'titleLink' => false,
    'text' => null,
    'secondaryText' => null,
    'link' => null,
    'linkLabel' => null,
    'target' => '_self',
])

@php
    $baseClasses = 'showcaseItem ' . ($itemId ? 'item-'.$itemId : '') . ' ' . $direction;
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    <div class="showcaseItemImageContainer">
        <div class="showcaseItemImage">
            @if ($image)
                @if ($imageLink && $link)
                    <a href="{{ $link }}" target="{{ $target }}">
                        <img src="{{ $image }}" alt="{{ $alt }}" />
                    </a>
                @else
                    <img src="{{ $image }}" alt="{{ $alt }}" />
                @endif
            @endif
        </div>
    </div>

    <div class="showcaseItemContentContainer">
        <div class="showcaseItemContent flex itemsCenter">
            <div class="showcaseItemContentInner flex flexColumn gap20">
                @if ($title)
                    <h3 class="showcaseItemTitle" data-stagger-child>
                        @if ($titleLink && $link)
                            <a href="{{ $link }}" target="{{ $target }}">
                                {!! $title !!}
                            </a>
                        @else
                            {!! $title !!}
                        @endif
                    </h3>
                @endif

                @if ($text)
                    <div class="showcaseItemText" data-stagger-child>
                        {!! $text !!}
                    </div>
                @endif

                @if ($secondaryText)
                    <div class="showcaseItemSecondaryText" data-stagger-child>
                        {!! $secondaryText !!}
                    </div>
                @endif

                @if ($link && $linkLabel)
                    <div class="showcaseItemButton flex" data-stagger-child>
                        <a class="generalButton primary" href="{{ $link }}" target="{{ $target }}">
                            {{ BaseFacade::UpperCase($linkLabel) }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
