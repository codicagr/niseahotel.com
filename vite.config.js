import { defineConfig   }   from 'vite'

import laravel              from 'laravel-vite-plugin'
import path                 from 'path'

// import { version }          from './version.config.js'

export default defineConfig({
    build: {
        target: "es2019",
        outDir: "public_html/themes/default",
        // sourcemap: false,
        // manifest: false,
        rollupOptions: {
            /*input: {
                app:             path.resolve(__dirname, 'resources/js/app.js'),
                map:             path.resolve(__dirname, 'resources/js/utils/map.js'),
                swiper:          path.resolve(__dirname, 'resources/js/utils/swiper.js'),
                hamburger_menu:  path.resolve(__dirname, 'resources/js/alpine/components/HamburgerMenu'),
                navigation_menu: path.resolve(__dirname, 'resources/js/alpine/components/NavigationMenu'),
                testimonials:    path.resolve(__dirname, 'resources/js/alpine/components/ModTestimonials'),
                faq:             path.resolve(__dirname, 'resources/js/alpine/components/ModFAQ'),
                gallery:         path.resolve(__dirname, 'resources/js/alpine/components/ModGallery'),
            },*/
            output: {
                entryFileNames: `js/[name].[hash].min.js`,
                chunkFileNames: `js/[name].[hash].min.js`,
                assetFileNames: `[ext]/[name].[hash].min.[ext]`,
            },
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
                additionalData: `@use "@styles/themes/default/abstracts/abstracts" as *;`
            },
        },
    },
    resolve: {
        alias: {
            "@js":     path.resolve(__dirname, "resources/js"),
            "@alpine": path.resolve(__dirname, "resources/js/alpine"),
            "@utils":  path.resolve(__dirname, "resources/js/utils"),
            "@codica": path.resolve(__dirname, "resources/js/codica"),
            "@styles": path.resolve(__dirname, "resources/sass")
        }
    },
    esbuild: {
        target: "es2019"
    },
    optimizeDeps: {
        esbuildOptions: {
            target: "es2019",
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/utils/booking-widget.js',
                'resources/js/utils/splide.js',
                'resources/js/alpine/components/splide-block.js',
                'resources/js/utils/fancybox.js',

                'resources/sass/themes/default/global/base/base.scss',
                'resources/sass/themes/default/global/site/site.scss',

                'resources/sass/themes/default/components/content/stay/stay-category.scss',
                'resources/sass/themes/default/components/content/stay/stay-item.scss',
                'resources/sass/themes/default/components/content/amenities/amenities-category.scss',
                'resources/sass/themes/default/components/content/locations/locations-category.scss',
                'resources/sass/themes/default/components/content/locations/locations-item.scss',
                'resources/sass/themes/default/components/content/experiences/experiences-category.scss',
                'resources/sass/themes/default/components/content/pages/pages-item.scss',
                'resources/sass/themes/default/components/content/general/general-item.scss',

                'resources/sass/themes/default/components/elements/auth-page/auth-page.scss',
                'resources/sass/themes/default/components/elements/general-forms/general-form.scss',
                'resources/sass/themes/default/components/elements/route-maps/route-maps.scss',
                'resources/sass/themes/default/components/elements/contact-map/contact-map.scss',
                'resources/sass/themes/default/components/elements/splide/custom-splide.scss',
                'resources/sass/themes/default/components/elements/splide/reviews-slider.scss',
                'resources/sass/themes/default/components/elements/splide/text-slider.scss',
                'resources/sass/themes/default/components/elements/splide/item-gallery.scss',
                'resources/sass/themes/default/components/elements/splide/collections.scss',
                'resources/sass/themes/default/components/elements/gallery-mansory/gallery-mansory.scss',
                'resources/sass/themes/default/components/elements/fancybox/fancybox-theme.scss',

                'resources/sass/themes/default/components/modules/plain/plain-default.scss',
                'resources/sass/themes/default/components/modules/plain/plain-telephone.scss',
                'resources/sass/themes/default/components/modules/home-intro/home-intro.scss',
                'resources/sass/themes/default/components/modules/home-rooms/home-rooms.scss',
                'resources/sass/themes/default/components/modules/galleries/galleries.scss',
                'resources/sass/themes/default/components/modules/booking-widget/booking-widget.scss',
                'resources/sass/themes/default/components/modules/plain/plain-booking.scss',
                'resources/sass/themes/default/components/modules/full-page-video/full-page-video.scss',
                'resources/sass/themes/default/components/modules/related-items/related-items.scss',
                'resources/sass/themes/default/components/elements/new-slider/new-slider.scss',
                'resources/sass/themes/default/components/elements/new-slider-splide/new-slider-splide.scss',
            ],
            refresh: true,
        }),
    ],
});
