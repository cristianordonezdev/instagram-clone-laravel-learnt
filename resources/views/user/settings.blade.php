<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-24">
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
                    <img src="{{url('getImage/'.Auth::user()->image)}}" class="mx-auto rounded-full w-32 h-32 -mt-5" alt="IMAGEN">
                    @else   
                    <img src="{{url('getImage/default_user.png')}}" class="mx-auto rounded-full w-32 mt-5" alt="IMAGEN">
                    @endif

                    <a href="" class="block mt-3 font-bold color text-blue-400 hover:underline">Change Profile Photo</a>

                    <!-- Errors of validation -->
                    <x-auth-validation-errors class="mt-4" :errors="$errors" />




                    <form method="POST" enctype="multipart/form-data" action="{{ url('update') }}" class="xl:py-10">
                        @csrf

                        <!-- Image -->

                        <div>
                            <x-label for="image" :value="__('Image')" class="font-bold text-base" />

                            <x-input id="image" class="mt-1 w-1/2" type="file" name="image" :value="Auth::user()->image"  autofocus />
                        </div>

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" class="font-bold text-base" />

                            <x-input id="name" class="mt-1 w-1/2" type="text" name="name" :value="Auth::user()->name" required autofocus />
                        </div>

                        <!-- Lastname -->
                        <div class="mt-4">
                            <x-label for="lastname" :value="__('Lastname')" class="font-bold text-base" />

                            <x-input id="lastname" class="mt-1 w-1/2" type="text" name="lastname" :value="Auth::user()->lastname" required autofocus />
                        </div>

                        <!-- Nick -->
                        <div class="mt-4">
                            <x-label for="nick" :value="__('Nick')" class="font-bold text-base" />

                            <x-input id="nick" class="mt-1 w-1/2" type="text" name="nick" :value="Auth::user()->nick" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" class="font-bold text-base" />

                            <x-input id="email" class="mt-1 w-1/2" type="email" name="email" :value="Auth::user()->email" required />
                        </div>

                        <div class="flex items-center mt-4">

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