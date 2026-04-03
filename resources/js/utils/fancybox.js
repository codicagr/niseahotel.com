import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

window.Fancybox = Fancybox;

window.fancyboxInit = function (elem, customOptions) {
    return Fancybox.bind(elem, {
        Carousel: {
            Navigation: false,
            Toolbar: {
                display: {
                    left: ["prev", "counter", "next"],
                    middle: [],
                    right: ["thumbs", "zoom", "autoplay", "close"]
                },
                items: {
                    prev: {
                        tpl: '<button class="f-button" title="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg></button>',
                        click: (carousel) => {
                            carousel.prev();
                        }
                    },
                    next: {
                        tpl: '<button class="f-button" title="Next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>',
                        click: (carousel) => {
                            carousel.next();
                        }
                    }
                }
            },
            Thumbs: {
                showOnStart: false
            }
        },

        ...customOptions
    });
};
