<div id="backgroundPop" class="h-full w-full fixed"></div>
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" mx-auto w-4/6 sm:px-6 cop lg:px-8 ">
            @foreach($user as $u)
            <div class="overflow-hidden h-auto pb-3 pt-3 border-b">
                <div class="inline-block w-1/3 float-left">
                    <img src="{{url('getImage/'.$u->image)}}" class=" mx-auto  rounded-full w-20 h-20 " alt="IMAGEN">
                </div>

                <div class="inline-block w-2/3">
                    <a href="{{url('profile/'.$u->id)}}">
                        <p class="text-lg hover:underline">{{$u->name}} {{$u->lastname}}</p>
                    </a>
                    <p class="text-base mt-1 text-gray-500">@ {{$u->nick}} </p>
                    <p class="mt-5 text-base"><strong>{{count($u->images)}}</strong> <?= (count($u->images) == 1) ? 'post' : 'posts' ?></p>

                </div>
            </div>
            @endforeach
            {{$user->links()}}

        </div>
    </div>
</x-app-layout>