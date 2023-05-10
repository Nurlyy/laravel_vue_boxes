<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Apple Touch Icons -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="64x64" href="{{ asset('touch-icon-iphone-64x64.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina-120x120.png') }}">

        <!-- Windows 8 Tiles -->
        <meta name="msapplication-TileImage" content="{{ asset('touch-w8-mediumtile-150x150.png') }}">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-square70x70logo" content="{{ asset('touch-w8-smalltile-70x70.png') }}">
        <meta name="msapplication-square150x150logo" content="{{ asset('touch-w8-mediumtile-150x150.png') }}">
        <meta name="msapplication-wide310x150logo" content="{{ asset('touch-w8-widetile-310x150.png') }}">
        <meta name="msapplication-square310x310logo" content="{{ asset('touch-w8-largetile-310x310.png') }}">

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <title>PROPAKO</title>

    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/main.js')
    </body>
</html>