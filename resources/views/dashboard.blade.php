<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h2 class="h4 mb-1">{{ __('Admin Dashboard') }}</h2>
                <p class="text-muted-soft mb-0">Overview and quick actions for your blog platform.</p>
            </div>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create New Blog</a>
        </div>
    </x-slot>

    <div class="row g-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-modern h-100 fade-in-up">
                <div class="card-body">
                    <p class="text-uppercase text-muted-soft small mb-2">Content Control</p>
                    <h3 class="h5 mb-2">Manage Blogs</h3>
                    <p class="text-muted-soft mb-4">Create, edit, and organize posts from a clean admin flow.</p>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary">Open Blog Manager</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-modern h-100 fade-in-up delay-1">
                <div class="card-body">
                    <p class="text-uppercase text-muted-soft small mb-2">Profile</p>
                    <h3 class="h5 mb-2">Account Settings</h3>
                    <p class="text-muted-soft mb-4">Keep your account secure and your profile details up to date.</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Update Profile</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card card-modern h-100 fade-in-up delay-2">
                <div class="card-body">
                    <p class="text-uppercase text-muted-soft small mb-2">Public View</p>
                    <h3 class="h5 mb-2">Explore Website</h3>
                    <p class="text-muted-soft mb-4">Review how your blog listing looks to visitors.</p>
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">Go to Blogs</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
