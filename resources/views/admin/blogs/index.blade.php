@extends('layouts.app')

@section('content')

<div class="page-hero mb-4 fade-in-up">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
            <h1 class="h2 fw-bold mb-1">Blog Management</h1>
            <p class="text-muted-soft mb-0">Create, edit, and manage all your published articles from one dashboard.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-2"></i>Add New Blog
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fade-in-up" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-responsive table-modern fade-in-up delay-1">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th class="py-3 ps-3">ID</th>
                <th class="py-3">Title</th>
                <th class="py-3">Category</th>
                <th class="py-3">Publish Date</th>
                <th class="py-3 pe-3 text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td class="ps-3 fw-semibold">{{ $blog->id }}</td>
                    <td>
                        <div class="fw-semibold">{{ $blog->title }}</div>
                        <small class="text-muted-soft">{{ \Illuminate\Support\Str::limit($blog->short_description, 65) }}</small>
                    </td>
                    <td>
                        <span class="badge text-bg-primary">
                            <i class="bi bi-tag me-1"></i>{{ $blog->category }}
                        </span>
                    </td>
                    <td>
                        <small class="text-muted-soft">
                            <i class="bi bi-calendar me-1"></i>{{ $blog->publish_date ? \Illuminate\Support\Carbon::parse($blog->publish_date)->format('d M, Y') : 'N/A' }}
                        </small>
                    </td>
                    <td class="pe-3 text-end">
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $blog->id }}">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">Are you sure you want to delete <strong>{{ $blog->title }}</strong>? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.blogs.delete', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash me-1"></i>Delete Article
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">
                            <i class="bi bi-inbox text-muted-soft"></i>
                        </div>
                        <p class="text-muted-soft mb-2">No blogs created yet</p>
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i>Create Your First Blog
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
