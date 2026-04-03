@php
    $moduleId = data_get($module, 'module.id', 0);
    $mainTitle = data_get($module, 'data.general.title', '');
    $mainSubtitle = data_get($module, 'data.general.subtitle', '');
    $mainText = data_get($module, 'data.general.text', '');
    $mainLinkLabel = data_get($module, 'data.general.link-label', '');
    $mainLink = data_get($module, 'data.general.link', '');
    $mainTarget = data_get($module, 'data.general.link-target', '_self');

    $fallback = data_get($module ,'data.general.image', '');
    $alt = data_get($module ,'data.general.alt', '');

    $desktopVideo = data_get($module ,'data.desktopVideo', '');
    $mobileVideo = data_get($module ,'data.mobileVideo', '');

    $scrollIcon = data_get($module ,'data.scrollIcon', 0);
@endphp

<div class="modFullPageVideo mod{{ $moduleId }}">
    <div class="fullPageVideoContainer"
         x-data="{
        desktopSrc: '{{ $desktopVideo }}',
        mobileSrc: '{{ $mobileVideo ?? $desktopVideo }}', // Αν δεν υπάρχει mobile, βάλε το desktop ως fallback
        currentSrc: null,

        init() {
            this.setVideoSource();

            // Παρακολουθούμε τις αλλαγές στο μέγεθος του παραθύρου
            // Το debounce βοηθάει να μην τρέχει ο κώδικας συνέχεια όσο σέρνεις το παράθυρο
            window.addEventListener('resize', Alpine.debounce(() => {
                this.setVideoSource();
            }, 200));
        },

        setVideoSource() {
            // Ορίζουμε το breakpoint (π.χ. 768px για tablet/mobile)
            let isMobile = window.innerWidth < 768;
            let targetSrc = isMobile ? this.mobileSrc : this.desktopSrc;

            // Αλλάζουμε το source ΜΟΝΟ αν είναι διαφορετικό από το τρέχον
            // (για να μην κάνει reload το βίντεο αν απλά αλλάξεις λίγο το μέγεθος στο desktop)
            if (this.currentSrc !== targetSrc) {
                this.currentSrc = targetSrc;
            }
        }
     }"
    >
        <video
            x-ref="videoPlayer"
            :src="currentSrc"
            autoplay
            muted
            loop
            playsinline
            poster="{{ $fallback }}"
            class="fullPageVideo"
        >
            <img src="{{ $fallback }}" alt="{{ $alt }}">
        </video>

        @if ($mainTitle != '' || $mainSubtitle != '')
            <div class="fullPageVideoContentContainer">
                <h1 class="fullPageVideoContent">
                    @if ($mainTitle != '')
                        <span class="fullPageVideoTitle" data-stagger-child>
                            {{ $mainTitle }}
                        </span>
                    @endif
                    @if ($mainSubtitle != '')
                        <span class="fullPageVideoSubtitle" data-stagger-child>
                            {{ BaseFacade::UpperCase($mainSubtitle) }}
                        </span>
                    @endif
                </h1>
            </div>
        @endif

        @if ($scrollIcon)
            <x-ui.scroll-indicator />
        @endif

        <div class="fullPageVideoOverlay"></div>
    </div>
</div>

@pushonce('footer_styles_stack','modVideoProject')
    @vite([
        'resources/sass/themes/default/components/modules/full-page-video/full-page-video.scss'
    ])
@endpushonce
