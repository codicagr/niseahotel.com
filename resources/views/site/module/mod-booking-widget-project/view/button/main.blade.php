@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainLinkLabel = data_get($module, 'data.general.link-label','');

    $arrivalTitle = data_get($module, 'data.arrival_title', '');
    $arrivalError = data_get($module, 'data.arrival_error', '');

    $nightsTitle = data_get($module, 'data.nights_title', '');
    $minNights = (int) data_get($module, 'data.min_nights', 1);
    $maxNights = (int) data_get($module, 'data.max_nights', 60);

    $adultsTitle = data_get($module, 'data.adults_title', '');
    $adultsNote = data_get($module, 'data.adults_note', '');
    $minAdults = (int) data_get($module, 'data.min_adults', 1);
    $maxAdults = (int) data_get($module, 'data.max_adults', 5);

    $childrenTitle = data_get($module, 'data.children_title', '');
    $childrenNote = data_get($module, 'data.children_note', '');
    $minChildren = (int) data_get($module, 'data.min_children', 0);
    $maxChildren = (int) data_get($module, 'data.max_children', 4);

    $infantsTitle = data_get($module, 'data.infants_title', '');
    $infantsNote = data_get($module, 'data.infants_note', '');
    $minInfants = (int) data_get($module, 'data.min_infants', 0);
    $maxInfants = (int) data_get($module, 'data.max_infants', 1);

    $link = data_get($module, 'data.link', '');
    $linkLabel = data_get($module, 'data.link_label', '_self');
    $target = data_get($module, 'data.target', '');
@endphp

<div class="mod{{ $moduleId }} modBookingWidget popupMode"
     x-data="bookingWidget({
        nights: {{ $minNights > 3 ? $minNights : 3 }},
        adults: {{ $minAdults > 2 ? $minAdults : 2 }},
        children: {{ $minChildren }},
        infants: {{ $minInfants }},
        arrivalError: '{{ addslashes($arrivalError) }}'
     })"
     x-cloak>

    <div class="bookingPopupTriggers">
        <a class="generalButton outlineButton desktop" href="#" @click.prevent="openPopup()" aria-label="{{ BaseFacade::UpperCase($mainLinkLabel) }}">
            {{ BaseFacade::UpperCase(__('site/general.book_now')) }}
        </a>
        <a class="mobile" href="#" @click.prevent="openPopup()" aria-label="{{ BaseFacade::UpperCase($mainLinkLabel) }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2026 Fonticons, Inc.--><path d="M224 64L224 128L416 128L416 64L448 64L448 128L544 128L544 544L96 544L96 128L192 128L192 64L224 64zM512 160L128 160L128 224L512 224L512 160zM512 256L128 256L128 512L512 512L512 256z"/></svg>
        </a>
    </div>

    <template x-teleport="body">
        <div class="bookingPopupOverlay" x-show="isPopupOpen" x-transition.opacity style="display: none;">
            <div class="bookingPopupBox" @click.away="closePopup()">
                <button type="button" class="closePopupBtn" @click="closePopup()" aria-label="{{ __('site/general.close') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>

                <h3 class="popupHeader">
                    {{ $mainTitle }}
                </h3>

                <x-blocks.booking-form
                    :module="$module"
                    idSuffix="popup"
                    :minNights="$minNights" :maxNights="$maxNights"
                    :minAdults="$minAdults" :maxAdults="$maxAdults"
                    :minChildren="$minChildren" :maxChildren="$maxChildren"
                    :minInfants="$minInfants" :maxInfants="$maxInfants"
                    :link="$link" :target="$target"
                />
            </div>
        </div>
    </template>
</div>

@pushonce('footer_scripts_stack', 'modBookingWidgetProjectJS')
    @vite([
        'resources/js/utils/booking-widget.js'
    ])
@endpushonce

@pushonce('footer_styles_stack','modBookingWidgetProject')
    @vite([
        'resources/sass/themes/default/components/modules/booking-widget/booking-widget.scss'
    ])
@endpushonce
