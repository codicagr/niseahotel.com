@props(['options'])

@php
    $localeSuffix = '_' . app()->getLocale();
    $detailsModalData = data_get($options, 'details', []);
    $detailBlocks = array_filter(data_get($detailsModalData, 'blocks', []), function ($b) {
       return data_get($b, 'status') == '1';
    });
@endphp

{{-- Έφυγε το lcc-modal wrapper, έμεινε μόνο το container --}}
<div class="lcc-modal__container" x-show="mode === 'details'">
    <div class="lcc-modal__header">
        <h2 class="lcc-modal__title">
            {{ data_get($detailsModalData, 'header_title' . $localeSuffix, __('cookie-consent::texts.settings_header_title')) }}
        </h2>
        <button type="button" class="lcc-modal__close" @click.prevent.stop="mode = 'settings'" aria-label="Back">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </button>
    </div>

    <div class="lcc-modal__body no-lenis">
        <div class="lcc-modal__intro">
            <h3 class="lcc-intro-title">
                {{ data_get($detailsModalData, 'title' . $localeSuffix, __('cookie-consent::texts.details_general.title')) }}
            </h3>
            <div class="lcc-intro-text">
                {!! data_get($detailsModalData, 'text' . $localeSuffix, __('cookie-consent::texts.details_general.text')) !!}
            </div>
        </div>

        <div class="lcc-accordion">
            @foreach($detailBlocks as $index => $blockDetails)
                <div class="lcc-accordion__item" :class="{ 'is-open': activeTypeDetails === '{{ $index }}' }">
                    <div class="lcc-accordion__header">
                        <div class="lcc-accordion__trigger" @click.prevent.stop="toggleDetails('{{ $index }}', $el)">
                            <span class="lcc-chevron">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </span>
                            <span class="lcc-type-name">{{ data_get($blockDetails, 'title' . $localeSuffix) }}</span>
                        </div>
                    </div>
                    <div class="lcc-accordion__content" x-show="activeTypeDetails === '{{ $index }}'" x-collapse>
                        <div class="lcc-table-wrapper" style="padding: 0 16px 16px 16px;">
                            {!! data_get($blockDetails, 'text' . $localeSuffix) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="lcc-modal__footer" style="justify-content: flex-end;">
        <button type="button" class="lcc-button lcc-button--secondary" @click.prevent.stop="mode = 'settings'">
            {{ data_get($detailsModalData, 'back_button_label' . $localeSuffix, __('cookie-consent::texts.details_cancel')) }}
        </button>
    </div>
</div>
