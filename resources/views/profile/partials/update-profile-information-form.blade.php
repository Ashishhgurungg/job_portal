<section>
    <strong>
        {{ session('status')}}
    </strong>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
    <x-input-label for="role" :value="__('Role')" />

    <select
        id="role"
        name="role"
        required
        autofocus
        autocomplete="role"
        class="mt-1 block w-full"
    >
        <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>
            {{ __('Admin') }}
        </option>
        <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>
            {{ __('Employer') }}
        </option>
        <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>
            {{ __('User') }}
        </option>
    </select>

    <x-input-error class="mt-2" :messages="$errors->get('role')" />
</div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="textarea" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div>
    <x-input-label for="about" :value="__('About')" />

    <textarea
        id="about"
        name="about"
        required
        autofocus
        autocomplete="about"
        class="mt-1 block w-full"
    >{{ old('about', $user->about) }}</textarea>

    <x-input-error class="mt-2" :messages="$errors->get('about')" />
</div>

        <div>
    <x-input-label for="gender" :value="__('Gender')" />

    <select
        id="gender"
        name="gender"
        class="mt-1 block w-full"
        required
        autofocus
        autocomplete="gender"
    >
        <option value="" {{ old('gender', $user->gender) === '' ? 'selected' : '' }}>
            {{ __('None') }}
        </option>
        <option value="2" {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>
            {{ __('Male') }}
        </option>
        <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>
            {{ __('Female') }}
        </option>
        <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>
            {{ __('Other') }}
        </option>
    </select>

    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
</div>

<div>
    <x-input-label for="image" :value="__('Profile Photo')" />

    {{-- 1) Preview current avatar or a placeholder --}}
    @if($user->image)
        <img
            src="{{ asset('uploads/profile/'.$user->image) }}"
            alt="{{ $user->name }}’s photo"
            class="mt-2 20 w-20 rounded-full object-cover"
        />
    @else
        <div
            class="mt-2 h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500"
        >
            <span class="text-xl font-semibold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </span>
        </div>
    @endif

    {{-- 2) File input --}}
    <input
        id="image"
        name="image"
        type="file"
        accept="image/*"
        class="mt-2 block w-full"
    />

    <x-input-error class="mt-2" :messages="$errors->get('image')" />
</div>


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
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
