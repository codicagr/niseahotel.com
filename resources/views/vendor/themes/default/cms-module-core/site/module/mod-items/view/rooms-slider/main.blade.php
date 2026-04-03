@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainText = data_get($module, 'data.general.text', '');
    $mainLinkLabel = data_get($module, 'data.general.link-label', '');
    $mainLink = data_get($module, 'data.general.link', '');
    $mainTarget = data_get($module, 'data.general.target', '_self');
    $items = data_get($module, 'data.items', []);

    $slides = [];

    foreach ($items as $item) {
        $fields = BaseFacade::getSpecificFields('Item', data_get($item,'id'), [2, 3]) ?? [];
        $size = BaseFacade::UpperCase(data_get($fields, '2.values.0', ''));
        $numberOfGuests = BaseFacade::UpperCase(data_get($fields, '3.values.0', ''));

        $temp = [];
        $temp['title'] = data_get($item,'title','');
        $temp['text'] = implode(' • ', array_filter([$size, $numberOfGuests]));
        $temp['image'] = data_get($item,'intro_image','');
        $temp['link'] = BaseFacade::getLink(data_get($item,'id'), 'Item');
        array_push($slides,$temp);
    }
@endphp

@if(count($slides) > 0)
    <x-blocks.collections-slider.main
        :slides="$slides"
        :mainTitle="$mainTitle"
        :mainText="$mainText"
        :mainLink="$mainLink"
        :mainLinkLabel="$mainLinkLabel"
        :mainTarget="$mainTarget"
        :sliderId="$moduleId"
        customClass="mod{{ $moduleId }}"
    />
@endif
