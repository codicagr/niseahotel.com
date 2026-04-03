@php
    $modules = data_get($data,'modules',[]);
    $menuPageClass = data_get($data,'menu.page_class','');
    $metadata = data_get($data, 'metadata');
    $popups = data_get($data, 'popups', []);
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
        <div id="headerMain">
            <div class="ccPage">
                <div class="ccPageInner fullWidth">
                    <div class="headerMainInner flex flexWrap itemsCenter">
                        @if(ModuleFacade::moduleExists($modules, 'mobile-menu'))
                            <div id="mobileMenu">
                                {!! ModuleFacade::getModules($modules, 'mobile-menu') !!}
                            </div>
                        @endif
                        @if(ModuleFacade::moduleExists($modules, 'lang'))
                            <div id="lang">
                                {!!  ModuleFacade::getModules($modules, 'lang') !!}
                            </div>
                        @endif

                        <x-layout.logo />

                        @if(ModuleFacade::moduleExists($modules, 'header-right'))
                            <div id="headerRight">
                                {!!  ModuleFacade::getModules($modules, 'header-right') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="pageContent">
        @if(ModuleFacade::moduleExists($modules, 'breadcrumbs'))
            <section id="breadcrumbs">
                <div class="ccPage">
                    <div class="ccPageInner x-large">
                        {!!  ModuleFacade::getModules($modules, 'breadcrumbs') !!}
                    </div>
                </div>
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'header'))
            <section id="headerMod">
                {!!  ModuleFacade::getModules($modules, 'header') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-1'))
            <section id="top1">
                {!!  ModuleFacade::getModules($modules, 'top-1') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-2'))
            <section id="top2">
                {!!  ModuleFacade::getModules($modules, 'top-2') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-3'))
            <section id="top3">
                {!!  ModuleFacade::getModules($modules, 'top-3') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-4'))
            <section id="top4">
                {!!  ModuleFacade::getModules($modules, 'top-4') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-5'))
            <section id="top5">
                {!!  ModuleFacade::getModules($modules, 'top-5') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-6'))
            <section id="top6">
                {!!  ModuleFacade::getModules($modules, 'top-6') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-7'))
            <section id="top7">
                {!!  ModuleFacade::getModules($modules, 'top-7') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-8'))
            <section id="top8">
                {!!  ModuleFacade::getModules($modules, 'top-8') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-9'))
            <section id="top9">
                {!!  ModuleFacade::getModules($modules, 'top-9') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'top-10'))
            <section id="top10">
                {!!  ModuleFacade::getModules($modules, 'top-10') !!}
            </section>
        @endif

        <section id="pageMainContent">
            <section id="mainContentContainer">

                @if(ModuleFacade::moduleExists($modules, 'main-body-top-1'))
                    <section id="mainContentTop1">
                        {!!  ModuleFacade::getModules($modules, 'main-body-top-1') !!}
                    </section>
                @endif

                <main id="mainContent">
                    @yield('mainContent')
                </main>

                @if(ModuleFacade::moduleExists($modules, 'main-body-bottom-1'))
                    <section id="mainContentBottom1">
                        {!!  ModuleFacade::getModules($modules, 'main-body-bottom-1') !!}
                    </section>
                @endif
            </section>

            @if(ModuleFacade::moduleExists($modules, 'sidebar'))
                <aside id="sidebar">
                    {!!  ModuleFacade::getModules($modules, 'sidebar') !!}
                </aside>
            @endif
        </section>

        @if(ModuleFacade::moduleExists($modules, 'bottom-1'))
            <section id="bottom1">
                {!!  ModuleFacade::getModules($modules, 'bottom-1') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-2'))
            <section id="bottom2">
                {!!  ModuleFacade::getModules($modules, 'bottom-2') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-3'))
            <section id="bottom3">
                {!!  ModuleFacade::getModules($modules, 'bottom-3') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-4'))
            <section id="bottom4">
                {!!  ModuleFacade::getModules($modules, 'bottom-4') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-5'))
            <section id="bottom5">
                {!!  ModuleFacade::getModules($modules, 'bottom-5') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-6'))
            <section id="bottom6">
                {!!  ModuleFacade::getModules($modules, 'bottom-6') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-7'))
            <section id="bottom7">
                {!!  ModuleFacade::getModules($modules, 'bottom-7') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-8'))
            <section id="bottom8">
                {!!  ModuleFacade::getModules($modules, 'bottom-8') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-9'))
            <section id="bottom9">
                {!!  ModuleFacade::getModules($modules, 'bottom-9') !!}
            </section>
        @endif

        @if(ModuleFacade::moduleExists($modules, 'bottom-10'))
            <section id="bottom10">
                {!!  ModuleFacade::getModules($modules, 'bottom-10') !!}
            </section>
        @endif
    </div>

    <section id="footer">
        @if(ModuleFacade::moduleExists($modules, ['footer-1', 'footer-2', 'footer-3', 'footer-4']))
            <div class="footerContainer">
                <div class="footerRow borderBottom footerRow1 ccPage marginTop30">
                    <div class="ccPageInner x-large">
                        <div class="footerRowInner flex flexWrap justifySpaceBetween">
                            @if(ModuleFacade::moduleExists($modules, 'footer-1'))
                                <div class="footerColumn footer1">
                                    {!!  ModuleFacade::getModules($modules, 'footer-1') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-2'))
                                <div class="footerColumn footer2">
                                    {!!  ModuleFacade::getModules($modules, 'footer-2') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-3'))
                                <div class="footerColumn footer3">
                                    {!!  ModuleFacade::getModules($modules, 'footer-3') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-4'))
                                <div class="footerColumn footer4">
                                    {!!  ModuleFacade::getModules($modules, 'footer-4') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="cookieConsentButtonWrapper ccPage">
            <div class="ccPageInner">
                <div class="cookieConsentButton flex justifyCenter textCenter">
                    <button class="js-lcc-settings-toggle">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro 7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2026 Fonticons, Inc.--><path d="M182 185.7L130 293.1L150.6 410.8L236 493.7L353.3 510.3L458 454.3L510 346.9L489.4 229.2L404 146.3L286.7 129.7L182 185.7zM277.9 80L426.2 101L534 205.6L560 353.9L494.3 489.3L362.1 560L213.8 539L106 434.4L80 286.1L145.7 150.7L277.9 80zM272 208C289.7 208 304 222.3 304 240C304 257.7 289.7 272 272 272C254.3 272 240 257.7 240 240C240 222.3 254.3 208 272 208zM240 368C257.7 368 272 382.3 272 400C272 417.7 257.7 432 240 432C222.3 432 208 417.7 208 400C208 382.3 222.3 368 240 368zM368 368C368 350.3 382.3 336 400 336C417.7 336 432 350.3 432 368C432 385.7 417.7 400 400 400C382.3 400 368 385.7 368 368z"/></svg>
                        </span>
                        <span class="text">{{ __('cookie-consent::texts.cookies_button') }}</span>
                    </button>
                </div>
            </div>
        </div>

        @if(ModuleFacade::moduleExists($modules, 'copyrights'))
            <div id="copyrights">
                <div class="ccPage">
                    <div class="ccPageInner fullWidth">
                        {!!  ModuleFacade::getModules($modules, 'copyrights') !!}
                    </div>
                </div>
            </div>
        @endif
    </section>

    {!! PopupFacade::getPopupsHtml($popups) !!}

    @stack('footer_html_stack')

    @stack('footer_styles_stack')

    @stack('footer_scripts_stack')

    <div id="fullscreenOverlay" class="fullscreen overlay" x-data
         :class="{ 'open': $store.overlay.backdropOverlayStatus }"
         @click.stop="$store.overlay.handleToggleOverlay(false)"></div>

    @include('cms-core::site._partials.stop_impersonation')
</div>
</body>
</html>
