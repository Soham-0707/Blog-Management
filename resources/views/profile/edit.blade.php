<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="h4 mb-1">{{ __('Profile Settings') }}</h2>
            <p class="text-muted-soft mb-0">Manage your account information and security preferences.</p>
        </div>
    </x-slot>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card card-modern border-0 fade-in-up">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card card-modern border-0 fade-in-up delay-1">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card card-modern border-0 fade-in-up delay-2">
                <div class="card-body p-4 p-md-5">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>        
    </div>
</x-app-layout>
