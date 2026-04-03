import Headroom from "headroom.js"

/**
 * Initialize Headroom.js
 *
 * @return {Headroom|null}
 */
export default () => {
    try {
        return new Headroom(document.body, {
            offset:    {down: 80, up: 40},
            tolerance: {down: 10, up: 10}
        }).init()

        // window.headroom.toggle = (state) => {
        //     state ? window.headroom.freeze() : window.headroom.unfreeze()
        //     document.documentElement.classList.toggle('menuOpen', state)
        // }
    }

    catch (error) {
        console.warn('(ERROR) Headroom:', error)
        return null
    }
}
