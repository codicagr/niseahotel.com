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
@endphp

@section('mainContent')
    <section class="categoryViewContainer amenities category-{{ $id }}"
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
                <div class="categoryItemsContainer">
                    <div class="categoryItems flex flexWrap">
                        @forelse ($items as $item)
                            @php
                                $itemId = data_get($item,'id', '');
                                $fields = BaseFacade::getFields('Item',$itemId) ?? [];
                                $basicCharacteristics = data_get($fields,'21.values.0','');
                                $detailsLinkType = data_get($fields,'22.values.0','');
                                $detailsLinkLabel = data_get($fields,'23.values.0','');
                                $detailsMenuLink = data_get($fields,'24.values.0','');
                                $detailsCustomLink = data_get($fields,'25.values.0','');
                                $detailsLinkTarget = data_get($fields,'26.values.0','_self');

                                if ($detailsLinkType === 'menu' && $detailsMenuLink != '') {
                                    $detailsLink = BaseFacade::getLink($detailsMenuLink, 'Menu');
                                } elseif ($detailsLinkType === 'custom' && $detailsCustomLink != '') {
                                    $detailsLink = $detailsCustomLink;
                                } else {
                                    $detailsLink = '';
                                }

                                $currentDirection = $loop->odd ? 'imageRight' : 'imageLeft';
                            @endphp

                            <x-blocks.showcase-item
                                :itemId="$itemId"
                                :direction="$currentDirection"
                                :image="BaseFacade::getImage(data_get($item,'intro_image'))"
                                :alt="data_get($item, 'intro_image_alt') ?: data_get($item, 'title')"
                                :title="data_get($item, 'title', '')"
                                :text="data_get($item,'introtext','')"
                                :secondaryText="data_get($fields,'21.values.0','')"
                                :link="$detailsLink"
                                :linkLabel="$detailsLinkLabel"
                                :target="$detailsLinkTarget"
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
    </section>
@endsection

@pushonce('header_styles_stack','amenitiesCategory')
    @vite([
        'resources/sass/themes/default/components/content/amenities/amenities-category.scss'
    ])
@endpushonce
