@props([
    'size' => '',
    'guests' => '',
    'sleeping' => ''
])

@if ($size || $guests || $sleeping)
    <div {{ $attributes->merge(['class' => 'itemHighlightsContainer ccPage mainWrapper']) }}>
        <div class="ccPageInner">
            <div class="itemHighlights flex flexWrap justifyCenter itemsCenter">

                @if ($size)
                    <div class="itemHighlight size flex">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M480 96L480 160L544 160L544 96L480 96zM448 64L576 64L576 192L528 192L528 448L576 448L576 576L448 576L448 528L192 528L192 576L64 576L64 448L112 448L112 192L64 192L64 64L192 64L192 112L448 112L448 64zM448 144L192 144L192 192L144 192L144 448L192 448L192 496L448 496L448 448L496 448L496 192L448 192L448 144zM160 480L96 480L96 544L160 544L160 480zM544 480L480 480L480 544L544 544L544 480zM160 96L96 96L96 160L160 160L160 96z"/></svg>
                        </div>
                        <div class="value">{{ $size }}</div>
                    </div>
                @endif

                @if ($guests)
                    <div class="itemHighlight guests flex">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M400 192C400 147.8 364.2 112 320 112C275.8 112 240 147.8 240 192C240 236.2 275.8 272 320 272C364.2 272 400 236.2 400 192zM208 192C208 130.1 258.1 80 320 80C381.9 80 432 130.1 432 192C432 253.9 381.9 304 320 304C258.1 304 208 253.9 208 192zM452.4 281.8C460.7 285.8 470.1 288 480 288C515.3 288 544 259.3 544 224C544 188.7 515.3 160 480 160C478.9 160 477.9 160 476.8 160.1C474.6 149.3 471.3 138.8 467 128.9C471.2 128.3 475.6 128 479.9 128C532.9 128 575.9 171 575.9 224C575.9 277 532.9 320 479.9 320C462.2 320 445.6 315.2 431.3 306.8C439.1 299.2 446.2 290.8 452.3 281.8zM208.5 306.8C194.3 315.2 177.7 320 159.9 320C106.9 320 63.9 277 63.9 224C63.9 171 106.9 128 159.9 128C164.3 128 168.6 128.3 172.8 128.9C168.5 138.8 165.2 149.3 163 160.1C161.9 160 160.9 160 159.8 160C124.5 160 95.8 188.7 95.8 224C95.8 259.3 124.5 288 159.8 288C169.7 288 179 285.8 187.3 281.8C193.4 290.9 200.5 299.2 208.3 306.8zM432 352L501.8 544L467.7 544L409.5 384L230.3 384L172.1 544L138.1 544L207.9 352L431.9 352zM151.2 368L139.7 400L86.4 400L34 544L0 544L64 368L151.2 368zM500.3 400L488.8 368L576 368L640 544L605.9 544L553.5 400L500.2 400z"/></svg>
                        </div>
                        <div class="value">{{ $guests }}</div>
                    </div>
                @endif

                @if ($sleeping)
                    <div class="itemHighlight sleepingArrangements flex">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M112 96L96 96L96 288L64 288L64 528C64 536.8 71.2 544 80 544C88.8 544 96 536.8 96 528L96 480L544 480L544 544L576 544L576 288L544 288L544 96L112 96zM512 192L128 192L128 128L512 128L512 192zM336 224L512 224L512 288L336 288L336 224zM304 288L128 288L128 224L304 224L304 288zM544 320L544 448L96 448L96 320L544 320z"/></svg>
                        </div>
                        <div class="value">{{ $sleeping }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
