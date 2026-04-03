@blaze(memo: true)
@props([
    'menu',
    'index' => 0
])

@php
    $children = data_get($menu, 'children');
    $hasChildren = $children && $children->isNotEmpty();
    $isActive = data_get($menu, 'active');
    $isCurrent = data_get($menu, 'current');
    $isOpenInitially = ($isActive || $isCurrent) ? 'true' : 'false';
@endphp

<div class="menuItem menu-{{ data_get($menu, 'id') }}"
     style="--item-delay: {{ 0.2 + ($index * 0.1) }}s;"
     @if($hasChildren) x-data="{ submenuOpen: {{ $isOpenInitially }} }" @endif>

    <div class="menuItemInner flex justifySpaceBetween itemsCenter">
        @if (data_get($menu, 'menu_operation_slug') == 'separator-operation')
            <span class="{{ data_get($menu, 'class') }}">
                {{ data_get($menu, 'title') }}
            </span>
        @else
            <a class="{{ data_get($menu, 'class') }} {{ $isActive ? 'active' : '' }} {{ $isCurrent ? 'current' : '' }}"
               href="{{ data_get($menu, 'link') }}"
               target="{{ data_get($menu, 'target') }}">
                {{ data_get($menu, 'title') }}
            </a>
        @endif

        @if($hasChildren)
            <button class="submenuToggle flex itemsCenter justifyCenter"
                    @click.prevent="submenuOpen = !submenuOpen"
                    aria-label="Toggle Submenu">
                <svg :class="{ 'rotate180': submenuOpen }" width="25" height="25" viewBox="0 0 10 6">
                    <path d="M1 1L5 5L9 1" stroke="currentColor" fill="none"></path>
                </svg>
            </button>
        @endif
    </div>

    @if($hasChildren)
        <div class="submenuContainer" x-show="submenuOpen" x-collapse x-cloak>
            <div class="submenuList flex flexColumn">
                @foreach ($children as $child)
                    <x-layout.burger-menu.item :menu="$child" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    @endif
</div>
