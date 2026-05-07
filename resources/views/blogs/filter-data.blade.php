@foreach($blogs as $blog)

<div class="col-12 col-md-6 col-xl-4">
    <div class="card card-modern h-100 fade-in-up">
        @if($blog->image)
            <img src="{{ asset('uploads/'.$blog->image) }}"
                 class="card-img-top"
                 alt="{{ $blog->title }}"
                 loading="lazy">
        @else
            <div class="card-img-top bg-gradient" style="background: linear-gradient(135deg, #5b3df5, #0ea5e9);"></div>
        @endif
        <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2 gap-2">
                <span class="badge text-bg-primary">
                    <i class="bi bi-tag me-1"></i>{{ $blog->category }}
                </span>
                <small class="text-muted-soft text-nowrap">
                    <i class="bi bi-calendar-event me-1"></i>{{ $blog->publish_date ? \Illuminate\Support\Carbon::parse($blog->publish_date)->format('d M') : 'N/A' }}
                </small>
            </div>
            <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
            <p class="text-muted-soft small mb-3">{{ \Illuminate\Support\Str::limit($blog->short_description, 80) }}</p>
            <p class="small text-muted-soft mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary btn-sm mt-auto">
                <i class="bi bi-arrow-right me-1"></i>Read More
            </a>
        </div>
    </div>
</div>

@endforeach

@if($blogs->isEmpty())
    <div class="col-12">
        <div class="card card-modern border-0">
            <div class="card-body py-5 text-center">
                <div style="font-size: 3rem; margin-bottom: 1rem;">
                    <i class="bi bi-search text-muted-soft"></i>
                </div>
                <h3 class="h5 mb-2 fw-bold">No articles found</h3>
                <p class="text-muted-soft mb-0">Try adjusting your filters or search terms to find what you're looking for.</p>
            </div>
        </div>
    </div>
@endif
