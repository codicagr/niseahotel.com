@props([
    'title' => '',
    'text' => ''
])

@if ($title || $text)
    <div {{ $attributes->merge(['class' => 'itemExtraInfoContainer']) }}>
        <div class="ccPage">
            <div class="ccPageInner medium">
                <div class="itemExtraInfo flex flexColumn itemsCenter justifyCenter gap25 textCenter">
                    @if ($title)
                        <h4 class="itemExtraInfoTitle">
                            {!! $title !!}
                        </h4>
                    @endif
                    @if ($text)
                        <h5 class="itemExtraInfoText textCenter">
                            {!! $text !!}
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
