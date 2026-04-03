@props(['menu'])

@php
    $id = data_get($menu, 'id');
    $isSeparator = data_get($menu, 'menu_operation_slug') == 'separator-operation';
    $customClass = data_get($menu, 'class', '');
    $title = data_get($menu, 'title', '');
    $stateClass = data_get($menu, 'active') ? 'active' : (data_get($menu, 'current') ? 'current' : '');
@endphp

<div {{ $attributes->merge(['class' => "menuItem menu-{$id} {$stateClass}"]) }} data-stagger-child>
    @if ($isSeparator)
        <span class="{{ $customClass }}">
            {{ $title }}
        </span>
    @else
        <a class="{{ $customClass }}"
           href="{{ data_get($menu, 'link', '#') }}"
           target="{{ data_get($menu, 'target', '_self') }}">
            {{ $title }}
        </a>
    @endif
</div>
