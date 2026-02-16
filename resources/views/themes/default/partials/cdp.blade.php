<script>
    let visitor = @json(\CdpFacade::getVisitorData(data_get($data, 'cdp', [])));
    let defaultPayload = {
        SSID: '{{ session()->get('site_session_id') }}',
        URL: '{{ '/'.request()->path() }}',
        VISITOR: visitor
    };
    let laId = null;

    document.addEventListener('DOMContentLoaded', async function () {
        if(!{{ \BaseFacade::validCdpRequest() ? 'true' : 'false' }}) {
            return;
        }
        let scrollPercentage = 0;
        const thresholdScrollPercentage = 1;
        const initialScrollPercentage = getScrollPercentage();
        laId = await visitPageAjax();

        window.setInterval(async function () {
            const currentScrollPercentage = getScrollPercentage();
            if (currentScrollPercentage > (scrollPercentage + initialScrollPercentage + thresholdScrollPercentage)) {
                scrollPercentage = currentScrollPercentage - initialScrollPercentage;
                await visitPageAjax(scrollPercentage, laId);
            }
        }, 2000);   // TIME BETWEEN REQUESTS
    }, false);

    async function visitPageAjax(scroll = null, laId = null, overrideChecks = false) {
        if(!overrideChecks && !{{ \BaseFacade::validCdpRequest() ? 'true' : 'false' }}) {
            return;
        }
        let payload = {
            ...defaultPayload,
            ...@json(\CdpFacade::getHttpReferrerDataAndQueryString())
        };

        const mid = '{{ data_get($data, 'menu.menu_id') }}';
        payload['DATA'] = {};
        if (mid !== '') {
            payload['DATA']['MID'] = mid
        }
        payload['DATA']['RID'] = '{{ data_get($data, 'record.id') }}';
        payload['DATA']['RMOD'] = '{{ is_null(data_get($data, 'record'))? '' :str_replace('Codicagr\CmsCore\Models\\','',get_class(data_get($data, 'record'))) }}';

        if (!payload['HTTPR'].includes('{{ config('app.url') }}')) {
            payload['VISITOR']['HTTPR'] = payload['HTTPR'];
        }

        if (scroll != null) {
            payload['SCROLL'] = scroll;
            if(laId === null) {
                return null;
            }
            payload['LAID'] = laId;
        }

        return await axios.post('{{route('api.visit-page')}}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            },
            {
                params: payload
            }
        ).then(res => {
            if(res.data.newSessionCookie) {
                visitor['COOK']['SESCOOK'] = res.data.newSessionCookie;
            }
            if(res.data.id) {
                return res.data.id;
            }
            return null;
        }).catch(err => {
            console.log(err);
        });
    }

    function getScrollPercentage() {
        var h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight';
        return (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
    }


    async function apiInteractionAjax(recordId, recordModel, action, options = []) {
        if(!{{ \BaseFacade::validCdpRequest() ? 'true' : 'false' }}) {
            return;
        }
        let payload = {
            ...defaultPayload,
            DATA: {
                "RID": recordId,
                "RMOD": recordModel,
                "ACTION": action,
            },
            OPTIONS: options,
        };

        let res = await axios.post('{{route('api.interaction')}}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            },
            {
                params: payload
            }
        ).then(res => {
        }).catch(err => {
            console.log(err);
        });
    }

    function wishlistClicked(elem, userId, recordId, model, url) {
        httpRequest = new XMLHttpRequest();
        if (!httpRequest) {
            console.log('Cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.open('POST', url, true);
        httpRequest.setRequestHeader("Content-type", "application/json");
        httpRequest.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);
        var data = {
            'user_id': userId,
            'record_id': recordId,
            'record_type': model
        };
        httpRequest.send(JSON.stringify(data));

        elem.classList.toggle('added');

        options = {};
        if(!elem.classList.contains('follow')){
            options['UNFOLLOW'] = true;
        }
        apiWishlistAjax(recordId, model, 'click', options);
    }

    async function apiWishlistAjax(recordId, recordModel, action, options = []) {
        if(!{{ \BaseFacade::validCdpRequest() ? 'true' : 'false' }}) {
            return;
        }
        let payload = {
            ...defaultPayload,
            DATA: {
                "RID": recordId,
                "RMOD": recordModel,
                "ACTION": action,
            },
            OPTIONS: options,
        };

        let res = await axios.post('{{route('api.wishlist')}}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            },
            {
                params: payload
            }
        ).then(res => {

        }).catch(err => {
            console.log(err);
        });
    }

    async function apiSearchAjax(searchPhrase) {
        if(!{{ \BaseFacade::validCdpRequest() ? 'true' : 'false' }}) {
            return;
        }
        let payload = {
            ...defaultPayload,
            KEYS: searchPhrase.split(' ').filter(keyword => keyword.length > 2),
            PHRASE: searchPhrase,
        };

        let res = await axios.post('{{route('api.search')}}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            },
            {
                params: payload
            }
        ).then(res => {
        }).catch(err => {
            console.log(err);
        });
    }
</script>
