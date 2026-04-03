@props([
    'title' => '',
    'text' => ''
])

<li class="splide__slide">
    <div class="slideContent flex flexColumn itemsCenter textCenter">
        @if($title)
            <h2 class="slideTitle">
                {{ $title }}
            </h2>
        @endif

        @if($text)
            <div class="slideText">
                {!! $text !!}
            </div>
        @endif
    </div>
</li>
