@props([
    'amenities' => [],
    'image' => ''
])

@if (count($amenities) > 0)
    <div class="itemAmenities">
        <div class="itemAmenitiesWrapper ccPage">
            <div class="ccPageInner x-large">
                <div class="itemAmenitiesContainer flex flexWrap gap60">
                    <div class="itemAmenitiesTitle" data-stagger-child>
                        {{ __('site/room_amenities.title') }}
                    </div>
                    <div class="itemAmenitiesList flex flexWrap">
                        @foreach($amenities as $amenity)
                            <x-blocks.stay.item.amenity-item :slug="$amenity" data-stagger-child />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if($image)
            <div class="itemAmenitiesImageContainer">
                <div class="itemAmenitiesImage">
                    <img src="{{ $image }}" alt="{{ __('site/room_amenities.title') }}" />
                </div>
            </div>
        @endif
    </div>
@endif
