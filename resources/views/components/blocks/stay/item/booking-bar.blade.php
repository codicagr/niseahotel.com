@props([
    'bookingLink' => '',
    'title' => '',
    'guests' => ''
])

@if ($bookingLink)
    <div {{ $attributes->merge(['class' => 'stickyBookingBar']) }}
         x-data="{ showSticky: false }"
         @scroll.window="showSticky = window.scrollY > window.innerHeight * 0.7"
         :class="{ 'is-visible': showSticky }">
        <div class="ccPage">
            <div class="ccPageInner fullWidth">
                <div class="stickyBookingBarWrapper flex justifySpaceBetween itemsCenter gap10">

                    <div class="stickyInfo flex flexColumn">
                        <div class="stickyTitle">{{ $title }}</div>
                        @if($guests)
                            <div class="stickySubtitle">
                                {{ __('site/general.ideal_for') }} {{ $guests }}
                            </div>
                        @endif
                    </div>

                    <div class="stickyAction flex itemsCenter gap20">
                        <a class="generalButton primary" href="{{ $bookingLink }}" target="_blank">
                            {{ BaseFacade::UpperCase(__('site/general.book_now')) }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
