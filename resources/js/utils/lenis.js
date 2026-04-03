import Lenis from "lenis";
import 'lenis/dist/lenis.css'

/**
 * Initialize Lenis instance
 *
 * @param {import('Lenis').LenisOptions | undefined} [options]
 *
 * @return {Lenis}
 */
export default class {
    constructor(options) {

        const lenisOptions = Object.assign({
            prevent: (element) => element.closest('.no-lenis') !== null
        }, options);

        this.lenis = new Lenis(lenisOptions);

        return this.lenis
    }
}
