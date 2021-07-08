<x-app-layout>

    <!-- ---------------------------------------------------------------------------------------------- -->
    <div class="backgroundPop" class="">
        <div class="optionsBox bg-white overflow-y-scroll  mx-auto w-3/12 sm:rounded-lg mb-12">
            <!-- APARTADO QUE MUESTRA LOS SEGUIDORES -->
            <span class="block text-base font-bold border-b text-center p-3"> Followers</span>
            @foreach($user->suscribers as $s)
            <div class="border-b block h-16">

                <!-- SI EL USUARIO TIENE UNA IMAGEN -->
                @if($s->users->image)
                <div class="w-2/12 inline-block pt-3 pb-3 float-left "><img src="{{url('getImage/'.$s->users->image)}}" class="mx-auto rounded-full  object-cover w-10 h-10 " alt="IMAGEN"></div>
                @else
                <div class="w-2/12 inline-block pt-3 pb-3 float-left "><img src="{{url('getImage/default_user.png')}}" class="mx-auto rounded-full  object-cover w-10 h-10 " alt="IMAGEN"></div>
                @endif

                <!-- NOMBRE Y NICK -->
                <div class="inline-block mt-3 w-7/12 float-left">
                    <span class="text-base font-bold float-none block"><a href="{{url('profile/'.$s->users->id)}}" class="">{{$s->users->name}}</a></span>
                    <span class="text-sm text-gray-400 block">@ {{$s->users->nick}}</span>
                </div>

                <!-- BOTON DE SEGUIR CON SU LOGICA -->
                <div>
                    <!-- YA ESTOY SUSCRITO AL USUARIO -->
                    <?php $existSus = false; ?>
                    @foreach($s->users->suscribers as $us)
                    @if($us->suscriber_id == Auth::user()->id)
                    <?php $existSus = true; ?>
                    @endif
                    @endforeach

                    <!-- SI ESTOY SUSCRITO -->
                    @if(Auth::user()->id != $s->users->id)
                    @if($existSus)
                    <button class="inline-block mt-3 focus:outline-none border rounded-lg font-bold float-none text-xs p-2 suscribe bg-white w-2/12 " data-id="{{$s->users->id}}" value="Suscribe">Unsuscribe</button>
                    @else
                    <button class="inline-block mt-3 focus:outline-none p-2 bg-blue-500 rounded-lg text-white font-bold text-xs  suscribe bg-white w-2/12 " data-id="{{$s->users->id}}" value="Suscribe">Suscribe</button>
                    @endif
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------------------- -->


    <!-- ---------------------------------------------------------------------------------------------- -->
    <div class="backgroundPop2" class="h-full w-full fixed ">
        <div class="optionsBox bg-white overflow-y-scroll mx-auto w-3/12 h-auto max-h-96 sm:rounded-lg mb-12">
            <!-- APARTADO QUE MUESTRA A QUIEN SIGUES -->
            <span class="block text-base font-bold border-b text-center p-3"> Following</span>
            @foreach($suscriber as $s)
            <div class="border-b block h-16">
                <!-- SI EL USUARIO TIENE UNA IMAGEN -->
                @if($s->suscriberModel->image)
                <div class="w-2/12 inline-block pt-3 pb-3 float-left "><img src="{{url('getImage/'.$s->suscriberModel->image)}}" class="mx-auto rounded-full  object-cover w-10 h-10 " alt="IMAGEN"></div>
                @else
                <div class="w-2/12 inline-block pt-3 pb-3 float-left "><img src="{{url('getImage/default_user.png')}}" class="mx-auto rounded-full  object-cover w-10 h-10 " alt="IMAGEN"></div>
                @endif

                <!-- NOMBRE Y NICK -->
                <div class="inline-block mt-3 w-7/12 float-left">
                    <span class="text-base font-bold float-none block"><a href="{{url('profile/'.$s->users->id)}}" class="">{{$s->suscriberModel->name}}</a></span>
                    <span class="text-sm text-gray-400 block">@ {{$s->suscriberModel->nick}}</span>
                </div>

                <!-- BOTON DE SEGUIR CON SU LOGICA -->
                <div>
                    <!-- YA ESTOY SUSCRITO AL USUARIO -->
                    <?php $existSus = false; ?>
                    @foreach($s->suscriberModel->suscribers as $us)
                    @if($us->suscriber_id == Auth::user()->id)
                    <?php $existSus = true; ?>

                    @endif
                    @endforeach

                    <!-- SI ESTOY SUSCRITO -->
                    @if(Auth::user()->id != $s->suscriberModel->id)
                    @if($existSus)
                    <button class="inline-block mt-3 focus:outline-none border rounded-lg font-bold float-none text-xs p-2 suscribe bg-white w-2/12 " data-id="{{$s->suscriberModel->id}}" value="Suscribe">Unsuscribe</button>
                    @else
                    <button class="inline-block mt-3 focus:outline-none p-2 bg-blue-500 rounded-lg text-white font-bold text-xs  suscribe bg-white w-2/12 " data-id="{{$s->suscriberModel->id}}" value="Suscribe">Suscribe</button>
                    @endif
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------------------- -->


    <x-slot name="header">
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" mx-auto lg:w-4/6 sm:px-6 cop lg:px-8 ">

            <div class="overflow-hidden h-auto mb-12">
                <div class="inline-block w-1/3 float-left">
                    <img src="{{url('getImage/'.$user->image)}}" class=" mx-auto rounded-full object-cover w-44 h-44 " alt="IMAGEN">
                </div>

                <div class="inline-block w-2/3">
                    <!-- NOMBRE Y BOTON DE SUSCRIBIRSE -->
                    <div>
                        <p class="text-3xl inline-block w-8/12 float-left">{{$user->name}} {{$user->lastname}}</p>
                        <?php $existSus = false; ?>
                        @foreach($user->suscribers as $u)

                        @if($u->suscriber_id == Auth::user()->id)
                        <?php $existSus = true; ?>

                        @endif
                        @endforeach
                        @if(Auth::user()->id != $user->id)
                        @if($existSus)
                        <button class="inline-block focus:outline-none border rounded-lg font-bold float-none p-2 suscribe bg-white w-3/12 " data-id="{{$user->id}}" value="Suscribe">Unsuscribe</button>
                        @else
                        <button class="inline-block float-none focus:outline-none p-2 bg-blue-500 rounded-lg text-white font-bold suscribe bg-white w-3/12 " data-id="{{$user->id}}" value="Suscribe">Suscribe</button>
                        @endif
                        @endif
                    </div>

                    <!-- NICK -->
                    <p class="text-xl mt-1 p-0 clear-both w-auto text-gray-500">@ {{$user->nick}} </p>
                    <div class="">
                        <p class="inline-block display-left mt-5 text-lg"><strong>{{count($user->images)}}</strong> <?= (count($user->images) == 1) ? 'post' : 'posts' ?></p>
                        <button class="ml-5 mt-5 focus:outline-none followers">
                            <p class="inline-block display-left  text-lg"><strong>{{count($user->suscribers)}}</strong> followers</p>
                        </button>
                        <button class="ml-5 mt-5 focus:outline-none following">
                            <p class=" inline-block display-left text-lg"><strong>{{count($suscriber)}}</strong> following</p>
                        </button>


                    </div>
                </div>
            </div>

            <div class="border-t-2 overflow-hidden h-screen  mb-12">
                <h1 class="text-center m-3 text-3xl block">Posts</h1>


                <div class="grid gap-2 grid-cols-3">
                    @foreach($user->images as $img)

                    <div class="">
                        <a href="{{url('detail/'.$img->id)}}"> <img class="imgProfile" src="{{url('getImagePost/'.$img->image_path)}}" alt=""></a>
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