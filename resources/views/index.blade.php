<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500;600&display=swap" rel="stylesheet">

        <title>PROPAKO</title>

    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/main.js')
    </body>
</html>