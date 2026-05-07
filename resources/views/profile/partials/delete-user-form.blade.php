<section>
    <header>
        <h2 class="h5 mb-1">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted-soft mb-4">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 card-modern">
                <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h2 class="h5 mb-0">{{ __('Are you sure you want to delete your account?') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted-soft mb-3">
                            {{ __('Once your account is deleted, all resources and data will be permanently removed. Enter your password to confirm.') }}
                        </p>

                        <x-input-label for="password" value="{{ __('Password') }}" />

                        <x-text-input id="password" name="password" type="password" class="mt-1" placeholder="{{ __('Password') }}" />

                        <x-input-error :messages="$errors->userDeletion->get('password')" />
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                modal.show();
            });
        </script>
    @endif
</section>
