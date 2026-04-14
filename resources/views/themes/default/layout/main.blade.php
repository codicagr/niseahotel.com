@php
    $modules       = data_get($data, 'modules', []);
    $menuPageClass = data_get($data, 'menu.page_class', '');
    $metadata      = data_get($data, 'metadata');
    $popups        = data_get($data, 'popups', []);
    \Illuminate\Support\Facades\View::share('modules', $modules);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('themes.default.partials.head', ['metadata' => $metadata])
        @include('themes.default.partials.marketing')
    </head>
    <body class="{{ $menuPageClass }} @stack('bodyClasses')">
        <div class="floatBox">
            @include('themes.default.partials.header')

            @include('themes.default.partials.page-content')

            @include('themes.default.partials.footer')

            {!! PopupFacade::getPopupsHtml($popups) !!}

            @stack('footer_html_stack')
            @stack('footer_styles_stack')
            @stack('footer_scripts_stack')

            @include('cms-core::site._partials.stop_impersonation')
        </div>
    </body>
</html>
