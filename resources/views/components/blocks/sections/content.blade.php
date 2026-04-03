@props([
    'section',
    'loop' => null
])

@php
    $sectionID = data_get($section, 'section-id', '');
    $title = data_get($section, 'title');
    $text = data_get($section, 'text');
@endphp

@if ($title || $text)
    <div {{ $attributes->merge(['class' => 'itemSection floatBox content ' . data_get($section,'background') . ' ' . data_get($section,'margin') . ' ' . data_get($section,'padding') . ' ' . data_get($section,'padding-spacing')]) }}>
        <div class="sectionContentWrapper ccPage">
            <div class="ccPageInner small">
                @if ($sectionID)
                    <div id="{{ $sectionID }}" class="anchorTarget"></div>
                @endif
                <div class="sectionContentContainer flex flexWrap gap30">
                    @if ($title)
                        <div class="sectionContentTitle" data-stagger-child>
                            {!! $title !!}
                        </div>
                    @endif
                    @if ($text)
                        <div class="sectionContentText" data-stagger-child>
                            {!! $text !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
