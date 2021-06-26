<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div class="bg-white overflow-hidden shadow-sm p-6 bg-green-200 mb-6 w-full border"> {{session('message')}}</div>
            @endif
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
             -->
            @foreach($images as $img)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-auto mb-12">
                <div class="">
                    <div class="inline-block w-1/12 float-left">
                        @if($img->user->image)
                        <img src="{{url('getImage/'.$img->user->image)}}" class="rounded-full w-10 h-10 my-3 mx-auto " alt="IMAGEN">
                        @else
                        <img src="{{url('getImage/default_user.png')}}" class="rounded-full w-10 my-3 mx-auto" alt="IMAGEN">
                        @endif
                    </div>


                    <a href="{{url('profile/'.$img->user->id)}}" ><p class="mt-5 w-11/12 inline-block hover:underline">{{$img->user->name }} {{$img->user->lastname}} <span class="text-gray-400">| @ {{$img->user->nick}}</span></p></a>
                    <div class="mb-3">
                        <img class="w-full block" src="{{url('getImagePost/'.$img->image_path)}}" alt="">
                    </div>

                    <!-- EXISTE EL USUARIO QUE LE HA DADO LIKE -->
                    <!-- @if(count($img->likes) ==0)
                        <span class="p-5"> <button class="focus:outline-none"><i id="like" class="far fa-heart text-2xl"></i></button> <a href="{{url('detail/'.$img->id)}}"><i class="far fa-comment text-2xl pl-3"></i></a> </span>

                    @endif -->
                    <?php $existLike = false;?>
                    @foreach($img->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $existLike = true;?>
                        @endif
                    @endforeach

                        @if($existLike)
                            <span class="p-5"> <button class="focus:outline-none fas fa-heart text-2xl text-red-500 like" data-id="{{$img->id}}"> </button> <a href="{{url('detail/'.$img->id)}}"><i class="far fa-comment text-2xl pl-3"></i></a> </span>
                        @else
                            <span class="p-5"> <button class="focus:outline-none far fa-heart text-2xl like"  data-id="{{$img->id}}"></button> <a href="{{url('detail/'.$img->id)}}"><i class="far fa-comment text-2xl pl-3"></i></a> </span>
                        @endif


                    <?php $others = "" ?>   
                    @foreach($img->likes as $likes)
                        @if( count($img->likes) > 1)
                            <?php $others = " and others" ?>
                        @endif
                        <p class="pl-5">Liked by <strong>{{$likes->user->name}}</strong> {{$others}}</p>
                        @break
                    @endforeach
                    <div>
                        <!-- COMENTARIOS Y DESCRPCION -->
                        <p class="pb-2 pl-5 pt-3 pr-5"><span class="font-bold mr-3">{{$img->user->name }}</span> {{$img->description}}</p>
                        <?php $var = 0; ?>
                        @if(count($img->comments) >= 3 )
                        <a href="{{url('detail/'.$img->id)}}">
                            <p class="pl-5 text-gray-400">View All {{count($img->comments)}} comments</p>
                        </a>
                        @endif
                        @foreach($img->comments as $com)
                            <p> <span class="font-bold pl-5">@ {{$com->user->nick }} </span>{{$com->content}}</p>
                            <?php $var++; ?>
                        @if($var==2)
                            @break
                        @endif
                        @endforeach


                        <p class="pb-2 pl-5 text-gray-400"> {{\FormatTime::LongTimeFilter($img->created_at )}} </p>
                    </div>


                </div>
            </div>
            @endforeach


            {{$images->links()}}
        </div>


    </div>
</x-app-layout>