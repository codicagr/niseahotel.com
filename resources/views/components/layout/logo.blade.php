@props([
    'ariaLabel' => config('app.name')
])

@php
    $logoPath = public_path('themes/default/images/logo/nisea2.svg');
    $logoSvg = rescue(fn() => file_get_contents($logoPath), '');
@endphp

<div {{ $attributes->merge(['id' => 'headerLogo', 'class' => 'logoContainer']) }}>
    <a class="logo" href="{{ URL::to(app('laravellocalization')->getCurrentLocale()) }}" aria-label="{{ $ariaLabel }}">
        {!! $logoSvg !!}
    </a>
</div>
