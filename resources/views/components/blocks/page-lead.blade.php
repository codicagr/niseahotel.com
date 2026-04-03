@props([
    'title' => '',
    'text' => '',
    'innerClass' => 'medium',
    'layoutClass' => 'flexColumn'
])

@if($title || $text)
    <div {{ $attributes->merge(['class' => 'pageLeadWrapper mainWrapper ccPage']) }}>
        <div class="ccPageInner {{ $innerClass }}">
            <div class="pageLead flex justifyCenter gap30 {{ $layoutClass }}">
                @if ($title)
                    <div class="pageLeadTitleContainer flex justifyCenter">
                        <h2 class="pageLeadTitle textCenter" data-stagger-child>
                            {!! $title !!}
                        </h2>
                    </div>
                @endif

                @if ($text)
                    <div class="pageLeadTextContainer flex justifyCenter">
                        <h3 class="pageLeadText textCenter" data-stagger-child>
                            {!! $text !!}
                        </h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
