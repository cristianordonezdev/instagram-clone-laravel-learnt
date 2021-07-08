<!-- <div id="backgroundPop" class="h-full w-full fixed"></div> -->
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" mx-auto w-4/6 sm:px-6 cop lg:px-8 ">
            @foreach($user as $u)
            <div class="overflow-hidden h-auto pb-3 pt-3 border-b">
                <div class="inline-block w-1/3 float-left">
                    <!-- <img src="{{url('getImage/'.$u->image)}}" class=" mx-auto  rounded-full object-cover w-20 h-20 " alt="IMAGEN"> -->
                    @if($u->image)
                    <img src="{{url('getImage/'.$u->image)}}" class="mx-auto rounded-full object-cover w-20 h-20 mt-5" alt="IMAGEN">
                    @else
                    <img src="{{url('getImage/default_user.png')}}" class="mx-auto rounded-full  object-cover w-20 h-20 mt-5" alt="IMAGEN">
                    @endif
                </div>

                <div class="inline-block w-2/3">
                    <a href="{{url('profile/'.$u->id)}}">
                        <p class="text-lg hover:underline">{{$u->name}} {{$u->lastname}}</p>
                    </a>
                    <p class="text-base mt-1 text-gray-500">@ {{$u->nick}} </p>
                    <p class="mt-5 text-base"><strong>{{count($u->images)}}</strong> <?= (count($u->images) == 1) ? 'post' : 'posts' ?></p>
                    <p class="mt-1 text-base"><strong>{{count($u->suscribers)}}</strong> followers</p>
                <!-- Boton de suscribir -->
                    <?php $existSus = false; ?>
                        @foreach($u->suscribers as $us)
                            <!-- <p>{{$us}}</p> -->
                            @if($us->suscriber_id == Auth::user()->id)
                                <?php $existSus = true; ?>
                            @endif
                        @endforeach

                        @if(Auth::user()->id != $u->id)
                            @if($existSus)
                                <button class="inline-block mt-3 focus:outline-none border rounded-lg font-bold float-none p-1 suscribe bg-white w-3/12 " data-id="{{$u->id}}" value="Suscribe">Unsuscribe</button>
                            @else
                                <button class="inline-block mt-3 focus:outline-none p-1 bg-blue-500 rounded-lg text-white font-bold suscribe bg-white w-3/12 " data-id="{{$u->id}}" value="Suscribe">Suscribe</button>
                            @endif
                        @endif
                </div>
            </div>
            @endforeach
            {{$user->links()}}

        </div>
    </div>
</x-app-layout>