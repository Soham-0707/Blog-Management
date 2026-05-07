@extends('layouts.app')

@section('content')

<div class="fade-in-up">
    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary mb-4">
        <i class="bi bi-arrow-left me-2"></i>Back to Blogs
    </a>
</div>

<div class="row justify-content-center fade-in-up delay-1">
    <div class="col-12 col-xl-9">
        <article class="card card-modern border-0 overflow-hidden">
            @if($blog->image)
                <img src="{{ asset('uploads/'.$blog->image) }}"
                     class="featured-image"
                     alt="{{ $blog->title }}"
                     loading="lazy">
            @endif
            
            <div class="card-body p-4 p-md-5">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="badge text-bg-primary">
                        <i class="bi bi-tag me-1"></i>{{ $blog->category }}
                    </span>
                    <small class="text-muted-soft">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ $blog->publish_date ? \Illuminate\Support\Carbon::parse($blog->publish_date)->format('d M, Y') : 'N/A' }}
                    </small>
                </div>

                <h1 class="h2 fw-bold mb-3">{{ $blog->title }}</h1>
                
                <div class="alert alert-info border-0 mb-4">
                    <strong>Summary:</strong> {{ $blog->short_description }}
                </div>

                <div class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <div class="d-flex gap-2 flex-wrap mt-5">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Articles
                    </a>
                </div>
            </div>
        </article>

        @if($relatedBlogs->count() > 0)
        <div class="related-blogs">
            <h3 class="fw-bold mb-4">Related Articles</h3>
            <div class="row g-4">
                @foreach($relatedBlogs as $related)
                <div class="col-md-6">
                    <div class="card card-modern h-100 fade-in-up">
                        @if($related->image)
                            <img src="{{ asset('uploads/'.$related->image) }}"
                                 class="card-img-top"
                                 alt="{{ $related->title }}"
                                 loading="lazy">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge text-bg-light border">{{ $related->category }}</span>
                                <small class="text-muted-soft">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $related->publish_date ? \Illuminate\Support\Carbon::parse($related->publish_date)->format('d M, Y') : 'N/A' }}
                                </small>
                            </div>
                            <h5 class="card-title">{{ $related->title }}</h5>
                            <p class="text-muted-soft mb-4">{{ \Illuminate\Support\Str::limit($related->short_description, 100) }}</p>
                            <a href="{{ route('blogs.show', $related->id) }}" class="btn btn-primary btn-sm mt-auto align-self-start">
                                <i class="bi bi-arrow-right me-1"></i>Read Article
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
