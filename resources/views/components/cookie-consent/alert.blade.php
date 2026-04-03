@props(['options'])

@php
    $localeSuffix = '_' . app()->getLocale();
    $data = data_get($options, 'alert', []);
@endphp

<div class="lcc-modal lcc-modal--alert"
     x-show="mode === 'alert'"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     style="display: none;">

    <div class="lcc-modal__card">
        <div class="lcc-modal__body">
            <h2 class="lcc-modal__title">
                {{ data_get($data, 'header_title' . $localeSuffix, __('cookie-consent::texts.alert_title')) }}
            </h2>

            <div class="lcc-modal__text">
                {!! data_get($data, 'text' . $localeSuffix, __('cookie-consent::texts.alert_text')) !!}
            </div>
        </div>

        <div class="lcc-modal__actions">
            <button type="button" class="lcc-button lcc-button--primary" @click="acceptAll()">
                {{ data_get($data, 'accept_button_label' . $localeSuffix, __('cookie-consent::texts.alert_accept')) }}
            </button>

            <button type="button" class="lcc-button lcc-button--secondary" @click="rejectAll()">
                {{ data_get($data, 'reject_button_label' . $localeSuffix, __('cookie-consent::texts.alert_reject')) }}
            </button>

            <button type="button" class="lcc-button lcc-button--secondary" @click="openSettings('alert')">
                {{ data_get($data, 'settings_button_label' . $localeSuffix, __('cookie-consent::texts.alert_settings')) }}
            </button>
        </div>
    </div>
</div>
