@blaze(memo: true)
@props(['slug'])

@php
    $svgPath = public_path('uploads/files/stay/amenities_icons/'.$slug.'.svg');
    $svgContent = rescue(fn() => file_get_contents($svgPath), '');
@endphp

<div {{ $attributes->merge(['class' => 'itemAmenity flex']) }}>
    @if($svgContent)
        <div class="icon">
            {!! $svgContent !!}
        </div>
    @endif
    <div class="value">
        {{ __('site/room_amenities.options.'.$slug) }}
    </div>
</div>
