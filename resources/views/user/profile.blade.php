<div id="backgroundPop" class="h-full w-full fixed"></div>
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" mx-auto w-4/6 sm:px-6 cop lg:px-8 ">

            <div class="bg-white overflow-hidden h-screen shadow-sm sm:rounded-lg mb-12">
                <h1 class="text-center m-3 text-3xl block">Posts</h1>


                <div class="grid gap-4 grid-cols-3">
                    @foreach($user->images as $img)

                        <div class="">
                            <img class="w-full h-80" src="{{url('getImagePost/'.$img->image_path)}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- <div class="w-4/12 sm:px-6 lg:px-8 inline-block">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-auto mb-12">


            </div>
        </div> -->


    </div>
</x-app-layout>