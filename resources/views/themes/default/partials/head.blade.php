<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, maximum-scale=5.0, minimum-scale=1.0, shrink-to-fit=no">

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="refresh-token" content="{{ route('refresh-token') }}">

@php
    $title           = data_get($metadata, 'title', '');
    $url             = data_get($metadata, 'url', URL::to('/'));
    $image           = data_get($metadata, 'imageData.image', '');
    $imageWidth      = data_get($metadata, 'imageData.width', 1200);
    $imageHeight     = data_get($metadata, 'imageData.height', 630);
    $metaDescription = data_get($metadata, 'metaDescription', '');
    $type            = data_get($metadata, 'type', 'website');
    $canonical       = data_get($metadata, 'canonical');
    $robots          = data_get($metadata, 'robots', 'noindex, nofollow');

    $faviconPath = public_path('themes/default/images/system/favicon.png');
    $touchPath = public_path('themes/default/images/system/touch.png');

    $faviconUrl = File::exists($faviconPath)
        ? asset('themes/default/images/system/favicon.png')
        : asset('vendor/cms-core/themes/images/system/favicon.png');

    $touchUrl = File::exists($touchPath)
        ? asset('themes/default/images/system/touch.png')
        : asset('vendor/cms-core/themes/images/system/touch.png');
@endphp

{{-- Page Title --}}
<title>@section('title') {{ $title }} @show</title>

{{-- Metadata --}}
<base href="{{ $url }}" />
<meta name="twitter:card" content="summary" />
<meta name="og:url" content="{{ $url }}" />
<meta name="twitter:url" content="{{ $url }}" />
<meta name="og:title" content="{{ $title }}" />
<meta name="twitter:title" content="{{ $title }}" />
<meta name="og:type" content="{{ $type }}" />
<meta name="og:image:width" content="{{ $imageWidth }}" />
<meta name="og:image:height" content="{{ $imageHeight }}" />
<meta name="twitter:image" content="{{ $image }}" />
<meta name="og:image" content="{{ $image }}" />
<meta name="og:site_name" content="{{ $title }}" />
<meta name="description" content="{{ $metaDescription }}" />
<meta name="robots" content="{{ $robots }}">
<meta name="general-error" content="{{ __('site/general.error_message'), }}">

{{-- Canonical --}}
@if(!is_null($canonical))
    <link rel="canonical" href="{{ $canonical }}" />
@endif

{{-- Favicon / Touch Image --}}
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ $faviconUrl }}" />
<link rel="apple-touch-icon" href="{{ $touchUrl }}" />
<link rel="apple-touch-icon-precomposed" href="{{ $touchUrl }}" />

{{-- Fonts --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome-6.7.2/css/all.css') }}?v={{ config('versioning.version') }}" media="print" onload="this.media='all'">

@foreach(\PackagesFacade::getActivePackageAssets('css') as $filePath)
    @if(str_contains($filePath, 'cookie-consent.min.css') || str_contains($filePath, 'cms-core.css'))
        @continue
    @endif
    <link rel="preload stylesheet" href="{{ asset($filePath) }}?v={{ config('versioning.version') }}" as="style" type="text/css" crossorigin="anonymous">
@endforeach

@vite([
    'resources/sass/themes/default/global/base/base.scss',
    'resources/sass/themes/default/global/site/site.scss',
])

@stack('header_styles_stack')

@foreach(\PackagesFacade::getActivePackageAssets('js') as $filePath)
    <script type="text/javascript" src="{{ asset($filePath) }}?v={{ config('versioning.version') }}" defer></script>
@endforeach

@vite([
    'resources/js/app.js',
])

@stack('header_scripts_stack')
