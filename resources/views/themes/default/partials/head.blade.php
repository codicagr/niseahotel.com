<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0 , shrink-to-fit=no">
<script type="text/javascript">
    document.documentElement.addEventListener("touchstart",(e=>{e.touches.length>1&&e.preventDefault()}),{passive:!1});let lastTouchEnd=0;document.documentElement.addEventListener("touchend",(e=>{const t=Date.now();t-lastTouchEnd<=300&&e.preventDefault(),lastTouchEnd=t}),{passive:!1});
</script>

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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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

@if(!is_null($canonical))
    <link rel="canonical" href="{{ $canonical }}" />
@endif

{{-- Favicon / Touch Image --}}
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ $faviconUrl }}" />
<link rel="apple-touch-icon" href="{{ $touchUrl }}" />
<link rel="apple-touch-icon-precomposed" href="{{ $touchUrl }}" />

{{-- Fonts --}}
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/fonts/GothamGreek.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome-6.5.2/css/all.css') }}?v={{ config('versioning.version') }}" media="print" onload="this.media='all'">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/fonts/mcFont.css') }}?v={{ config('versioning.version') }}" media="print" onload="this.media='all'">

<!-- Header Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/styles.min.css') }}?v={{ config('versioning.version') }}">

{{--The following css files have been combined into "styles.min.css"--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/fonts.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/normalize.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/template.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/elements.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/styles.css') }}?v={{ config('versioning.version') }}">--}}

<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/temp.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/fonts/Dripicons.css') }}?v={{ config('versioning.version') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}?v={{ config('versioning.version') }}">

{{--<link rel="stylesheet" type="text/css" href="{{ asset('themes/default/css/jquery.mCustomScrollbar.min.css') }}?v={{ config('versioning.version') }}">--}}
<!-- Package CSS - START -->
@foreach(\PackagesFacade::getActivePackageAssets('css') as $filePath)
    <link rel="preload stylesheet" href="{{ asset($filePath) }}?v={{ config('versioning.version') }}" as="style" type="text/css" crossorigin="anonymous">
@endforeach
<!-- Package CSS - END -->

@stack('header_styles_stack')

<!-- Header Scripts -->
{{--<script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}?v={{ config('versioning.version') }}"></script>--}}
<script type="text/javascript" src="{{ asset('themes/default/js/app.min.js') }}?v={{ config('versioning.version') }}" defer></script>

{{-- Alpine.js --}}
<link href="{{ asset('themes/default/js/alpine.min.js') }}?v={{ config('versioning.version') }}" rel="preload" as="script">
<script type="text/javascript" src="{{ asset('themes/default/js/alpine.min.js') }}?v={{ config('versioning.version') }}" defer></script>

<!-- Package JS - START -->
@foreach(\PackagesFacade::getActivePackageAssets('js') as $filePath)
    <script type="text/javascript" src="{{ asset($filePath) }}?v={{ config('versioning.version') }}" defer></script>
@endforeach
<!-- Package JS - END -->

@stack('header_scripts_stack')

{{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
