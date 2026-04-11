@props([
    'images' => [],
    'customClass' => '',
    'fancyboxGroup' => 'masonry-gallery',
])

@php
    $gridId = 'masonry-grid-' . uniqid();
@endphp

@if(count($images) > 0)
    <section class="galleryMasonrySection {{ $customClass }}" x-data="masonryGalleryInit('{{ $gridId }}')">
        <div class="ccPage">
            <div class="ccPageInner fullWidth">
                <div class="masonryGrid" id="{{ $gridId }}">
                    @foreach($images as $image)
                        @php
                            $imgUrl = \BaseFacade::getImage(data_get($image, 'image', ''));
                            $imgTitle = data_get($image, 'title', '');
                        @endphp

                        @if($imgUrl)
                            <x-blocks.gallery-masonry.item
                                :imgUrl="$imgUrl"
                                :alt="$imgTitle"
                                :caption="$imgTitle"
                                :fancyboxGroup="$fancyboxGroup"
                            />
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endif

@pushonce('footer_scripts_stack', 'fancyboxJS')
    @vite([
        'resources/js/utils/fancybox.js'
    ])
@endpushonce

@pushonce('footer_scripts_stack', 'fancyboxMasonryInit')
    <script>
        window.addEventListener('load', function () {
            if (typeof window.fancyboxInit === 'function') {
                window.fancyboxInit('[data-fancybox^="masonry-gallery"]');
            }
        });
    </script>
@endpushonce

@pushonce('footer_scripts_stack', 'galleryMasonryJS')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('masonryGalleryInit', (gridId) => ({
                init() {
                    const container = document.getElementById(gridId);
                    if (!container) return;

                    const items = container.querySelectorAll('[data-masonry-item]');

                    if (items.length) {
                        if (typeof window.gsap !== 'undefined') {
                            window.gsap.fromTo(items,
                                { autoAlpha: 0, y: 40 },
                                {
                                    autoAlpha: 1,
                                    y: 0,
                                    duration: 0.8,
                                    stagger: 0.05,
                                    ease: 'power2.out',
                                    scrollTrigger: {
                                        trigger: container,
                                        start: 'top 85%',
                                        once: true
                                    }
                                }
                            );
                        } else {
                            items.forEach(el => {
                                el.style.visibility = 'visible';
                                el.style.opacity = '1';
                            });
                        }
                    }
                }
            }));
        });
    </script>
@endpushonce

@pushonce('footer_styles_stack','galleryMasonryCSS')
    @vite([
        'resources/sass/themes/default/components/elements/gallery-mansory/gallery-mansory.scss'
    ])
@endpushonce

@pushonce('footer_styles_stack','fancyboxThemeCSS')
    @vite([
        'resources/sass/themes/default/components/elements/fancybox/fancybox-theme.scss'
    ])
@endpushonce
