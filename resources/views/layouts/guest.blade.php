<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog Management') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell d-flex flex-column">
        @include('layouts.navigation')

        <main class="flex-grow-1 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                        <div class="card card-modern border-0 fade-in-up">
                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    <a href="{{ route('blogs.index') }}" class="text-decoration-none">
                                        <x-application-logo class="mb-2" />
                                        <h1 class="h5 mb-0 brand-text">{{ config('app.name', 'Blog Management') }}</h1>
                                    </a>
                                </div>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="app-footer py-3">
            <div class="container text-center">
                <small class="text-muted-soft">&copy; {{ date('Y') }} {{ config('app.name', 'Blog Management') }}</small>
            </div>
        </footer>
    </div>
</body>
</html>
