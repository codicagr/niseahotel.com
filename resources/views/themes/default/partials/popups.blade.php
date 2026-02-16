@php
    if(!is_null($popups) && !is_array($popups)) {
        $popups = $popups->toArray();
    }
@endphp
<div id="popupsWrapper" class="" style="position: fixed; height: 100%;  width: 100%; display: none; inset-0;">

</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('popups', {
            popups: @json($popups),
            activePopupGroups: [],
            popupCookiesName: 'popups_cookie',
            getPopupRequestUrl: '{{ route('get-popup') }}',
            popupClosedRequestUrl: '{{ route('popup-closed') }}',
            init() {
                let cookie = this.getPopupsCookie();
                this.popups = this.popups.filter((popup) => {
                    return this.validatePopupBasedOnCookie(popup, cookie);
                });
                if(!this.popups.length) {
                    return;
                }
                this.popups.filter((popup) => {
                    if(popup.behavior.trigger && popup.behavior.trigger.triggerPoint === 'onPageLoad') {
                        this.getAndDisplayPopup(popup);
                    }
                });
                window.onbeforeunload = function () {
                    // This will happen before leaving the page
                 //   return 'Are you sure you want to leave?';
                    this.popups.filter((popup) => {
                        if(popup.behavior.trigger && popup.behavior.trigger.triggerPoint === 'onExit') {

                        }
                    });
                }
                window.addEventListener( 'scroll', function (event) {
                    //console.log('scroll');
                });
            },
            validatePopupBasedOnCookie(popup, cookie) {
                if(popup.dev_mode) {
                    return true;
                }
                let popupCookieSettings = popup.behavior.cookie;
                if(popupCookieSettings && popupCookieSettings.mode === 'session') {
                    let popupsInSession = @json(Session::get('popups'));
                    if(popupsInSession && typeof(popupsInSession) === 'object') {
                        return !popupsInSession.find(popupId => popupId === popup.id);
                    }
                    return true;
                }

                const storedPopupCookie = cookie[popup.id];
                const isValidStoredPopupCookie = storedPopupCookie && storedPopupCookie.valid;
                if(popupCookieSettings && isValidStoredPopupCookie) {
                    if(this.cookieHasExpired(storedPopupCookie)) {
                        return true;
                    }
                    return false;
                }
                else {
                    return true;
                }
            },
            async getAndDisplayPopup(popup) {
                if(this.activePopupGroups.includes(popup.group)) {
                    return;
                }
                this.activePopupGroups.push(popup.group);

                let res = await axios.get(this.getPopupRequestUrl + '?' + new URLSearchParams({ id: popup.id }).toString(), {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(res => {
                    let html = res.data.data.popupHtml;
                    if (html !== undefined) {
                        const popupsWrapper = document.getElementById('popupsWrapper');
                        if (popupsWrapper !== undefined) {
                            popupsWrapper.innerHTML += html;
                            popupsWrapper.style.display = 'block';
                        }
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async closedPopup(id) {
                const popup = this.popups.find(popup => popup.id == id);
                this.setPopupsCookie(popup);
                let res = await axios.get(this.popupClosedRequestUrl + '?' + new URLSearchParams({ id: popup.id }).toString(), {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(res => {
                    this.activePopupGroups = this.activePopupGroups.filter(group => group !== popup.group);
                    console.log(popup.id + ' was closed ' + popup.group, this.activePopupGroups);
                }).catch(err => {
                    console.log(err);
                });
            },
            getPopupsCookie() {
                let cookie = this.getCookie(this.popupCookiesName);
                if(cookie) {
                    return JSON.parse(cookie);
                }
                else {
                    return {};
                }
            },
            setPopupsCookie(popup) {
                if(!popup) {
                    return;
                }
                let cookie = this.getPopupsCookie();
                let popupCookieSettings = popup.behavior.cookie;
                if (popupCookieSettings) {
                    const popupCookieDurationValue = popupCookieSettings.duration;
                    const popupCookieDurationMode = popupCookieSettings.mode;
                    const date = new Date();
                    let popupCookieDuration = this.calculatePopupCookieDurationInSeconds(popupCookieDurationValue, popupCookieDurationMode); // in seconds
                    if (popupCookieDuration > 0) {
                        date.setSeconds(date.getSeconds() + popupCookieDuration);
                        cookie[popup.id] = {
                            valid: true,
                            expiresAt: date.toString()
                        };
                        this.setCookie('popups_cookie', JSON.stringify(cookie), 60*60*24*365);
                    }
                }
            },
            calculatePopupCookieDurationInSeconds(popupCookieDurationValue, popupCookieDurationMode) {
                let popupCookieDuration = popupCookieDurationValue;
                switch (popupCookieDurationMode) {
                    case 'never':
                        popupCookieDuration = 0;
                        break;
                    case 'minutes':
                        popupCookieDuration *= 60;
                        break;
                    case 'hours':
                        popupCookieDuration *= 60 * 60;
                        break;
                    case 'days':
                        popupCookieDuration *= 60 * 60 * 24;
                        break;
                    case 'session':
                        break;
                    case 'forever':
                        popupCookieDuration *= 60 * 60 * 24 * 365;
                        break;
                    default:
                        return 0;
                }
                return popupCookieDuration;
            },
            getCookie(name) {
                var nameEQ = name + '=';
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            },
            setCookie(name, value, duration) {
                var expires = '';
                if (duration) {
                    var date = new Date();
                    date.setTime(date.getTime() + duration * 1000);
                    expires = '; expires=' + date.toUTCString();
                }
                document.cookie = name + '=' + (value || '') + expires + '; path=/';
            },
            cookieHasExpired(storedPopupCookie) {
                const date = new Date();
                return storedPopupCookie && new Date(storedPopupCookie.expiresAt) < date;
            },
            eraseCookie(name) {
                document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            },
            getCleanUrl() {
                let cleanUrl = window.location.href.split('?')[0]
                cleanUrl = cleanUrl.split('#')[0]
                return cleanUrl;
            }
        });
    });
</script>