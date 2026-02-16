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
    <section id="header" @if(ModuleFacade::moduleExists($modules, 'breadcrumb')) class="nobreadcrumb" @endif>
        <div id="headerTop">
            <div class="ccPage">
                <div class="ccPageInner x-large">
                    <div class="headerTopContainer flex flexWrap justifySpaceBetween itemsCenter">
                        <div class="headerTopLeft flex itemsCenter">
                            @if(ModuleFacade::moduleExists($modules, 'top-info'))
                                {!!  ModuleFacade::getModules($modules, 'top-info') !!}
                            @endif
                        </div>
                        <div class="headerTopRight flex itemsCenter">
                            @if(ModuleFacade::moduleExists($modules, ['account', 'wishlist', 'notifications']))
                                <div class="headerButtonsContainer flex justifyEnd itemsCenter">
                                    @if(ModuleFacade::moduleExists($modules, 'wishlist'))
                                        {!! ModuleFacade::getModules($modules, 'wishlist') !!}
                                    @endif
                                    @if(ModuleFacade::moduleExists($modules, 'notifications'))
                                        {!! ModuleFacade::getModules($modules, 'notifications') !!}
                                    @endif
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'lang'))
                                <div id="lang">
                                    {!!  ModuleFacade::getModules($modules, 'lang') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(ModuleFacade::moduleExists($modules, 'top-menu'))
            <div id="headerTopMenu">
                {!!  ModuleFacade::getModules($modules, 'top-menu') !!}
            </div>
        @endif

        <div id="headerMain">
            <div class="ccPage">
                <div class="ccPageInner x-large">
                    <div class="headerMainInner flex flexWrap itemsCenter">
                        <div id="mobileMenuContainer" class="mobileMenuContainer"></div>
                        @if(ModuleFacade::moduleExists($modules, 'mobile-info'))
                            <div id="mobileInfo">
                                {!! ModuleFacade::getModules($modules, 'mobile-info') !!}
                            </div>
                        @endif
                        @if (View::exists('site._partials.logo.main'))
                            @include('site._partials.logo.main')
                        @else
                            <div id="headerLogo" class="logoContainer">
                                <a class="logo" href="{{ URL::to(app('laravellocalization')->getCurrentLocale()) }}">
                                    <img
                                            style="filter: brightness(0) saturate(100%) invert(34%) sepia(98%) saturate(723%) hue-rotate(180deg) brightness(98%) contrast(96%);"
                                            src="{{ asset('vendor/cms-core/themes/images/logo/codica.png') }}"/>
                                </a>
                            </div>
                        @endif
                        @if(ModuleFacade::moduleExists($modules, 'search'))
                            <div id="searchContainer">
                                {!! ModuleFacade::getModules($modules, 'search') !!}
                            </div>
                        @endif
                        @if(ModuleFacade::moduleExists($modules, 'account'))
                            <div id="accountContainer">
                                {!! ModuleFacade::getModules($modules, 'account') !!}
                            </div>
                        @endif
                        @if(ModuleFacade::moduleExists($modules, 'cart'))
                            <div id="cart">
                                {!!  ModuleFacade::getModules($modules, 'cart') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div id="headerNav" class="ccPage">
            <div class="ccPageInner x-large">
                @if(ModuleFacade::moduleExists($modules, 'header-nav'))
                    {!!  ModuleFacade::getModules($modules, 'header-nav') !!}
                @endif
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

    <section id="footer" class="paddingTop20 paddingBottom20">
        <div class="footerContainer">
            @if(ModuleFacade::moduleExists($modules, ['footer-1', 'footer-2', 'footer-3', 'footer-4']))
                <div class="footerRow borderBottom footerRow1 ccPage marginTop30">
                    <div class="ccPageInner">
                        <div class="footerRowInner flex flexWrap">
                            @if(ModuleFacade::moduleExists($modules, 'footer-1'))
                                <div class="footerColumn footer1 marginBottom50">
                                    {!!  ModuleFacade::getModules($modules, 'footer-1') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-2'))
                                <div class="footerColumn footer2 marginBottom50">
                                    {!!  ModuleFacade::getModules($modules, 'footer-2') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-3'))
                                <div class="footerColumn footer3 marginBottom50">
                                    {!!  ModuleFacade::getModules($modules, 'footer-3') !!}
                                </div>
                            @endif
                            @if(ModuleFacade::moduleExists($modules, 'footer-4'))
                                <div class="footerColumn footer4 marginBottom50">
                                    {!!  ModuleFacade::getModules($modules, 'footer-4') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if(ModuleFacade::moduleExists($modules, 'copyrights'))
        <div id="copyrights">
            <div class="ccPage">
                <div class="ccPageInner x-large">
                    {!!  ModuleFacade::getModules($modules, 'copyrights') !!}
                </div>
            </div>
        </div>
    @endif

    @include('cms-core::site.cookie-consent.partials.layout-button')

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
