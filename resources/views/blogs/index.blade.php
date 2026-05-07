@extends('layouts.app')

@section('content')

<div class="page-hero mb-4 fade-in-up">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h1 class="h2 mb-1">Discover Articles</h1>
            <p class="text-muted-soft mb-0">Browse and filter our collection of insightful articles with smart search capabilities.</p>
        </div>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Manage Blogs
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i>Admin Login
            </a>
        @endauth
    </div>
</div>

<div class="filter-panel fade-in-up delay-1">
    <div class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
            <label class="form-label">Search Blog</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="search" class="form-control" placeholder="Search by title...">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <label class="form-label">Category</label>
            <select id="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label class="form-label">Publish Date</label>
            <input type="date" id="date" class="form-control">
        </div>
    </div>
</div>

<div class="position-relative fade-in-up delay-2">
    <div id="loadingSpinner" class="d-flex justify-content-center align-items-center" style="display: none; min-height: 200px;">
        <div class="loading-spinner"></div>
    </div>
    <div class="row g-4" id="blogData">
        @include('blogs.filter-data')
    </div>
</div>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function fetchBlogs() {
    let category = $('#category').val();
    let date = $('#date').val();
    let search = $('#search').val();

    $('#loadingSpinner').show();

    $.ajax({
        url: "{{ route('blogs.filter') }}",
        type: "GET",
        data: {
            category: category,
            date: date,
            search: search
        },
        success: function(response){
            $('#blogData').html(response);
            $('#loadingSpinner').hide();
        },
        error: function() {
            $('#blogData').html('<div class="col-12"><div class="alert alert-danger">Error loading blogs. Please try again.</div></div>');
            $('#loadingSpinner').hide();
        }
    });
}

$('#category').on('change', fetchBlogs);
$('#date').on('change', fetchBlogs);
$('#search').on('keyup', function() {
    clearTimeout(this.searchTimeout);
    this.searchTimeout = setTimeout(fetchBlogs, 300);
});
</script>

@endsection
