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
            <section id="header">
                <div id="header-main">
                    <div class="ccPage">
                        <div class="ccPageInner fullWidth">
                            <div class="headerMainInner flex flexWrap itemsCenter">
                                <x-layout.module-position position="mobile-menu" />
                                <x-layout.module-position position="lang" />
                                <x-layout.logo />
                                <x-layout.module-position position="header-right" class="flex flexWrap itemsCenter" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div id="page-content">

                <x-layout.module-position position="breadcrumbs" container container-size="x-large" />

                <x-layout.module-position position="header" id="header-mod" />

                @for($i = 1; $i <= 10; $i++)
                    <x-layout.module-position :position="'top-'.$i" />
                @endfor

                <section id="page-main-content">
                    <section id="main-content-container">

                        <x-layout.module-position position="main-body-top-1" />

                        <main id="main-content">
                            @yield('mainContent')
                        </main>

                        <x-layout.module-position position="main-body-bottom-1" />

                    </section>

                    <x-layout.module-position position="sidebar" tag="aside" />
                </section>

                @for($i = 1; $i <= 10; $i++)
                    <x-layout.module-position :position="'bottom-'.$i" />
                @endfor

            </div>

            <section id="footer">
                <div class="footerContainer">
                    <div class="footerRow borderBottom footerRow1 ccPage marginTop30">
                        <div class="ccPageInner x-large">
                            <div class="footerRowInner flex flexWrap justifySpaceBetween">
                                @for($i = 1; $i <= 4; $i++)
                                    <x-layout.module-position :position="'footer-'.$i" :class="'footerColumn footer-'.$i" />
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cookieConsentButtonWrapper ccPage">
                    <div class="ccPageInner">
                        <div class="cookieConsentButton flex justifyCenter textCenter">
                            <button class="js-lcc-settings-toggle">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M182 185.7L130 293.1L150.6 410.8L236 493.7L353.3 510.3L458 454.3L510 346.9L489.4 229.2L404 146.3L286.7 129.7L182 185.7zM277.9 80L426.2 101L534 205.6L560 353.9L494.3 489.3L362.1 560L213.8 539L106 434.4L80 286.1L145.7 150.7L277.9 80zM272 208C289.7 208 304 222.3 304 240C304 257.7 289.7 272 272 272C254.3 272 240 257.7 240 240C240 222.3 254.3 208 272 208zM240 368C257.7 368 272 382.3 272 400C272 417.7 257.7 432 240 432C222.3 432 208 417.7 208 400C208 382.3 222.3 368 240 368zM368 368C368 350.3 382.3 336 400 336C417.7 336 432 350.3 432 368C432 385.7 417.7 400 400 400C382.3 400 368 385.7 368 368z"/></svg>
                                </span>
                                <span class="text">{{ __('cookie-consent::texts.cookies_button') }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <x-layout.module-position position="copyrights" container container-size="fullWidth" />
            </section>

            {!! PopupFacade::getPopupsHtml($popups) !!}

            @stack('footer_html_stack')
            @stack('footer_styles_stack')
            @stack('footer_scripts_stack')

            @include('cms-core::site._partials.stop_impersonation')
        </div>
    </body>
</html>
