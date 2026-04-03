import flatpickr  from "flatpickr";

import { Greek }  from "flatpickr/dist/l10n/gr.js";
import { German } from "flatpickr/dist/l10n/de.js";
import { Dutch }  from "flatpickr/dist/l10n/nl.js";

const locales = {
    'el': Greek,    // Στο Laravel τα ελληνικά είναι συνήθως 'el', στο flatpickr το αρχείο είναι 'gr'
    'de': German,
    'nl': Dutch,
    'en': 'default'
};

const currentHtmlLang = document.documentElement.lang || 'en';

const activeLang = currentHtmlLang.split('-')[0];

if (locales[activeLang] && locales[activeLang] !== 'default') {
    flatpickr.localize(locales[activeLang]);
}

export default flatpickr;
