import Swiper from 'swiper';
import {
    Pagination,
    Navigation,
    A11y,
    Controller,
    Keyboard,
    Autoplay,
    Thumbs,
} from 'swiper/modules'

import 'swiper/css';

/**
 * Initialize Swiper instance
 *
 * @param {HTMLElement} root
 * @param {import('swiper').SwiperOptions | undefined} [options]
 *
 * @return {import('swiper').Swiper}
 */
class SwiperSlider {
  constructor (root, options) {
      this.element = /** @type {HTMLElement} */ root.classList.contains('swiper')
          ? root
          : root.querySelector('.swiper')

      if (!this.element) {
          throw new Error('Swiper element not found inside root');
      }

      // Recalculate and append the loop option for every breakpoint if any
      if ((options ?? {}).hasOwnProperty('breakpoints') && typeof options.breakpoints === 'object') {
          Object.values(options.breakpoints).forEach(breakpointOptions => {
              breakpointOptions.loop ??= this.loop(breakpointOptions)
          })
      }

      this.instance = new Swiper(this.element, {
          loop: this.loop(options),
          speed: 500,

          modules: [
              Pagination,
              Navigation,
              Controller,
              Keyboard,
              A11y,
              Autoplay,
              Thumbs,
          ],

          navigation: {
              addIcons: false,
              prevEl: root.querySelector('.swiper-button-prev'),
              nextEl: root.querySelector('.swiper-button-next'),
          },

          keyboard: {
              enabled: true,
              onlyInViewport: false,
          },

          a11y: {
              enabled: true,
          },

          ...(options ?? {})
      })

      return this.instance
  }

    /**
     * Set to true to forcefully enable continuous loop mode
     *
     * Because of nature of how the loop mode works (it will rearrange slides),
     * total number of slides must be:
     *
     *  - more than or equal to slidesPerView + slidesPerGroup (and + 1 in case of centeredSlides)
     *  - even to 'slidesPerGroup' (or use loopAddBlankSlides parameter)
     *  - even to 'grid.rows' (or use loopAddBlankSlides parameter)
     *
     *  @param {import('swiper').SwiperOptions | undefined} [options]
     *
     * @return {boolean}
     */
    loop (options) {
        const {
            slidesPerView=1,
            slidesPerGroup=1,
            centeredSlides=false,
            grid={
                rows: 1
            }
        } = options ?? {};

        if (typeof slidesPerView === 'string')
            return false

        const {
            length: slidesCount
        } = this.element.querySelectorAll('.swiper-slide')

        const requiredSlides = slidesPerView + slidesPerGroup + (centeredSlides ? 1 : 0);

        const requirements = [
            slidesCount >= requiredSlides,
            slidesCount % slidesPerGroup === 0,
            slidesCount % (grid?.rows || 1) === 0,
        ]

        return requirements.every(Boolean)
    }
}

window.Swiper = SwiperSlider
