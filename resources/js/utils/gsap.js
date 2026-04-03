import {gsap} from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

window.gsap = gsap;

gsap.registerPlugin(ScrollTrigger);

/**
* @param {{ lenis: import('lenis').default | undefined }} [options]
 */
class Gsap {
    constructor(options={}) {

        if (options.hasOwnProperty('lenis') && typeof options.lenis?.raf === 'function') {
            /**
             * Synchronize Lenis scrolling with GSAP's ScrollTrigger plugin */
            options.lenis.on('scroll', ScrollTrigger.update);

            /**
             *
             * Add Lenis's requestAnimationFrame (raf) method to GSAP's ticker
             * This ensures Lenis's smooth scroll animation updates on each GSAP tick */
            gsap.ticker.add((time) => {
                options.lenis.raf(time * 1000);
            });

            /**
             * Disable lag smoothing in GSAP to prevent any delay in scroll animations */
            gsap.ticker.lagSmoothing(0);
        }
    }

    /**
     * Creates a tween going TO the given values.
     *
     * @param {...any} args - Same arguments as gsap.to()
     */
    to(...args) {
        return gsap.to(...args);
    }

    /**
     * Creates a tween coming FROM the given values.
     *
     * @param {...any} args - Same arguments as gsap.from()
     */
    from(...args) {
        return gsap.from(...args);
    }


    /**
     * Creates a tween coming FROM the first set of values going TO the second set.
     *
     * @param {...any} args - Same arguments as gsap.fromTo()
     */
    fromTo(...args) {
        return gsap.fromTo(...args);
    }

    /**
     * Staggers scroll-triggered reveal animations for a set of elements.
     *
     * Elements already in the viewport when the method is called (e.g. on a
     * mid-page reload) are revealed immediately via gsap.set so they never
     * queue up in a long stagger chain.  Elements below the fold get a
     * ScrollTrigger.batch so they animate row-by-row as the user scrolls,
     * always firing in DOM order.
     *
     * @param {string|Element} [targets='[data-stagger-child]']
     * @param {{
     *   interval?: number,
     *   batchMax?: number,
     *   start?: string,
     *   onEnter?: function,
     *   onLeave?: function,
     *   onEnterBack?: function,
     *   onLeaveBack?: function
     * }} [options={}]
     *
     * @example
     * Gsap.stagger('.card', {
     *     interval: 0.1,
     *     batchMax: 3,
     *     onEnter: batch => gsap.to(batch, { autoAlpha: 1, stagger: 0.15, overwrite: true }),
     * });
     */
    stagger(targets = '[data-stagger-child]', options = {}) {
        const all = gsap.utils.toArray(targets);
        if (!all.length) return;

        /**
         * Animate a batch of elements in. Sorts by DOM order first because
         * ScrollTrigger.batch does NOT guarantee DOM order in its callbacks,
         * which would otherwise cause cross-column stagger sequences to appear
         * out of order (e.g. footer columns).
         */
        const animate = (batch) => {
            batch.sort((a, b) =>
                a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1
            );
            return gsap.to(batch, {
                autoAlpha: 1,
                y: 0,
                duration: 1.2,
                stagger: 0.1,
                ease: 'power2.out',
                overwrite: true,
            });
        };

        const onEnter = options.onEnter ?? animate;

        /**
         * Three-way split based on the element's position relative to the
         * current viewport at the moment stagger() is called:
         *
         * aboveViewport – element has been scrolled completely past (bottom ≤ 0).
         *                 Revealed instantly; the user cannot see these anyway.
         *                 This prevents a huge stagger queue on mid-page reloads.
         *
         * inView        – element is at least partially visible right now.
         *                 Animated immediately so it plays on initial page load
         *                 (e.g. the hero title) without waiting for a scroll event.
         *
         * belowFold     – element is entirely below the viewport.
         *                 Handed to ScrollTrigger.batch for scroll-driven reveal.
         */
        const aboveViewport = [];
        const inView        = [];
        const belowFold     = [];

        all.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.bottom <= 0) {
                aboveViewport.push(el);
            } else if (rect.top < window.innerHeight) {
                inView.push(el);
            } else {
                belowFold.push(el);
            }
        });

        if (aboveViewport.length) {
            gsap.set(aboveViewport, { autoAlpha: 1, y: 0 });
        }

        if (inView.length) {
            onEnter(inView);
        }

        if (belowFold.length) {
            const batchConfig = {
                interval : options.interval ?? 0.1,
                start    : options.start    ?? 'top 90%',
                onEnter,
            };

            if (options.batchMax !== undefined) batchConfig.batchMax = options.batchMax;
            if (options.onLeave)                batchConfig.onLeave = options.onLeave;
            if (options.onEnterBack)            batchConfig.onEnterBack = options.onEnterBack;
            if (options.onLeaveBack)            batchConfig.onLeaveBack = options.onLeaveBack;

            ScrollTrigger.batch(belowFold, batchConfig);
        }
    }
}

export default Gsap;
