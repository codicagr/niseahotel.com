@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mode = data_get($module, 'data.mode', -1);
    $type = data_get($module, 'data.type', -1);
    $menus = data_get($module, 'data.menus', []);
@endphp

@if ($mode == 2 || $type == 0)
    <div class="mod{{ $moduleId }} footerElement footerMenuContainer flex flexColumn">
        @if($mainTitle != '')
            <div class="footerTitle" data-stagger-child>
                {{ $mainTitle }}
            </div>
        @endif
        <div class="footerMenu flex flexColumn">
            @foreach ($menus as $menu)
                <x-layout.footer-menu.item :menu="$menu" />
            @endforeach
        </div>
    </div>
@endif
