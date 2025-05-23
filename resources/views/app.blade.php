<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'BestSoft') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-96x96.png')  }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/favicon/favicon.svg')  }}" />
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png')  }}" />
        <meta name="apple-mobile-web-app-title" content="BestSoft" />
        <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest')  }}" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
