<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Encore Events - Smart Event Cost Estimation')</title>

<meta name="description" content="@yield('description', 'Get instant, accurate cost estimates for your dream event. Our intelligent estimation tool analyzes your preferences and requirements to provide detailed pricing for venues, catering, decorations, and more.')">
<meta name="keywords" content="event planning, cost estimation, wedding planning, corporate events, party planning, event management">
<meta name="author" content="Encore Events">
<meta name="robots" content="index, follow">

<meta property="og:title" content="@yield('title', 'Encore Events - Smart Event Cost Estimation')">
<meta property="og:description" content="@yield('description', 'Get instant, accurate cost estimates for your dream event.')">
<meta property="og:image" content="{{ asset('website/assets/encore-events-logo.png') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Encore Events">
<meta property="og:locale" content="en_US">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title', 'Encore Events - Smart Event Cost Estimation')">
<meta name="twitter:description" content="@yield('description', 'Get instant, accurate cost estimates for your dream event.')">
<meta name="twitter:image" content="{{ asset('website/assets/encore-events-logo.png') }}">

<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Noto+Sans+Malayalam:wght@100..900&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset('website/css/style.css') }}">

@yield('styles')

<link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}" />