@props([
    'item' => [],
    'bookingEngineUrl' => ''
])

@php
    $itemId = data_get($item, 'id');
    $link = BaseFacade::getLink($itemId, 'Item');
    $image = BaseFacade::getImage(data_get($item, 'intro_image'));
    $alt = data_get($item, 'intro_image_alt') ?: data_get($item, 'title');

    $fields = BaseFacade::getSpecificFields('Item', $itemId, [2, 3, 6]) ?? [];
    $size = data_get($fields, '2.values.0', '');
    $numberOfGuests = data_get($fields, '3.values.0', '');
    $roomCode = data_get($fields, '6.values.0', '');

    $bookingLink = ($bookingEngineUrl && $roomCode) ? $bookingEngineUrl . '&room=' . $roomCode : '';
    $title = data_get($item, 'title');
@endphp

<article {{ $attributes->merge(['class' => 'item item-' . $itemId . ' flex flexColumn']) }} data-stagger-child>
    <div class="itemImageContainer">
        <div class="itemImage">
            <a href="{{ $link }}">
                @if ($image)
                    <img src="{{ $image }}" alt="{{ $alt }}" />
                @endif
            </a>
        </div>

        @if ($bookingLink)
            <div class="bookingLink">
                <a href="{{ $bookingLink }}" target="_blank">
                    {{ BaseFacade::UpperCase(__('site/general.book_now')) }}
                </a>
            </div>
        @endif
    </div>

    <div class="itemContentContainer">
        <div class="itemContent flex flexColumn">
            <h3 class="itemTitle">
                <a href="{{ $link }}">
                    {{ $title }}
                </a>
            </h3>

            <div class="itemDetailsWrapper">
                <div class="itemDetailsContainer flex flexWrap">
                    @if ($size)
                        <div class="itemDetails size">
                            {{ BaseFacade::UpperCase($size) }}
                        </div>
                    @endif

                    @if ($numberOfGuests)
                        <div class="itemDetails numberOfGuests">
                            {{ BaseFacade::UpperCase($numberOfGuests) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="itemButton flex">
                <a class="generalButton primary" href="{{ $link }}">
                    {{ BaseFacade::UpperCase(__('site/general.more')) }}
                </a>
            </div>
        </div>
    </div>
</article>
