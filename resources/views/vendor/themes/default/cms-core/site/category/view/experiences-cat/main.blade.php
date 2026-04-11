@extends('themes.default.layout.main')
@php
    $category = data_get($data,'record', []);
    $id = data_get($category,'id');
    $options = data_get($data,'options', []);
    $itemsData = ContentFacade::getItems($id, $options);
    $subcategories = data_get($data, 'subCategoriesAndItems.subcategories',[]);

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
    <section class="categoryViewContainer experiences category-{{ $id }}"
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
                        @forelse ($subcategories as $subcategory)
                            @php
                                $subcategoryId = data_get($subcategory,'id', '');
                                $fields = BaseFacade::getFields('Category',$subcategoryId) ?? [];
                                $subcategoryImage = BaseFacade::getImage(data_get($fields,'39.values.0',''));
                                $subcategoryAlt = data_get($fields,'40.values.0','') ?: data_get($subcategory, 'title');
                                $subcategoryLinkLabel = data_get($fields,'38.values.0','') ?: __('site/general.discover_more');
                                $currentDirection = $loop->odd ? 'imageRight' : 'imageLeft';
                            @endphp

                            <x-blocks.showcase-item
                                :itemId="$subcategoryId"
                                :direction="$currentDirection"
                                :image="$subcategoryImage"
                                :imageLink="true"
                                :alt="$subcategoryAlt"
                                :title="data_get($subcategory, 'title', '')"
                                :titleLink="true"
                                :text="data_get($subcategory,'text','')"
                                :link="BaseFacade::getLink($subcategoryId, 'Category')"
                                :linkLabel="$subcategoryLinkLabel"
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

@pushonce('header_styles_stack','experiencesCategory')
    @vite([
        'resources/sass/themes/default/components/content/experiences/experiences-category.scss'
    ])
@endpushonce
