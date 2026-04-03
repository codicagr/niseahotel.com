import Swup from "swup";
import SwupProgressPlugin from '@swup/progress-plugin';
import SwupPreloadPlugin from '@swup/preload-plugin';


const _NavigationLinks = document.querySelectorAll('nav a');

/**
 *
 * @param {{url: string, hash: string}} from
 * @param {{url: string, hash: string, html: string}} to
 */
function setActiveLink({ from, to }) {
    const { pathname } = window.location;

    _NavigationLinks.forEach(link => {
        const isActive = link.pathname === pathname;
        link.classList.toggle('swup--active', isActive);
    });
}


/**
 * Initialize Swup with specified containers.
 *
 * @param {string[]} containers
 *
 * @return {Swup|null}
 */
export default (containers) => {
    try {
        return new Swup({
            animateHistoryBrowsing: true,
            containers: containers,
            plugins: [
                new SwupProgressPlugin({
                    className: 'swup__progress-bar',
                    transition: 300,
                    delay: 300,
                    initialValue: 0.25,
                    finishAnimation: true
                }),
                new SwupPreloadPlugin({
                    preloadVisibleLinks: {
                        /** How much area of a link must be visible to preload it: 0 to 1.0 */
                        threshold: 1,
                        /** How long a link must be visible to preload it, in milliseconds */
                        delay: 500,
                        /** Containers to look for links in */
                        containers: ['body'],
                        /** Callback for opting out selected elements from preloading */
                        ignore: (el) => false
                    }
                }),
            ],
            hooks: {
                "page:view": setActiveLink
            }
        })
    }

    catch (error) {
        console.warn('(ERROR) Swup:', error)
        return null
    }
}
