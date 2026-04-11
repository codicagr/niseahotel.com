@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $link = data_get($module, 'data.general.link', '');
    $linkLabel = data_get($module, 'data.general.link-label', '');
    $target = data_get($module, '$data.general.target', '_self');
@endphp

<div class="mod{{ $moduleId }} modPlain telephone">
    <div class="telephoneButton">
        <a href="{{ $link }}" target="{{ $target }}" aria-label="{{ $linkLabel }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2026 Fonticons, Inc.--><path d="M231.2 280L288 224L192 64L64 128L64 144C64 382.6 257.4 576 496 576L512 576L576 448L416 352L360 408.8C300.8 386 254 339.2 231.2 280zM421.1 392.4L534.1 460.2L492.2 544C274.3 542 98 365.7 96 147.8L179.8 105.9L247.6 218.9C217.7 248.4 199.8 266.1 193.8 272L201.3 291.6C227.3 359.2 280.8 412.7 348.4 438.7L368 446.2C373.9 440.2 391.6 422.3 421 392.4z"/></svg>
        </a>
    </div>
</div>

@pushonce('footer_styles_stack','modPlainTelephone')
    @vite([
        'resources/sass/themes/default/components/modules/plain/plain-telephone.scss'
    ])
@endpushonce
