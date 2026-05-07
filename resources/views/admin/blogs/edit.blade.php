@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-8">
        <div class="page-hero mb-4 fade-in-up">
            <h1 class="h2 fw-bold mb-1">Edit Article</h1>
            <p class="text-muted-soft mb-0">Update your article content, metadata, and media.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show fade-in-up" role="alert">
                <div class="fw-bold mb-2">
                    <i class="bi bi-exclamation-circle me-2"></i>Please fix the following errors:
                </div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-modern border-0 fade-in-up delay-1">
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data" class="row g-4">
                    @csrf

                    <div class="col-12">
                        <label class="form-label fw-semibold">Article Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ $blog->title }}" required>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" 
                                  rows="3" required>{{ $blog->short_description }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Article Content</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" 
                                  rows="10" required>{{ $blog->content }}</textarea>
                        @error('content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">Category</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" 
                               value="{{ $blog->category }}" list="categories" required>
                        <datalist id="categories">
                            @foreach($categories as $category)
                                <option value="{{ $category }}">
                            @endforeach
                        </datalist>
                        @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">Publish Date</label>
                        <input type="date" name="publish_date" class="form-control @error('publish_date') is-invalid @enderror" 
                               value="{{ $blog->publish_date }}" required>
                        @error('publish_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Featured Image</label>
                        
                        @if($blog->image)
                            <div class="mb-3">
                                <img src="{{ asset('uploads/' . $blog->image) }}" class="image-preview" alt="Current image">
                                <small class="text-muted-soft d-block mt-2">Current image shown above. Upload a new image to replace it.</small>
                            </div>
                        @endif

                        <div class="form-file-input">
                            <label class="form-file-label" for="imageInput">
                                <div>
                                    <i class="bi bi-cloud-upload" style="font-size: 2rem; color: var(--brand-primary);"></i>
                                    <p class="mt-2 mb-0"><strong>Click to upload</strong> or drag and drop</p>
                                    <small class="text-muted-soft">PNG, JPG, GIF up to 2MB</small>
                                </div>
                            </label>
                            <input type="file" name="image" id="imageInput" class="form-file-input @error('image') is-invalid @enderror" 
                                   accept="image/*">
                        </div>
                        <img id="imagePreview" class="image-preview" style="display: none;" alt="Image preview">
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Update Article
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-x-circle me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>

@endsection
