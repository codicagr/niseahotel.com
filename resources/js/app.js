import Alpine    from '@alpine'

import Headroom     from '@utils/headroom'

import focusable    from '@utils/focusable'

import flatpickr    from "@utils/flatpickr";
import "flatpickr/dist/flatpickr.min.css";

import Lenis from '@utils/lenis.js'

import Gsap from '@utils/gsap.js'

const lenisInstance = new Lenis();
window.Gsap = new Gsap({
    lenis: lenisInstance
});
window.Gsap.stagger();
window.lenis = lenisInstance;

window.focusable = focusable
window.Alpine    = Alpine
window.headroom  = Headroom()
window.flatpickr = flatpickr;
