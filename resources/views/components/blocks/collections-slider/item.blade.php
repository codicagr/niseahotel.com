@props([
    'image' => '',
    'title' => '',
    'text' => '',
    'link' => '',
    'linkLabel' => __('site/general.discover_more'),
    'target' => '_self',
    'sizeClass' => ''
])

<li class="splide__slide auto-width-slide {{ $sizeClass }}">
    <div class="slideInner">
        @if($image)
            <div class="imageWrapper">
                @if ($link)
                    <a href="{{ $link }}" target="{{ $target }}">
                        <img src="{{ $image }}" alt="{{ $title }}">
                    </a>
                @else
                    <img src="{{ $image }}" alt="{{ $title }}">
                @endif
            </div>
        @endif

        <div class="contentWrapper flex flexWrap gap10">
            @if($title)
                <h3 class="slideTitle">
                    @if ($link)
                        <a href="{{ $link }}" target="{{ $target }}">
                            {{ $title }}
                        </a>
                    @else
                        {{ $title }}
                    @endif
                </h3>
            @endif
            @if($text)
                <div class="slideText">
                    {!! $text !!}
                </div>
            @endif

            @if ($link && $linkLabel)
                <a class="plainButton" href="{{ $link }}" target="{{ $target }}">
                    {!! BaseFacade::UpperCase($linkLabel) !!}
                </a>
            @endif
        </div>
    </div>
</li>
