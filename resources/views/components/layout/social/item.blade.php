@props(['socialItem'])

@php
    $iconPath = BaseFacade::getImage(data_get($socialItem, 'icon'));
    $svgContent = $iconPath ? rescue(fn() => file_get_contents($iconPath), '') : '';
    $title = data_get($socialItem, 'title', '');
    $link = data_get($socialItem, 'link', '#');
@endphp

@if($svgContent)
    <div {{ $attributes->merge(['class' => 'socialListItem flex ' . $title]) }} data-stagger-child>
        <a class="flex justifyCenter itemsCenter"
           href="{{ $link }}"
           target="_blank"
           rel="noopener noreferrer"
           title="{{ $title }}"
           aria-label="{{ $title }}"
        >
            {!! $svgContent !!}
        </a>
    </div>
@endif
