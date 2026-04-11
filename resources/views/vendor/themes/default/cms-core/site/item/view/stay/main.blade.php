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
    $size = data_get($fields,'2.values.0','');
    $numberOfGuests = data_get($fields,'3.values.0','');
    $sleepingArrangements = data_get($fields,'4.values.0','');
    $roomCode = data_get($fields,'6.values.0','');
    $leadTitle = data_get($fields,'9.values.0','');
    $leadText = data_get($fields,'10.values.0','');
    $amenities = data_get($fields,'11.values.0',[]);
    $amenitiesImage = BaseFacade::getImage(data_get($fields,'12.values.0',[]));
    $roomImages = data_get($fields,'13.values.0',[]);
    $preGalleryTitle = data_get($fields,'14.values.0','');
    $preGalleryText = data_get($fields,'15.values.0','');
    $extraInfo = data_get($fields,'16.values.0','');
    $upgradeId = data_get($fields,'20.values.0','');

    $locale = app('laravellocalization')->getCurrentLocale();
    $projectOptions = (\GlobalOptionsFacade::getOptions('project'));
    $bookingEngineUrl = data_get($projectOptions,'booking_engine_url_'.$locale,'');

    if ($bookingEngineUrl != '' && $roomCode != '') {
        $bookingLink = $bookingEngineUrl.'&room='.$roomCode;
    } else {
        $bookingLink = '';
    }
@endphp

@section('mainContent')
    <article class="itemViewContainer stay item{{ $id }} paddingBottom120"
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
            :image="$image"
            :alt="$alt"
            :title="data_get($item, 'title')"
        />

        <x-blocks.stay.item.room-highlights
            :size="$size"
            :guests="$numberOfGuests"
            :sleeping="$sleepingArrangements"
        />

        <x-blocks.page-lead
            :title="$leadTitle"
            :text="$leadText"
        />

        <x-blocks.stay.item.amenities-section
            :amenities="$amenities"
            :image="$amenitiesImage"
        />

        <x-blocks.item-gallery.main
            :slides="$roomImages"
            :title="$preGalleryTitle"
            :text="$preGalleryText"
            :itemTitle="data_get($item,'title')"
        />

        <x-blocks.extra-info
            :title="__('site/general.good_to_know')"
            :text="$extraInfo"
        />

        <x-blocks.stay.item.upgrade-stay
            :upgrade-id="$upgradeId"
        />

        {{--<x-blocks.stay.item.booking-bar
            :booking-link="$bookingLink"
            :title="data_get($item, 'title')"
            :guests="$numberOfGuests"
        />--}}

    </article>
@endsection

@pushonce('header_styles_stack','stayItem')
    @vite([
        'resources/sass/themes/default/components/content/stay/stay-item.scss'
    ])
@endpushonce
