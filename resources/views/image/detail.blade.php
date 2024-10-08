<x-app-layout>
    <div class="backgroundPop" class="">

        <div class="optionsBox bg-white flex mx-auto w-1/6 sm:rounded-lg mb-12">

            <div class="block text-base text-red-500  font-bold border-b text-center"><a href="{{url('deleteImage/'.$img->id)}}" class="p-3 block">Delete</a></div>
            <span class="block text-base text-center font-bold"><a href="{{url('editImage/'.$img->id)}}" class="p-3 block">Edit</a></span>


        </div>


    </div>
    <div class="py-12 mx-auto">
        <div class=" mx-auto lg:w-4/6 sm:px-6 cop lg:px-8 ">

            <div class="bg-white overflow-hidden cof shadow-sm sm:rounded-lg mb-12">



                <div class="md:w-8/12 float-left coi">
                    <img class="w-full" src="{{url('getImagePost/'.$img->image_path)}}" alt="">
                </div>
                <div class="md:w-4/12 sm:w-full cod p-3 conta float-left block ">

                    <!-- NOMBRE Y FOTO DEL USUARIO -->
                    <div class="border-b-2 block pb-2 conuser">

                        <div class="inline-block w-2/12 float-left">
                            @if($img->user->image)
                            <img src="{{url('getImage/'.$img->user->image)}}" class="rounded-full w-12 h-12 object-cover my-3 mx-auto " alt="IMAGEN">
                            @else
                            <img src="{{url('getImage/default_user.png')}}" class="rounded-full w-12 my-3  object-cover mx-auto" alt="IMAGEN">
                            @endif
                        </div>
                        <a href="{{url('profile/'.$img->user->id)}}">
                            <p class="hover:underline my-7 pl-1 float-left w-8/12 text-sm font-bold inline-block">{{$img->user->name }} {{$img->user->lastname}} </p>
                        </a>
                        @if(Auth::user()->id==$img->user_id)
                        <button class="options inline-block float-left w-2/12 my-7 focus:outline-none"><i class=" cursor-pointer text-sm fas fa-ellipsis-h"></i></button>
                        @endif
                    </div>
                    <!-- ESTADO DE LA FOTO -->
                    <div class="block conestado border-b-2 overflow-hidden">
                        <p class="pb-5 pt-3"><span class="font-bold mr-3">{{$img->user->name }}</span> {{$img->description}}</p>

                        <!-- COMENTARIOS -->
                        @foreach($img->comments as $com)
                        <p> <span class="font-bold">@ {{$com->user->nick }} </span>{{$com->content}}</p>
                        <p class="text-gray-400 text-sm mb-2"> {{\FormatTime::LongTimeFilter($com->created_at )}} </p>

                        @if($com->user_id==Auth::user()->id || $com->image->user_id==Auth::user()->id)
                        <a href="{{url('deleteComment/'.$com->id)}}">eliminar</a>
                        @endif
                        @endforeach
                    </div>
                    <!-- ICONOS LIKE, LIKES, Y HORA -->
                    <div class="block border-b-2 mt-2 ">
                        <?php $existLike = false; ?>
                        @foreach($img->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $existLike = true; ?>
                        @endif
                        @endforeach

                        @if($existLike)
                        <span class=""> <button class="focus:outline-none fas fa-heart text-2xl text-red-500 like" data-id="{{$img->id}}"> </button> <a href="{{url('detail/'.$img->id)}}"><i class="far fa-comment text-2xl pl-3"></i></a> </span>
                        @else
                        <span class=""> <button class="focus:outline-none far fa-heart text-2xl like" data-id="{{$img->id}}"></button> <a href="{{url('detail/'.$img->id)}}"><i class="far fa-comment text-2xl pl-3"></i></a> </span>
                        @endif


                        <?php $others = "" ?>
                        @foreach($img->likes as $likes)
                        @if( count($img->likes) > 1)
                        <?php $others = " and others" ?>
                        @endif
                        <p class="">Liked by <strong>{{$likes->user->name}}</strong> {{$others}}</p>
                        @break
                        @endforeach
                        <p class="text-gray-400"> {{\FormatTime::LongTimeFilter($img->created_at )}}s </p>
                    </div>

                    <div class="block ">
                        <!-- PUBLICAR COMENTARIO-->
                        <x-auth-validation-errors class="mt-4" :errors="$errors" />

                        <form action="{{url('saveComment')}}" class="mt-2" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="image_id" value="{{$img->id}}">
                            <textarea name="comment" placeholder="Add a comment..." class="w-5/6 float-left border-0 overflow-hidden placeholder-gray-400 h-14 focus:ring-0 focus:outline-none" required></textarea>
                            <input type="submit" value='Post' class="ml-3 mt-3 text-lg float-left font-bold text-blue-400 bg-transparent cursor-pointer hover:text-blue-300">
                        </form>


                    </div>


                </div>



            </div>
        </div>
        <!-- <div class="w-4/12 sm:px-6 lg:px-8 inline-block">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-auto mb-12">


            </div>
        </div> -->


    </div>
</x-app-layout>
<!-- <x-slot name="header">
    
    </x-slot> -->