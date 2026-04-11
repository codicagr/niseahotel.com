@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainSubtitle = data_get($module, 'data.general.subtitle', '');
    $mainText = data_get($module, 'data.general.text', '');
    $mainImage = \BaseFacade::getImage(data_get($module, 'data.general.image', ''));
    $alt = data_get($module, 'data.general.alt-text', '');
    $linkLabel = data_get($module, 'data.general.link-label', '');
@endphp

<div class="mod{{ $moduleId }} modPlain booking">
    <div class="bookingInlineContainer">
        <div class="bgImage">
            <img src="{{ $mainImage }}" alt="" />
        </div>
        <div class="bookingInlineWrapper ccPage">
            <div class="ccPageInner medium">
                <div class="bookingInline flex flexWrap justifyCenter">
                    @if ($mainTitle || $mainSubtitle)
                        <div class="bookingContentContainer flex flexColumn gap30" data-stagger-child>
                            @if ($mainTitle)
                                <h3 class="bookingTitle">
                                    {{ $mainTitle }}
                                </h3>
                            @endif
                            @if ($mainSubtitle)
                                <div class="bookingSubtitle">
                                    {!! $mainSubtitle !!}
                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($mainText)
                        <div class="bookingDetailsContainer" data-stagger-child>
                            <div class="bookingText">
                                {!! $mainText !!}
                            </div>
                            @if ($linkLabel)
                                <div class="bookingButton flex" x-data>
                                    <a href="#" class="generalButton primary bigButton"
                                       @click.prevent="$dispatch('open-booking-popup')">
                                        {{ $linkLabel }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@pushonce('footer_styles_stack','modPlainBooking')
    @vite([
        'resources/sass/themes/default/components/modules/plain/plain-booking.scss'
    ])
@endpushonce
