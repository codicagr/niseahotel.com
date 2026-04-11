@extends('themes.default.layout.main')
@php
    $category = data_get($data,'record', []);
    $id = data_get($category,'id');
    $options = data_get($data,'options', []);
    $itemsData = ContentFacade::getItems($id, $options);
    $items = data_get($itemsData, 'items', collect([]));

    $image = BaseFacade::getImage(data_get($category,'image',''));
    $alt = data_get($category,'image_alt','');
    if ($alt == '') {
        $alt = data_get($category,'title');
    }

    $fields = BaseFacade::getFields('Category',$id) ?? [];
    $leadTitle = data_get($fields,'7.values.0','');
    $leadText = data_get($fields,'8.values.0','');

    $locale = app('laravellocalization')->getCurrentLocale();
    $projectOptions = (\GlobalOptionsFacade::getOptions('project'));
    $bookingEngineUrl = data_get($projectOptions,'booking_engine_url_'.$locale,'');
@endphp

@section('mainContent')
    <section class="categoryViewContainer stay category-{{ $id }}"
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
            :title="data_get($category, 'title')"
        />

        <x-blocks.page-lead
            :title="$leadTitle"
            :text="$leadText"
        />

        <div class="categoryMainWrapper ccPage">
            <div class="ccPageInner x-large">
                <div class="categoryMainWrapperInner">
                    <div class="categoryItemsContainer flex flexWrap">
                        <div class="categoryItems flex flexWrap">
                            @forelse ($items as $item)
                                <x-blocks.stay.category.item
                                    :item="$item"
                                    :booking-engine-url="$bookingEngineUrl"
                                />
                            @empty
                                <div class="noItemsFound textCenter paddingBottom50 paddingTop50">
                                    {{ __('site/general.no_items_found') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@pushonce('header_styles_stack','stayCategory')
    @vite([
        'resources/sass/themes/default/components/content/stay/stay-category.scss'
    ])
@endpushonce
