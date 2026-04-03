@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainText = data_get($module, 'data.general.text', '');
    $mainImage = \BaseFacade::getImage(data_get($module, 'data.general.image', ''));
    $alt = data_get($module, 'data.general.alt-text', '');
    $mainLinkLabel = data_get($module, 'data.general.link-label', '');
    $mainLink = data_get($module, 'data.general.link', '');
    $mainTarget = data_get($module, 'data.general.target', '_self');
@endphp

<div class="mod{{ $moduleId }} modPlain homeRooms mainWrapper">
    <div class="ccPage">
        <div class="ccPageInner x-large">
            <div class="homeRoomsContainer">
                <div class="homeRoomsImageContainer">
                    <div class="homeRoomsImage">
                        @if ($mainLink)
                            <a href="{{ $mainLink }}" target="{{ $mainTarget }}">
                                <img src="{{ $mainImage }}" alt="{{ $alt }}" />
                            </a>
                        @else
                            <img src="{{ $mainImage }}" alt="{{ $alt }}" />
                        @endif
                    </div>
                </div>
                <div class="homeRoomsContentContainer flex flexWrap gap25">
                    @if ($mainTitle)
                        <div class="homeRoomsTitle" data-stagger-child>
                            {{ $mainTitle }}
                        </div>
                    @endif
                    @if ($mainText)
                        <div class="homeRoomsText" data-stagger-child>
                            {!! $mainText !!}
                        </div>
                    @endif
                    @if ($mainLink && $mainLinkLabel)
                        <a class="generalButton bigButton marginTop20" href="{{ $mainLink }}" target="{{ $mainTarget }}" data-stagger-child>
                            {{ $mainLinkLabel }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@pushonce('footer_styles_stack','modHomeRooms')
    @vite([
        'resources/sass/themes/default/components/modules/home-rooms/home-rooms.scss'
    ])
@endpushonce
