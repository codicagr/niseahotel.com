@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainText = data_get($module, 'data.general.text', '');

    $rawSections = data_get($module, 'data.sections');
    $slides = is_array($rawSections) ? $rawSections : [];
@endphp

@if(count($slides) > 0)
    <x-blocks.collections-slider.main
        :slides="$slides"
        :mainTitle="$mainTitle"
        :mainText="$mainText"
        :sliderId="$moduleId"
        customClass="mod{{ $moduleId }}"
        :linkLabel="__('site/general.discover_more')"
    />
@endif
