<div class="flex flex-wrap mb-4 -mx-3 items-end">
    <div class="w-full md:w-1/3 px-3 my-1">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('firstname') border-red-500 @enderror"
            id="firstname" type="text" placeholder="Firstname" name="firstname"
            value="{{ $user->firstname ?? old('firstname') }}" required autocomplete="firstname" autofocus>
        @error('firstname')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full md:w-1/3 px-3 my-1">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('lastname') border-red-500 @enderror"
            id="lastname" type="text" placeholder="Lastname" name="lastname"
            value="{{ $user->lastname ?? old('lastname') }}" required autocomplete="lastname">
        @error('lastname')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full md:w-1/3 px-3 my-1">
        {{-- <label
            class="w-full inline-flex justify-center items-center px-3 py-2 bg-gray-300 text-gray-800 rounded-full hover:shadow-lg tracking-wide border border-blue cursor-pointer hover:bg-gray-700 hover:text-white">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M18.072 16.278c-1.002-.232-1.936-.435-1.484-1.289 1.378-2.599.366-3.989-1.088-3.989-1.482 0-2.469 1.443-1.088 3.989.465.859-.504 1.062-1.484 1.289-1.004.232-.927.761-.927 1.722h6.998c0-.961.077-1.49-.927-1.722zm-10.072-9.259v16.981h15v-16.981h-15zm13 12.981h-11v-11h11v11zm-15-1.132l-5-13.738 14.095-5.13 1.827 5h-2.128l-.9-2.455-10.38 3.778 2.486 6.832v5.713z" />
            </svg>
            <span class="ml-2 text-base leading-normal">Profile picture</span>
            <input type="file" name="picture" id="picture" class="hidden">
        </label> --}}
    </div>
</div>

<div class="flex flex-wrap mb-4 -mx-3">
    <div class="w-full md:w-1/3 px-3 mb-2">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('email') border-red-500 @enderror"
            type="email" id="email" name="email" placeholder="Email" value="{{ $user->email ?? old('email') }}" required
            autocomplete="email">
        @error('email')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full md:w-1/3 px-3 mb-2">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('password') border-red-500 @enderror"
            type="password" id="password" name="password" placeholder="Password"
            value="{{ $user->password ?? old('value')}}" autocomplete="new-password">
        @error('password')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full md:w-1/3 px-3 mb-2">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('password') border-red-500 @enderror"
            type="password" id="password-confirm" name="password_confirmation"
            placeholder="{{ __('Confirm Password') }}" value="{{ $user->password ?? old('value')}}"
            autocomplete="new-password">
    </div>
</div>

<div class="flex flex-wrap mb-4 -mx-3 items-center">
    <div class="w-full md:w-1/3 px-3 mb-2">
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded-full py-2 px-3 leading-tight focus:outline-none focus:bg-white border border-gray-200 focus:border-gray-500 @error('birthday') border-red-500 @enderror"
            type="text" id="birthday" name="birthday" placeholder="Birthday"
            value="{{ $user->birthday ?? old('birthday') }}" autocomplete="birthday">
        @error('birthday')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full md:w-1/3 px-3 mb-2">
        <label for="gender">
            <span class="text-gray-600 mr-3 font-semibold">Gender: </span>
            <input type="radio" name="gender" value="male" @isset($user->gender)
            {{ $user->gender == 'male' ? 'checked':''}} @endisset required>
            <span class="ml-1 mr-3 text-gray-600 text-sm">Male</span>
            <input type="radio" name="gender" value="female" @isset($user->gender)
            {{ $user->gender == 'female' ? 'checked':''}} @endisset>
            <span class="ml-1 mr-3 text-gray-600 text-sm">Female</span>
        </label>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-2">
    </div>
</div>

<div class="mb-4 w-full md:w-1/3 -mx-3">
    <div class="relative px-3">
        <select id="aware_of_df" name="aware_of_df"
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-3 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option disabled selected>How did you first heard about us?</option>
            <option value="facebook" @isset($user->how_heard_df)
                {{ $user->aware_of_df == 'facebook' ? 'selected' : ''}} @endisset>Facebook</option>
            <option value="instagram" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'instagram' ? 'selected' : ''}} @endisset>Instagram</option>
            <option value="festival" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'festival' ? 'selected' : ''}} @endisset>Dance Festival</option>
            <option value="google" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'google' ? 'selected' : ''}} @endisset>Google</option>
            <option value="friend" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'friend' ? 'selected' : ''}} @endisset>A friend</option>
            <option value="old-student" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'student' ? 'selected' : ''}} @endisset>I'm an old student</option>
            <option value="party" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'party' ? 'selected' : ''}} @endisset>Dance Party</option>
            <option value="festival" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'festival' ? 'selected' : ''}} @endisset>Dance Festival</option>
            <option value="public-manifestation" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'public-manifestation' ? 'selected' : ''}} @endisset>Public manifestation
            </option>
            <option value="instructor" @isset($user->aware_of_df)
                {{ $user->aware_of_df == 'instructor' ? 'selected' : ''}} @endisset>Instructor</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
        </div>
    </div>
</div>


<div id="avatar" class="mt-5">
    <label for="picture" class="block text-gray-700">User photo</label>
    <input type="file" name="picture" id="picture">
    <p class="text-sm italic text-gray-700">
        *Please upload a squared picture, ex: 500x500 pixels
    </p>
</div>