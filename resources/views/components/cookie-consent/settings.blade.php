@props(['options'])

@php
    $localeSuffix = '_' . app()->getLocale();
    $settingsModalData = data_get($options, 'settings', []);
    $cookieTypes = array_filter(data_get($settingsModalData, 'types', []), function ($t) {
       return data_get($t, 'status') == '1';
    });
@endphp

{{-- Έφυγε το lcc-modal wrapper, έμεινε μόνο το container --}}
<div class="lcc-modal__container" x-show="mode === 'settings'">
    <div class="lcc-modal__header">
        <h2 class="lcc-modal__title" id="lcc-modal-settings-label">
            {{ data_get($settingsModalData, 'header_title' . $localeSuffix, __('cookie-consent::texts.settings_header_title')) }}
        </h2>
        <button type="button" class="lcc-modal__close" @click.prevent.stop="closeSettings()" aria-label="Close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    </div>

    <div class="lcc-modal__body no-lenis">
        <div class="lcc-intro-title">
            {!! data_get($settingsModalData, 'title' . $localeSuffix, __('cookie-consent::texts.settings_title')) !!}
        </div>
        <div class="lcc-intro-text">
            {!! data_get($settingsModalData, 'text' . $localeSuffix, __('cookie-consent::texts.settings_text')) !!}
        </div>

        <div class="lcc-accordion">
            @foreach($cookieTypes as $cookieType => $cookieTypeData)
                <div class="lcc-accordion__item" :class="{ 'is-open': activeTypeTab === '{{ $cookieType }}' }">
                    <div class="lcc-accordion__header">
                        <div class="lcc-accordion__trigger" @click.prevent.stop="toggle('{{ $cookieType }}')">
                            <span class="lcc-chevron">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </span>
                            <span class="lcc-type-name">{{ data_get($cookieTypeData, 'title' . $localeSuffix) }}</span>
                        </div>

                        @if($cookieType !== 'general')
                            <div class="lcc-accordion__controls">
                                <label class="lcc-switch" for="lcc-checkbox-{{ $cookieType }}">
                                    <input type="checkbox"
                                           id="lcc-checkbox-{{ $cookieType }}"
                                           @if($cookieType === 'necessary') checked disabled @endif>
                                    <span class="lcc-slider"></span>
                                    <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">
                                        {{ data_get($cookieTypeData, 'title' . $localeSuffix) }}
                                    </span>
                                </label>
                            </div>
                        @endif
                    </div>
                    <div class="lcc-accordion__content" x-show="isExpanded('{{ $cookieType }}')" x-collapse>
                        <div class="lcc-content-inner" style="padding: 0 16px 16px 16px;">
                            {!! data_get($cookieTypeData, 'text' . $localeSuffix) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="lcc-info-box">
            <div class="lcc-info-text">
                <p>
                    {!! data_get($settingsModalData, 'description' . $localeSuffix, __('cookie-consent::texts.settings_description')) !!}
                    <a href="javascript:void(0)" @click.prevent.stop="mode = 'details'" class="lcc-link">
                        {{ data_get($settingsModalData, 'details_button_label' . $localeSuffix) }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div class="lcc-modal__footer">
        <button type="button" class="lcc-button lcc-button--secondary" @click.prevent.stop="closeSettings()">
            {{ data_get($settingsModalData, 'cancel_button_label' . $localeSuffix, __('cookie-consent::texts.settings_cancel')) }}
        </button>

        <div class="lcc-footer-actions">
            <button type="button" class="lcc-button lcc-button--save" @click.prevent.stop="saveSettings()">
                {{ data_get($settingsModalData, 'save_button_label' . $localeSuffix, __('cookie-consent::texts.settings_save')) }}
            </button>
            <button type="button" class="lcc-button lcc-button--primary" @click.prevent.stop="acceptAll()">
                {{ data_get($settingsModalData, 'accept_all_button_label' . $localeSuffix, __('cookie-consent::texts.settings_accept_all')) }}
            </button>
        </div>
    </div>
</div>
