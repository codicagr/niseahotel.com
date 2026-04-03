@props([
    'module',
    'idSuffix' => 'inline', // 'popup' ή 'inline' για μοναδικά IDs
    'minNights' => 1,
    'maxNights' => 60,
    'minAdults' => 1,
    'maxAdults' => 5,
    'minChildren' => 0,
    'maxChildren' => 4,
    'minInfants' => 0,
    'maxInfants' => 1,
    'link' => '',
    'target' => '_self'
])

@php
    $moduleId = data_get($module, 'module.id', 0);
    $arrivalTitle = data_get($module, 'data.arrival_title', '');
    $nightsTitle = data_get($module, 'data.nights_title', '');
    $adultsTitle = data_get($module, 'data.adults_title', '');
    $adultsNote = data_get($module, 'data.adults_note', '');
    $childrenTitle = data_get($module, 'data.children_title', '');
    $childrenNote = data_get($module, 'data.children_note', '');
    $infantsTitle = data_get($module, 'data.infants_title', '');
    $infantsNote = data_get($module, 'data.infants_note', '');
    $linkLabel = data_get($module, 'data.link_label', '');

    // Δημιουργούμε το μοναδικό ID
    $uid = $moduleId . '_' . $idSuffix;
@endphp

<form class="widgetForm flex flexColumn" @submit.prevent="submitBooking('{{ $link }}', '{{ $target }}')">
    <div class="formGroup fullWidth">
        <label for="arrivalDate_{{ $uid }}">
            <span>{{ BaseFacade::UpperCase($arrivalTitle) }}</span>
        </label>
        <input type="text" id="arrivalDate_{{ $uid }}" x-init="initCalendar($el)" readonly>
    </div>

    <div class="formRow flex gap20">
        <div class="formGroup flex1">
            <label for="nightsSelect_{{ $uid }}">
                <span>{{ BaseFacade::UpperCase($nightsTitle) }}</span>
            </label>
            <select id="nightsSelect_{{ $uid }}" x-model="form.nights">
                @for($i = $minNights; $i <= $maxNights; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="formGroup flex1">
            <label for="adultsSelect_{{ $uid }}">
                <span>{{ BaseFacade::UpperCase($adultsTitle) }}</span>
                @if($adultsNote != '') <span class="note">{{ $adultsNote }}</span> @endif
            </label>
            <select id="adultsSelect_{{ $uid }}" x-model="form.adults">
                @for($i = $minAdults; $i <= $maxAdults; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="formRow flex gap20">
        @if($maxChildren > 0)
            <div class="formGroup flex1">
                <label for="childrenSelect_{{ $uid }}">
                    <span>{{ BaseFacade::UpperCase($childrenTitle) }}</span>
                    @if($childrenNote != '') <span class="note">{{ $childrenNote }}</span> @endif
                </label>
                <select id="childrenSelect_{{ $uid }}" x-model="form.children">
                    @for($i = $minChildren; $i <= $maxChildren; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        @endif

        @if($maxInfants > 0)
            <div class="formGroup flex1">
                <label for="infantsSelect_{{ $uid }}">
                    <span>{{ BaseFacade::UpperCase($infantsTitle) }}</span>
                    @if($infantsNote != '') <span class="note">{{ $infantsNote }}</span> @endif
                </label>
                <select id="infantsSelect_{{ $uid }}" x-model="form.infants">
                    @for($i = $minInfants; $i <= $maxInfants; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        @endif
    </div>

    <div class="submitGroup marginTop20">
        <button type="submit" class="generalButton primary">
            {{ BaseFacade::UpperCase($linkLabel) }}
        </button>
    </div>
</form>
