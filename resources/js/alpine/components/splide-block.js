// ─── Defaults ────────────────────────────────────────────────────────────────

const SPLIDE_DEFAULTS = {
    type: 'loop',
    pagination: false,
    arrows: false,
    speed: 800,
}

const GSAP_DEFAULTS = {
    from: { autoAlpha: 0, y: 40 },
    to: {
        autoAlpha: 1,
        y: 0,
        duration: 1.2,
        stagger: 0.15,
        ease: 'power3.out',
        scrollTrigger: { start: 'top 85%', once: true },
    },
    timeoutLog: false,
}

// ─── Presets ──────────────────────────────────────────────────────────────────
// Static, never serialised into HTML.
// Dynamic parts (selectors) come from Blade overrides.

const PRESETS = {
    reviews: {
        trackCurrentSlide: false,
        splide: {
            perPage: 3,
            perMove: 1,
            gap: '1.5rem',
            padding: { left: '8vw', right: '8vw' },
            drag: 'free',
            snap: true,
            flickPower: 100,
            easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
            breakpoints: {
                1024: { perPage: 2 },
                768: { perPage: 1, padding: { left: '15px', right: '15px' } },
            },
        },
        gsap: {
            targetsSelector: '.reviewSlideInner',
            to: { duration: 1, stagger: 0.12 },
        },
    },

    textSlider: {
        trackCurrentSlide: true,
        splide: {
            perPage: 1,
            perMove: 1,
            focus: 'center',
            gap: '2rem',
            drag: true,
        },
        gsap: {
            targetsSelector: '.slideContent',
            timeoutLog: '⚠️ GSAP timeout on Text Slider.',
        },
    },

    collectionsSlider: {
        trackCurrentSlide: true,
        splide: {
            autoWidth: true,
            gap: '1.5rem',
            padding: { left: '8vw', right: '8vw' },
            drag: 'free',
            snap: false,
            flickPower: 100,
            easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
            flickMaxPages: 6,
            breakpoints: {
                768: { gap: '1rem', padding: { left: '15px', right: '15px' } },
                581: { drag: true, snap: true },
            },
        },
        gsap: {
            targetsSelector: '.slideInner',
            from: { autoAlpha: 0, x: 60 },
            to: { autoAlpha: 1, x: 0 },
            timeoutLog: '⚠️ GSAP timeout on Collections Slider.',
        },
    },

    roomGallery: {
        trackCurrentSlide: true,
        splide: {
            autoWidth: false,
            focus: 'center',
            gap: '5px',
            updateOnMove: true,
        },
        gsap: {
            targetsSelector: '.splide__slide__link',
            to: { stagger: 0.1 },
            timeoutLog: '⚠️ GSAP timeout on Gallery.',
        },
    },
}

// ─── Helpers ─────────────────────────────────────────────────────────────────

function resolveSplideClass() {
    if (typeof window.Splide === 'function') return window.Splide
    if (typeof window.Splide !== 'undefined' && typeof window.Splide.default === 'function') {
        return window.Splide.default
    }
    return null
}

function runGsapStaggerReveal(root, elements, from, to, timeoutLog) {
    if (!root || !elements.length) return

    if (typeof window.gsap !== 'undefined') {
        window.gsap.fromTo(elements, from, to)
    } else {
        if (timeoutLog) console.log(timeoutLog)
        elements.forEach((el) => { el.style.visibility = 'visible'; el.style.opacity = '1' })
    }
}

// ─── Config builders ─────────────────────────────────────────────────────────

/**
 * Merge two GSAP layer objects (preset + override) on top of GSAP_DEFAULTS.
 * `from` and `to` are merged key-by-key; `scrollTrigger` inside `to` is also merged.
 * `rootSelector` defaults to `sliderSelector` when not provided.
 */
function buildGsapConfig(presetGsap, overrideGsap, sliderSelector) {
    if (overrideGsap === false || presetGsap === false) return null

    const p = presetGsap   || {}
    const o = overrideGsap || {}

    const targetsSelector = o.targetsSelector ?? p.targetsSelector
    if (!targetsSelector) return null

    const rootSelector = o.rootSelector ?? p.rootSelector ?? sliderSelector

    const from = { ...GSAP_DEFAULTS.from, ...(p.from || {}), ...(o.from || {}) }
    const to = {
        ...GSAP_DEFAULTS.to,
        ...(p.to || {}),
        ...(o.to || {}),
        scrollTrigger: {
            ...GSAP_DEFAULTS.to.scrollTrigger,
            ...(p.to?.scrollTrigger || {}),
            ...(o.to?.scrollTrigger || {}),
        },
    }
    const timeoutLog = o.timeoutLog !== undefined ? o.timeoutLog
        : p.timeoutLog !== undefined ? p.timeoutLog
        : GSAP_DEFAULTS.timeoutLog

    return { rootSelector, targetsSelector, from, to, timeoutLog }
}

/**
 * @param {string} presetName  key from PRESETS
 * @param {object} [overrides] dynamic parts from Blade (selectors, minor splide/gsap tweaks)
 */
function buildConfig(presetName, overrides = {}) {
    const preset = PRESETS[presetName]
    if (!preset) console.warn(`splideBlock: unknown preset "${presetName}"`)

    const p = preset   || {}
    const o = overrides

    const sliderSelector = o.sliderSelector ?? p.sliderSelector
    if (!sliderSelector) console.warn('splideBlock: sliderSelector is required')

    return {
        sliderSelector,
        trackCurrentSlide: o.trackCurrentSlide ?? p.trackCurrentSlide ?? false,
        fancyboxSelector:  o.fancyboxSelector  ?? p.fancyboxSelector,
        splide: { ...SPLIDE_DEFAULTS, ...(p.splide || {}), ...(o.splide || {}) },
        gsap:   buildGsapConfig(p.gsap, o.gsap, sliderSelector),
    }
}

// ─── Alpine component ─────────────────────────────────────────────────────────

function applyGsap(gsap) {
    if (!gsap) return
    const root     = document.querySelector(gsap.rootSelector)
    const elements = root?.querySelectorAll(gsap.targetsSelector)
    if (!root || !elements?.length) return

    const to = { ...gsap.to, scrollTrigger: { ...gsap.to.scrollTrigger, trigger: root } }
    runGsapStaggerReveal(root, elements, gsap.from, to, gsap.timeoutLog || null)
}

document.addEventListener('alpine:init', () => {
    const Alpine = window.Alpine
    if (!Alpine) return

    Alpine.data('splideBlock', (presetName, overrides = {}) => {
        const config = buildConfig(presetName, overrides)
        return {
            slider: null,
            currentSlide: 1,
            init() {
                const SplideClass = resolveSplideClass()
                if (SplideClass) {
                    this.initSlider(SplideClass)
                } else {
                    console.warn('splideBlock: Splide is not available')
                }
            },
            initSlider(SplideClass) {
                this.slider = new SplideClass(config.sliderSelector, config.splide)

                if (config.trackCurrentSlide) {
                    this.slider.on('moved', (i) => { this.currentSlide = i + 1 })
                }

                this.slider.mount()

                if (config.fancyboxSelector && typeof window.fancyboxInit === 'function') {
                    window.fancyboxInit(config.fancyboxSelector)
                }

                applyGsap(config.gsap)
            },
        }
    })
})
