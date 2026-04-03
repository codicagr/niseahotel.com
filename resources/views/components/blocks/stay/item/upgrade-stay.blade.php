@props([
    'upgradeId' => ''
])

@php
    $upgradeItem = null;

    if ($upgradeId) {
        $model = BaseFacade::getModel($upgradeId, 'Item');

        if (ContentFacade::validateItem($model)) {
            $upgradeItem = $model;
            $upgradeItemId = data_get($upgradeItem, 'id');
            $image = BaseFacade::getImage(data_get($upgradeItem, 'image'));
            $alt = data_get($upgradeItem, 'image_alt') ?: data_get($upgradeItem, 'title');
            $link = BaseFacade::getLink($upgradeItemId, 'Item');
        }
    }
@endphp

@if ($upgradeItem)
    <div {{ $attributes->merge(['class' => 'stayUpgradeContainer flex flexWrap']) }}>
        <div class="stayUpgradeImageContainer">
            <div class="stayUpgradeImage">
                <img src="{{ $image }}" alt="{{ $alt }}" loading="lazy" />
            </div>
        </div>

        <div class="stayUpgradeContentWrapper">
            <div class="ccPage">
                <div class="ccPageInner x-large">
                    <div class="stayUpgradeContent flex flexColumn gap25">
                        <div class="stayUpgradeMessage">
                            {{ BaseFacade::UpperCase(__('site/general.upgrade_your_stay')) }}
                        </div>

                        <h5 class="stayUpgradeTitle">
                            {{ data_get($upgradeItem, 'title') }}
                        </h5>

                        <div class="stayUpgradeMobileImageContainer">
                            <div class="stayUpgradeMobileImage">
                                <img src="{{ $image }}" alt="{{ $alt }}" loading="lazy" />
                            </div>
                        </div>

                        @if (data_get($upgradeItem, 'introtext'))
                            <div class="stayUpgradeText">
                                {!! data_get($upgradeItem, 'introtext') !!}
                            </div>
                        @endif

                        @if ($link)
                            <div class="stayUpgradeLink marginTop20">
                                <a class="generalButton primary desktop" href="{{ $link }}">
                                    {{ BaseFacade::UpperCase(__('site/general.more')) }}
                                </a>
                                <a class="generalButton mobile" href="{{ $link }}">
                                    {{ BaseFacade::UpperCase(__('site/general.more')) }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
