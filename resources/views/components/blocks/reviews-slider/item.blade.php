@props([
    'platform' => '',
    'platformLogo' => '',
    'reviewerName' => '',
    'date' => '',
    'rating' => 5,
    'text' => '',
])

@php
    $rating = (int) min(max($rating, 1), 5);
@endphp

<li class="splide__slide">
    <div class="reviewSlideInner">

        <div class="reviewTop flex justifyBetween itemsStart gap10">
            @if($platformLogo)
                <div class="reviewPlatformLogo">
                    <img src="{{ $platformLogo }}" alt="{{ $platform }}">
                </div>
            @elseif($platform)
                <span class="reviewPlatformName">{{ BaseFacade::UpperCase($platform) }}</span>
            @else
                <span></span>
            @endif

            <div class="reviewStars flex gap4">
                @for($i = 1; $i <= 5; $i++)
                    <span class="reviewStar {{ $i <= $rating ? 'is-filled' : 'is-empty' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14" aria-hidden="true">
                            <path d="M12 2l2.9 5.88 6.5.94-4.7 4.57 1.1 6.44L12 16.77l-5.8 3.06 1.1-6.44L2.6 8.82l6.5-.94Z"/>
                        </svg>
                    </span>
                @endfor
            </div>
        </div>

        @if($text)
            <div class="reviewText">
                {!! $text !!}
            </div>
        @endif

        <div class="reviewMeta">
            <div class="reviewMetaInner flex justifyBetween itemsCenter gap10">
                @if($reviewerName)
                    <span class="reviewerName">{{ $reviewerName }}</span>
                @endif
                @if($date)
                    <span class="reviewDate">{{ $date }}</span>
                @endif
            </div>
        </div>

    </div>
</li>
