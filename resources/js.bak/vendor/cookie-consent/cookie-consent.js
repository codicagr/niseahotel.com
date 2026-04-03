import {
    getCookie,
    setCookie
} from './util/cookies';

import {
    isHidden,
    addEventListener
} from './util/dom';

import {
    showModal,
    hideModal
} from './util/modals';

import 'wicg-inert';
import './cookie-styles.css'

const modalAlert = document.querySelector('.js-lcc-modal-alert');
const modalSettings = document.querySelector('.js-lcc-modal-settings');
const modalSettingsTrigger = document.querySelector('button.js-lcc-settings-toggle');
const backdrop = document.querySelector('.js-lcc-backdrop');
const checkboxPerformance = document.getElementById('lcc-checkbox-performance');
const checkboxPreference = document.getElementById('lcc-checkbox-preference');
const checkboxTargeting = document.getElementById('lcc-checkbox-targeting');
const COOKIE_KEY = modalAlert.dataset.cookieKey || '__cookie_consent';
const COOKIE_VALUE_PERFORMANCE = modalAlert.dataset.cookieValuePerformance || '2';
const COOKIE_VALUE_PREFERENCE = modalAlert.dataset.cookieValuePreference || '3';
const COOKIE_VALUE_TARGETING = modalAlert.dataset.cookieValueTargeting || '4';
const COOKIE_EXPIRATION_DAYS = modalAlert.dataset.cookieExpirationDays || '365';
const GTM_EVENT = modalAlert.dataset.gtmEvent || 'pageview';

const ignoredPaths = modalAlert.dataset.ignoredPaths || null;

initialize();

function initialize() {

    const ignoredPathsArray = ignoredPaths ? ignoredPaths.split(',').map(ignoredPath => ignoredPath.trim()) : [];
    var isIgnoredPage = ignoredPathsArray.indexOf(location.pathname) > -1;
    if(!isIgnoredPage){
        for (var index = 0; index < ignoredPathsArray.length; index++){
            var name = ignoredPathsArray[index];
            if (/(\/*)$/.test(name) && location.pathname.includes(name.slice(0, -2))){
                isIgnoredPage = true;
            }
        }
    }
    const isRobot = /bot|google|baidu|bing|msn|duckduckbot|teoma|slurp|yandex/i.test(navigator.userAgent);

    if (isRobot || !modalAlert || !modalSettings) return;

    if (!getCookie(COOKIE_KEY) && !isIgnoredPage) {
        showModal(modalAlert, true);
    }

    initSettings();

    addEventListener('click', '#closeCookiesModalButton', function () {
        saveSettings('none');

        hideModal(modalAlert, true);
        dispatchHideModalEvent();
    });

    addEventListener('click', '.js-lcc-settings-toggle', function () {
        toggleModalSettings();
    });

    addEventListener('click', '.js-lcc-accept', function () {

        saveSettings('all');

        hideModal(modalAlert, true);
        dispatchHideModalEvent();
    });

    addEventListener('click', '.js-lcc-reject', function () {

        saveSettings('none');

        hideModal(modalAlert, true);
        dispatchHideModalEvent();
    });

    addEventListener('click', '.js-lcc-settings-accept-all', function () {

        saveSettings('all');

        hideModal(modalSettings);
        document.body.classList.remove('cookiesOpen');
        hideModal(modalAlert, true);
        dispatchHideModalEvent();
    });

    addEventListener('click', '.js-lcc-settings-save', function () {

        saveSettings();
        toggleModalSettings();
        hideModal(modalAlert, true);
        dispatchHideModalEvent();
        document.body.classList.remove('cookiesOpen');
    });
}

function dispatchHideModalEvent() {
    const event = new CustomEvent('cookie-consent-modal-closed');
    window.dispatchEvent(event);
}

function toggleModalSettings() {
    if (isHidden(modalSettings)) {

        showModal(modalSettings);
        modalAlert.classList.add('hidden');
        document.body.classList.add('cookiesOpen');

        initSettings();

        backdrop.addEventListener('click', backdropListener);
        document.body.addEventListener('keydown', keyboardListener);

    } else {
        hideModalSettings();
    }

    function backdropListener() {
        hideModalSettings();
    }

    function keyboardListener(event) {

        //  Close modal on pressing Escape key
        if ((event.which || event.keyCode) == 27) {

            event.preventDefault();

            hideModalSettings();
        }
    }

    function hideModalSettings() {
        backdrop.removeEventListener('click', backdropListener);
        document.body.removeEventListener('keydown', keyboardListener);

        hideModal(modalSettings);
        modalAlert.classList.remove('hidden');
        document.body.classList.remove('cookiesOpen');

        if (!getCookie(COOKIE_KEY)) {
            showModal(modalAlert, true);

        }

        modalSettingsTrigger.focus();
        dispatchHideModalEvent();
    }
}

function initSettings() {

    const cookieValue = getCookie(COOKIE_KEY);

    if(cookieValue === null){
        if (checkboxPerformance) {
            checkboxPerformance.checked = false;
        }
        if (checkboxPreference) {
            checkboxPreference.checked = false;
        }
        if (checkboxTargeting) {
            checkboxTargeting.checked = false;
        }
        return;
    }

    const values = JSON.parse(cookieValue);

    if(typeof values !== 'object'){
        if (checkboxPerformance) {
            checkboxPerformance.checked = false;
        }
        if (checkboxPreference) {
            checkboxPreference.checked = false;
        }
        if (checkboxTargeting) {
            checkboxTargeting.checked = false;
        }
        return;
    }

    let value = false;
    if(COOKIE_VALUE_PERFORMANCE in values){
        value = values[COOKIE_VALUE_PERFORMANCE];
    }
    if (checkboxPerformance) {
        checkboxPerformance.checked = value;
    }

    value = false;
    if(COOKIE_VALUE_PREFERENCE in values){
        value = values[COOKIE_VALUE_PREFERENCE];
    }

    if (checkboxPreference) {
        checkboxPreference.checked = value;
    }

    value = false;
    if(COOKIE_VALUE_TARGETING in values){
        value = values[COOKIE_VALUE_TARGETING];
    }
    if (checkboxTargeting) {
        checkboxTargeting.checked = value;
    }
}

function saveSettings(parameter = null) {

    let cookieValue;

    if(parameter === 'all'){
        cookieValue = {
            [COOKIE_VALUE_PERFORMANCE] : true,
            [COOKIE_VALUE_PREFERENCE] : true,
            [COOKIE_VALUE_TARGETING] : true,
        };
    }
    else if(parameter === 'none'){
        cookieValue = {
            [COOKIE_VALUE_PERFORMANCE]  : false,
            [COOKIE_VALUE_PREFERENCE]   : false,
            [COOKIE_VALUE_TARGETING]    : false,
        };
    }
    else{
        cookieValue = {
            [COOKIE_VALUE_PERFORMANCE]  : checkboxPerformance ? checkboxPerformance.checked : false,
            [COOKIE_VALUE_PREFERENCE]   : checkboxPreference  ? checkboxPreference.checked  : false,
            [COOKIE_VALUE_TARGETING]    : checkboxTargeting   ? checkboxTargeting.checked   : false,
        };
    }

    cookieValue = JSON.stringify(cookieValue);

    updateCookie(cookieValue);
}

function updateCookie(cookieValue) {

    setCookie(COOKIE_KEY, COOKIE_EXPIRATION_DAYS, cookieValue);

    //  Fire GTM event if dataLayer is found
    if (window.dataLayer) {
        window.dataLayer.push({event: GTM_EVENT});
    }
}
