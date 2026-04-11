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
@endphp

@section('mainContent')
    <article class="itemViewContainer page item{{ $id }}"
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

        @foreach ($sections as $section)
            @php $sectionType = data_get($section, 'type', ''); @endphp

            @if($sectionType)
                <x-dynamic-component
                    :component="'blocks.sections.' . $sectionType"
                    :section="$section"
                    :loop="$loop"
                />
            @endif
        @endforeach

    </article>
@endsection

@pushonce('header_styles_stack','pageItem')
    @vite([
        'resources/sass/themes/default/components/content/pages/pages-item.scss'
    ])
@endpushonce
