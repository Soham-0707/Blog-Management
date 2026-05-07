<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog Management') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="app-shell d-flex flex-column">
        @include('layouts.navigation')

        <main class="main-content flex-grow-1">
            <div class="container">
                @isset($header)
                    <div class="page-hero mb-4 fade-in-up">
                        {{ $header }}
                    </div>
                @endisset

                @hasSection('content')
                    @yield('content')
                @elseif(isset($slot))
                    {{ $slot }}
                @endif
            </div>
        </main>

        <footer class="app-footer py-5">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-3 footer-section">
                <h5 class="fw-bold d-flex align-items-center">
                    <span class="footer-brand-badge">BM</span>
                    Blog Management
                </h5>
                <p class="text-muted-soft small mb-0">Your modern platform for content creation and management.</p>
            </div>
            <div class="col-md-3 footer-section">
                <h5>Quick Links</h5>
                <a href="{{ route('blogs.index') }}">
                    <i class="bi bi-newspaper me-2"></i>Browse Blogs
                </a>
                <a href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Admin Login
                </a>
                <a href="{{ route('register') }}">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </a>
            </div>
            <div class="col-md-3 footer-section">
                <h5>Resources</h5>
                <a href="#">
                    <i class="bi bi-question-circle me-2"></i>Help Center
                </a>
                <a href="#">
                    <i class="bi bi-file-text me-2"></i>Documentation
                </a>
                <a href="#">
                    <i class="bi bi-chat-dots me-2"></i>Contact Support
                </a>
            </div>
            <div class="col-md-3 footer-section">
                <h5>Follow Us</h5>
                <div class="social-icons">
                    <a href="#" class="social-icon social-facebook" title="Facebook" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" aria-label="Twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-icon social-linkedin" title="LinkedIn" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="social-icon social-instagram" title="Instagram" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-top my-4">

        <div class="row align-items-center text-center text-md-start">
            <div class="col-md-6">
                <small class="text-muted-soft">&copy; {{ date('Y') }} {{ config('app.name', 'Blog Management') }}. All rights reserved.</small>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted-soft">
                    <a href="#" class="text-muted-soft text-decoration-none">Privacy Policy</a> •
                    <a href="#" class="text-muted-soft text-decoration-none">Terms of Service</a> •
                    <a href="#" class="text-muted-soft text-decoration-none">Cookie Policy</a>
                </small>
            </div>
        </div>
    </div>
</footer>
    </div>
</body>
</html>
