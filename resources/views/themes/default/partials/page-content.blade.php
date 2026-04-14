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
