@extends('layouts.auth')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

<div class="w-full max-w-md -mt-10" x-data="{ showInfo: false }" @keydown.escape="showInfo = !showInfo" x-cloak>
    <div class="flex justify-center py-4">
        @include('icons.logo-white',['style'=>'h-16'])
    </div>

    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        <h1 class="text-center text-gray-700 text-lg font-bold mb-3">{{ __('Register') }}</h1>


        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('firstname') border-red-500 @enderror"
                id="firstname" type="text" placeholder="First name" name="firstname" value="{{ old('firstname') }}"
                required autocomplete="firstname" autofocus>
            @error('firstname')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('lastname') border-red-500 @enderror"
                id="lastname" type="text" placeholder="Last name" name="lastname" value="{{ old('lastname') }}" required
                autocomplete="lastname">
            @error('lastname')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('lastname') border-red-500 @enderror"
                id="facebook" type="text" placeholder="Facebook profile URL link" name="facebook"
                value="{{ old('facebook') }}" required autocomplete="facebook">
            <p class="text-xs text-gray-500 ml-2">*Required for the private Facebook group.
                <button @click="showInfo = !showInfo" type="button" class="underline font-bold">More info</button>
            </p>
            <div x-show="showInfo" @click.away="showInfo = false">
                @include('partials.auth-alert')
            </div>
            @error('facebook')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('email') border-red-500 @enderror"
                type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                autocomplete="email">
            @error('email')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('password') border-red-500 @enderror"
                type="password" id="password" name="password" placeholder="Password" required
                autocomplete="new-password">
            @error('password')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('password') border-red-500 @enderror"
                type="password" id="password-confirm" name="password_confirmation"
                placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('country') border-red-500 @enderror"
                type="text" id="country" name="country" placeholder="Country of residence" value="{{ old('country') }}"
                required autocomplete="country">
            @error('country')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                class="appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none @error('birthday') border-red-500 @enderror"
                type="text" id="birthday" name="birthday" placeholder="Birthday" value="{{ old('birthday') }}" required
                autocomplete="birthday">
            <p class="text-xs text-gray-500 ml-2">
                *Please click to select your birthday.
            </p>
            @error('birthday')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="" class="text-gray-700 ml-2 mr-3">Gender</label>
            <label for="gender">
                <input type="radio" id="gender" name="gender" value="male" {{ old('gender') == 'male' ? 'checked':''}}>
                <span class="ml-1 mr-3 text-sm text-gray-600">Male</span>
                <input type="radio" name="gender" id="gender" value="female"
                    {{ old('gender') == 'female' ? 'checked':''}}>
                <span class="ml-1 mr-3 text-sm text-gray-600">Female</span>
            </label>
            @error('gender')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <div class="relative">
                <select
                    class="block appearance-none w-full bg-white border border-gray-300 text-gray-600 py-3 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="aware_of_df" name="aware_of_df" required>
                    <option disabled selected>How did you first heard about dancefloor</option>
                    <option value="facebook" {{ old('aware_of_df') == 'facebook' ? 'selected':'' }}>Facebook</option>
                    <option value="instagram" {{ old('aware_of_df') == 'instagram' ? 'selected':'' }}>Instagram</option>
                    <option value="google" {{ old('aware_of_df') == 'google' ? 'selected':'' }}>Google</option>
                    <option value="party" {{ old('aware_of_df') == 'party' ? 'selected':'' }}>Dance Party</option>
                    <option value="festival" {{ old('aware_of_df') ==' festival' ? 'selected':'' }}>
                        In a Festival
                    </option>
                    <option value="friend" {{ old('aware_of_df') == 'friend' ? 'selected':'' }}>From a friend</option>
                    <option value="ads" {{ old('aware_of_df') == 'ads' ? 'selected':'' }}>
                        Social media ads(Facebook, instagram, twitter, etc)
                    </option>
                    <option value="public-manifestation"
                        {{ old('aware_of_df') == 'public-manifestation' ? 'selected':'' }}>
                        Public manifestation (ex: Fête de Genève, Automnales)
                    </option>
                    <option value="instructor" {{ old('aware_of_df') == 'instructor' ? 'selected':'' }}>
                        From an instructor
                    </option>
                    <option value="current-student" {{ old('aware_of_df') == 'current-student' ? 'selected':'' }}>
                        I am a current dancefloor student
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            @error('aware_of_df')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        {{-- <div class="mb-4 flex">
            <input type="checkbox" name="agreement" value="true" class="mr-2 mt-1" required>
            <span class="text-sm text-gray-600">
                By registering you accept and agreed with all our <a href="" class="text-red-800 hover:underline">terms
                    and
                    conditions</a> and <a href="" class="text-red-800 hover:underline">Confidentiality Policy</a>
            </span>
        </div> --}}

        <div class="mt-0">
            <button type="submit" class="rounded-full bg-red-700 py-2 px-4 text-white hover:bg-red-800 w-full">
                {{ __('Register') }}
            </button>
        </div>

    </form>
</div>


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#birthday");
</script>
@endsection