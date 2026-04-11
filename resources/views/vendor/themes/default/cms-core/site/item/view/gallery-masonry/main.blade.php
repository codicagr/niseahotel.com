@extends('themes.default.layout.main')

@php
    $item = data_get($data,'record', []);
    $id = data_get($item,'id');
    $modules = data_get($data,'modules',[]);
    $menu = data_get($data,'menu',[]);
    $image = BaseFacade::getImage(data_get($item,'image'));
    $alt = data_get($item,'image_alt','');
    if ($alt == '') {
        $alt = data_get($item,'title');
    }

    $fields = BaseFacade::getFields('Item',$id) ?? [];
    $leadTitle = data_get($fields,'9.values.0','');
    $leadText = data_get($fields,'10.values.0','');
    $text = data_get($item,'fulltext', '');
    $roomImages = data_get($fields,'13.values.0',[]);
    $preGalleryTitle = data_get($fields,'14.values.0','');
    $preGalleryText = data_get($fields,'15.values.0','');
    $sections = data_get($fields, '37.values.0', []);

    $galleryImages = [
        '01' => ['image' => 'files/gallery/images/nisea_hotel_samos_001.jpg',],
        '02' => ['image' => 'files/gallery/images/nisea_hotel_samos_002.jpg',],
        '03' => ['image' => 'files/gallery/images/nisea_hotel_samos_003.jpg',],
        '05' => ['image' => 'files/gallery/images/nisea_hotel_samos_005.jpg',],
        '06' => ['image' => 'files/gallery/images/nisea_hotel_samos_006.jpg',],
        '07' => ['image' => 'files/gallery/images/nisea_hotel_samos_007.jpg',],
        '08' => ['image' => 'files/gallery/images/nisea_hotel_samos_008.jpg',],
        '09' => ['image' => 'files/gallery/images/nisea_hotel_samos_009.jpg',],
        '10' => ['image' => 'files/gallery/images/nisea_hotel_samos_010.jpg',],
        '11' => ['image' => 'files/gallery/images/nisea_hotel_samos_011.jpg',],
        '12' => ['image' => 'files/gallery/images/nisea_hotel_samos_012.jpg',],
        '13' => ['image' => 'files/gallery/images/nisea_hotel_samos_013.jpg',],
        '14' => ['image' => 'files/gallery/images/nisea_hotel_samos_014.jpg',],
        '15' => ['image' => 'files/gallery/images/nisea_hotel_samos_015.jpg',],
        '16' => ['image' => 'files/gallery/images/nisea_hotel_samos_016.jpg',],
        '17' => ['image' => 'files/gallery/images/nisea_hotel_samos_017.jpg',],
        '18' => ['image' => 'files/gallery/images/nisea_hotel_samos_018.jpg',],
        '19' => ['image' => 'files/gallery/images/nisea_hotel_samos_019.jpg',],
        '20' => ['image' => 'files/gallery/images/nisea_hotel_samos_020.jpg',],
        '21' => ['image' => 'files/gallery/images/nisea_hotel_samos_021.jpg',],
    ];
@endphp

@section('mainContent')
    <article class="itemViewContainer location item{{ $id }} paddingBottom120"
         x-data="{
            scrollY: 0,
            get blurAmount() {
                const h = this.$refs.headerContainer ? this.$refs.headerContainer.offsetHeight : window.innerHeight;
                if (this.scrollY > 10 && this.scrollY <= h) {
                    return this.scrollY / 20;
                }
                return 0;
            },
            get imageScale() {
                return 1.05 + (this.scrollY / 4000);
            },
            get titleOffset() {
                if (!this.$refs.headerContainer || !this.$refs.titleWrapper) return 0;
                const containerHeight = this.$refs.headerContainer.offsetHeight;
                const titleHeight = this.$refs.titleWrapper.offsetHeight;
                const paddingBottom = 60;
                const maxOffset = (containerHeight / 2) - (titleHeight / 2) - paddingBottom;
                if (maxOffset <= 0) return 0;
                return Math.min(this.scrollY, maxOffset);
            },
            get overlayOpacity() {
                return Math.min(0.2 + (this.scrollY / 1000), 0.5);
            }
         }"
         @scroll.window="scrollY = window.scrollY"
    >

        <x-blocks.page-header
            class="mainWrapper"
            :image="$image"
            :alt="$alt"
            :title="data_get($item, 'title')"
        />

        <x-blocks.page-lead
            :title="$leadTitle"
            :text="$leadText"
        />

        <x-blocks.gallery-masonry.main
            :images="$galleryImages"
        />

    </article>
@endsection

@pushonce('header_styles_stack','locationItem')
    @vite([
        'resources/sass/themes/default/components/content/locations/locations-item.scss'
    ])
@endpushonce
