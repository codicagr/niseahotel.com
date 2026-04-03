@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $items = data_get($module, 'data.social-items', []);
@endphp

<div class="mod{{ $moduleId }} socialWrapper footer footerElement flex flexColumn">
    @if($mainTitle != '')
        <div class="footerTitle" data-stagger-child>
            {{ $mainTitle }}
        </div>
    @endif
    <div class="socialList flex">
        @foreach ($items as $item)
            <x-layout.social.item
                :socialItem="$item"
            />
        @endforeach
    </div>
</div>
