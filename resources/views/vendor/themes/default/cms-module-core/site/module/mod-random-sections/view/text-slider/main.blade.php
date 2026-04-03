@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainLinkLabel = data_get($module, 'data.general.link-label', '');
    $mainLink = data_get($module, 'data.general.link', '');
    $mainTarget = data_get($module, 'data.general.target', '_self');

    $rawSections = data_get($module, 'data.sections');
    $slides = is_array($rawSections) ? $rawSections : [];
@endphp

@if(count($slides) > 0)
    <x-blocks.text-slider.main
        :slides="$slides"
        :title="$mainTitle"
        :mainLink="$mainLink"
        :mainLinkLabel="$mainLinkLabel"
        :mainTarget="$mainTarget"
        :sliderId="$moduleId"
        customClass="mod{{ $moduleId }}"
    />
@endif
