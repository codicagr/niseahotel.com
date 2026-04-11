@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainText = data_get($module, 'data.general.text', '');
@endphp

<div class="mod{{ $moduleId }} modPlain default floatBox">
    @if ($mainText)
        <div class="modPlainText floatBox marginTop30" data-stagger-child>
            {!! $mainText !!}
        </div>
    @endif
</div>

@pushonce('footer_styles_stack','modPlainDefault')
    @vite([
        'resources/sass/themes/default/components/modules/plain/plain-default.scss'
    ])
@endpushonce
