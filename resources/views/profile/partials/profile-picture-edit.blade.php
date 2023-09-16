<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile picture with your best photo!") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <img id='profile-img' src="{{ $profile->getFotoUrl() }}" class='w-1/6 object-cover rounded-full' />
        </div>

        <div>
            <input id="foto-input" type="file" name="foto" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            let img = document.querySelector('#profile-img')
                            img.src = e.target.result;
                            img.style.height = img.width + 'px';
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                document.querySelector("#foto-input").onchange = function(){
                    readURL(this);
                }
            </script>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
