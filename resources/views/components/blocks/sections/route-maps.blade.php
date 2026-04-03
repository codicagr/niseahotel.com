@props([
    'section',
    'loop' => null
])

<div {{ $attributes->merge(['class' => 'itemSection floatBox route-maps ' . data_get($section,'background') . ' ' . data_get($section,'margin') . ' ' . data_get($section,'padding') . ' ' . data_get($section,'padding-spacing')]) }}>
    <div class="routeMapsModule" x-data="{ activeTab: 'airport' }" x-cloak>
        <div class="mapTabs flex justifyCenter itemsCenter">
            <div class="switchContainer flex justifyCenter">
                <button type="button" class="tabBtn" :class="{ 'active': activeTab === 'airport' }" @click="activeTab = 'airport'">
                    {{ BaseFacade::UpperCase(__('site/general.from_the_airport')) }}
                </button>
                <button type="button" class="tabBtn" :class="{ 'active': activeTab === 'port' }" @click="activeTab = 'port'">
                    {{ BaseFacade::UpperCase(__('site/general.from_the_port')) }}
                </button>
            </div>
        </div>
        <div class="mapsContainer floatBox">
            <div class="mapTabContent" x-show="activeTab === 'airport'" x-transition.opacity>
                <div class="iframeWrapper floatBox">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d50512.529057435066!2d26.900304132631536!3d37.69542248311281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x14bc3d8e00eb1d0d%3A0x5180be1f0f0d68d6!2zzprPgc6xz4TOuc66z4zPgiDOkc61z4HOv867zrnOvM6tzr3Osc-CIM6jzqzOvM6_z4UgwqvOkc-Bzq_Pg8-EzrHPgc-Hzr_PgiDOvyDOo86szrzOuc6_z4LCuywgU2Ftb3MgQXJpc3RhcmNob3MgSW50bCBBaXJwb3J0LCBTYW1vcyBJbnRlcm5hdGlvbmFsIEFpcnBvcnQgIkFyaXN0YXJjaG9zIG9mIFNhbW9zIiBPcGVyYXRlZCBieSBGcmFwb3J0IEdyZWVjZSAoU01JLCBTYW1vcyA4MzEgMDM!3m2!1d37.6894078!2d26.9143682!4m5!1s0x14bc3d4703c79635%3A0x594e5a00801c8dae!2sNisea%20Hotel%20Samos%2C%20Mesokampos%20831%2003!3m2!1d37.7009336!2d26.9684304!5e0!3m2!1sen!2sgr!4v1773434899414!5m2!1sen!2sgr" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="mapTabContent" x-show="activeTab === 'port'" x-transition.opacity>
                <div class="iframeWrapper floatBox">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d100948.91367612014!2d26.75129065396001!3d37.751271200667766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x14bc420ad94bfc09%3A0x9387fc7d923b0649!2sLimenas%20Karlovasi%2C%20Karlovasi%20832%2000!3m2!1d37.795!2d26.68!4m5!1s0x14bc3d4703c79635%3A0x594e5a00801c8dae!2sNisea%20Hotel%20Samos%2C%20Mesokampos%20831%2003!3m2!1d37.7009336!2d26.9684304!5e0!3m2!1sen!2sgr!4v1773435249533!5m2!1sen!2sgr" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@pushonce('header_styles_stack','routeMapsModule')
    @vite(['resources/sass/themes/default/components/elements/route-maps/route-maps.scss'])
@endpushonce
