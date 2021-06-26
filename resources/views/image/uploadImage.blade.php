<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm  w-full border">
                <div class="p-6 bg-white border-b text-center border-gray-200">
                <h2 class="text-center text-3xl">Upload Image</h2>
                    <!-- Errors of validation -->
                    <x-auth-validation-errors class="mt-4" :errors="$errors" />

                    <form method="POST" enctype="multipart/form-data" action="{{ url('uploadImageSave') }}" class="xl:py-10">
                        @csrf

                        <!-- Image -->

                        <div>
                            <x-label for="image" :value="__('Image')" class="font-bold text-base mb-1" />
                            <x-input id="image" class="mt-1 w-3/4 border-gray-300" type="file" name="image" :value="Auth::user()->image" required autofocus />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-label for="description" :value="__('Description')" class="font-bold text-base mt-3" />
                            <textarea id="description" class="mt-1 w-3/4 h-40 border-gray-300 outline-none" name="description" :value="Auth::user()->description" autofocus></textarea>
                        </div>


                        <div class="flex items-center mt-4">

                            <x-button class="mt-5 mx-auto">
                                Submit
                            </x-button>
                        </div>
                    </form>



                </div>




            </div>
        </div>
    </div>
</x-app-layout>