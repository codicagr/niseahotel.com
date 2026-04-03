@php
    $moduleId  = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainText  = data_get($module, 'data.general.text', '');

    $rawReviews = data_get($module, 'data.review-items');
    $reviews    = is_array($rawReviews) ? $rawReviews : [];
@endphp

@if(count($reviews) > 0)
    <x-blocks.reviews-slider.main
        :reviews="$reviews"
        :mainTitle="$mainTitle"
        :mainText="$mainText"
        :sliderId="$moduleId"
        customClass="mod{{ $moduleId }}"
    />
@endif
