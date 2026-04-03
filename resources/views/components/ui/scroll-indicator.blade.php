@props([
    'label' => BaseFacade::UpperCase(__('site/general.discover_more'))
])

<div {{ $attributes->merge(['class' => 'scrollIndicator flex flexColumn itemsCenter gap10', 'style' => 'transition: opacity 0.3s ease, visibility 0.3s ease;']) }}
     x-data="{ show: window.scrollY < 50 }"
     @scroll.window="show = window.scrollY < 50"
     :class="show ? '' : 'invisible'"
     x-cloak
>

    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 36" class="mouseIcon">
        <rect x="5" y="2" width="14" height="32" rx="7" fill="none" stroke="currentColor" stroke-width="2" />
        <rect class="scrollWheel" x="11" y="8" width="2" height="4" rx="1" fill="currentColor" />
    </svg>

    <div class="scrollLabel">
        {{ $label }}
    </div>
</div>
