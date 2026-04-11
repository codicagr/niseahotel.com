@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainText = data_get($module, 'data.general.text', '');
    $mainImage = BaseFacade::getImage(data_get($module, 'data.general.image', ''));

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
    $linkLabel = data_get($module, 'data.link_label', '');
    $target = data_get($module, 'data.target', '_self');
@endphp

<div class="mod{{ $moduleId }} modBookingWidget inlineMode"
     x-data="bookingWidget({
        nights: {{ $minNights > 3 ? $minNights : 3 }},
        adults: {{ $minAdults > 2 ? $minAdults : 2 }},
        children: {{ $minChildren }},
        infants: {{ $minInfants }},
        arrivalError: '{{ addslashes($arrivalError) }}'
     })"
     x-cloak>

    <div class="bookingInlineContainer">
        <div class="bgImage">
            <img src="{{ $mainImage }}" alt="" />
        </div>
        <div class="bookingInlineWrapper ccPage">
            <div class="ccPageInner medium">
                <div class="bookingInline flex flexWrap justifyCenter">
                    @if ($mainTitle || $mainText)
                        <div class="bookingContentContainer flex flexColumn gap30" data-stagger-child>
                            @if ($mainTitle)
                                <h3 class="bookingTitle">
                                    {{ $mainTitle }}
                                </h3>
                            @endif
                            @if ($mainText)
                                <div class="bookingText">
                                    {!! $mainText !!}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="bookingFormContainer" data-stagger-child>
                        <x-blocks.booking-form
                            :module="$module"
                            idSuffix="inline"
                            :minNights="$minNights" :maxNights="$maxNights"
                            :minAdults="$minAdults" :maxAdults="$maxAdults"
                            :minChildren="$minChildren" :maxChildren="$maxChildren"
                            :minInfants="$minInfants" :maxInfants="$maxInfants"
                            :link="$link" :target="$target"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
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
