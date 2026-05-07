@extends('layouts.app')

@section('content')
<div class="hero-banner fade-in-up">
    <div class="hero-content">
        <h1>Discover Amazing Stories</h1>
        <p>Explore insightful articles and stay updated with the latest blog posts on various topics.</p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('blogs.index') }}" class="btn btn-light btn-lg fw-600">
                <i class="bi bi-arrow-right me-2"></i>Browse Blogs
            </a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg fw-600">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </a>
            @endguest
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-5 fade-in-up delay-1">
        <div class="col-12">
            <h2 class="h3 fw-bold mb-1">Why Blog Management?</h2>
            <p class="text-muted-soft">The platform for modern content creation</p>
        </div>
    </div>

    <div class="row g-4 mb-5 fade-in-up delay-2">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <div class="card-value mb-2">
                    <i class="bi bi-pencil-square text-primary" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Easy Publishing</h5>
                <p class="card-label mb-0">Create and publish content effortlessly with our intuitive editor.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <div class="card-value mb-2">
                    <i class="bi bi-speedometer2 text-success" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Lightning Fast</h5>
                <p class="card-label mb-0">Optimized performance for the best user experience.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <div class="card-value mb-2">
                    <i class="bi bi-shield-check text-info" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Secure</h5>
                <p class="card-label mb-0">Your content is protected with enterprise-grade security.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <div class="card-value mb-2">
                    <i class="bi bi-graph-up text-warning" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold">Analytics</h5>
                <p class="card-label mb-0">Track your blog's performance with detailed insights.</p>
            </div>
        </div>
    </div>

    <div class="row fade-in-up delay-3">
        <div class="col-12">
            <div class="card card-modern border-0 text-center p-5">
                <h3 class="fw-bold mb-3">Ready to Start Blogging?</h3>
                <p class="text-muted-soft mb-4">Join thousands of creators sharing their stories on Blog Management</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-rocket me-2"></i>Get Started Free
                    </a>
                @else
                    <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-book me-2"></i>Explore Blogs
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
