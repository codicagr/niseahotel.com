@props([
    'section',
    'loop' => null
])

@php
    $sectionID = data_get($section, 'section-id', '');
    $selectedDirection = data_get($section, 'image-direction', 'auto');
    $finalDirection = $selectedDirection === 'auto'
                        ? ($loop->odd ? 'imageLeft' : 'imageRight')
                        : $selectedDirection;
@endphp

<div {{ $attributes->merge(['class' => 'itemSection floatBox showcase-item ' . data_get($section,'background') . ' ' . data_get($section,'margin') . ' ' . data_get($section,'padding') . ' ' . data_get($section,'padding-spacing')]) }}>
    <div class="sectionContentWrapper ccPage">
        <div class="ccPageInner x-large">
            @if ($sectionID)
                <div id="{{ $sectionID }}" class="anchorTarget"></div>
            @endif
            <div class="sectionItems flex flexWrap">
                <x-blocks.showcase-item
                    :direction="$finalDirection"
                    :image="BaseFacade::getImage(data_get($section,'image'))"
                    :alt="data_get($section, 'title')"
                    :title="data_get($section, 'title')"
                    :text="data_get($section, 'text')"
                />
            </div>
        </div>
    </div>
</div>
