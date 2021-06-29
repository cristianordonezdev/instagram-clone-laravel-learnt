<div id="backgroundPop" class="h-full w-full fixed"></div>
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" mx-auto w-4/6 sm:px-6 cop lg:px-8 ">

            <div class="overflow-hidden h-auto mb-12">
                <div class="inline-block w-1/3 float-left"> 
                    <img src="{{url('getImage/'.$user->image)}}" class=" mx-auto    rounded-full w-44 h-44 " alt="IMAGEN">
                </div>

                <div class="inline-block w-2/3"> 
                    <p class="text-3xl">{{$user->name}} {{$user->lastname}}</p>
                    @foreach($suscriber as $s)
                        <p>{{$s}}</p>
                    @endforeach
                    <p class="text-xl mt-1 text-gray-500">@ {{$user->nick}} </p>
                    <div class="">
                    <p class="inline-block display-left mt-5 text-lg"><strong>{{count($user->images)}}</strong> <?= (count($user->images)==1) ? 'post' : 'posts'?></p>
                    <p class="ml-5 inline-block display-left mt-5 text-lg"><strong>{{count($user->suscribers)}}</strong> followers</p>
                    </div>
                </div>
            </div>

            <div class="border-t-2 overflow-hidden h-screen  mb-12">
                <h1 class="text-center m-3 text-3xl block">Posts</h1>


                <div class="grid gap-4 grid-cols-3">
                    @foreach($user->images as $img)

                    <div class="">
                        <img class=" imgProfile" src="{{url('getImagePost/'.$img->image_path)}}" alt="">
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