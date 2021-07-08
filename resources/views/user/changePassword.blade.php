<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm w-1/4 float-left border">
                <div class="bg-white border-b border-gray-200">
                    <ul>

                        <li class="block list-none hover:bg-gray-200 cursor-pointer">
                            <a href="{{url('settings')}}" class="no-underline block p-6"> Edit Profile</a>
                        </li>
                        <li class="block list-none hover:bg-gray-200 cursor-pointer">
                            <a href="{{url('changePassword')}}" class="no-underline block p-6"> Change Password</a>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm  w-3/4 border">
                <div class="p-6 bg-white border-b text-center border-gray-200">

                    @if(Auth::user()->image)
                    <img src="{{url('getImage/'.Auth::user()->image)}}" class="mx-auto rounded-full object-cover w-32 h-32 mt-5" alt="IMAGEN">
                    @else
                    <img src="{{url('getImage/default_user.png')}}" class="mx-auto rounded-full  object-cover w-32 h-32 mt-5" alt="IMAGEN">
                    @endif

                    <h2 class="mt-3 text-2xl">{{Auth::user()->name}}</h2>


                    <!-- Errors of validation -->
                    <x-auth-validation-errors class="mt-4" :errors="$errors" />

                    @if(session('password_validation')=='The password has been reseted')

                    <div class="mt-3 text-base font-bold text-green-600">
                        {{session('password_validation')}}
                    </div>
                    @else
                    <div class="mt-3 text-base font-bold text-red-600">
                        {{session('password_validation')}}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('savePassword') }}" class="xl:py-10">
                        @csrf

                        <!-- Old Password -->
                        <div class="mt-4">
                            <x-label for="oldPassword" :value="__('Old Password')" class="font-bold text-base" />

                            <x-input id="oldPassword" class="mt-1 w-1/2" type="password" name="oldPassword" :value="old('oldPassword')" required autofocus />
                        </div>

                        <!-- New Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('New Password')" class="font-bold text-base" />

                            <x-input id="password" class="mt-1 w-1/2" type="password" name="password" :value="old('password')" required autofocus />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" class="font-bold text-base" />

                            <x-input id="password_confirmation" class="mt-1 w-1/2" type="password" name="password_confirmation" required />
                        </div>

                        <div class="inline-block items-center mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                Forgot your password?
                            </a>
                            <x-button class="mt-5 md:ml-56 mx-auto">
                                Submit
                            </x-button>
                        </div>
                    </form>



                </div>




            </div>
        </div>
    </div>
</x-app-layout>