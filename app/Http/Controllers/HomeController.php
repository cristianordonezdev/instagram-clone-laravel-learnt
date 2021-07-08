<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Suscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('id', 'desc')->get();
        $suscribers = Suscriber::where('suscriber_id', Auth::user()->id)->get();
        $posts = array();

        //ALGORITMO PARA MOSTRAR SOLO LOS POST DE A LOS QUE ESTOY SUSCRITO
        foreach ($images as $img) {
            if ($img->user->id == Auth::user()->id) {
                array_push($posts, $img);
            }
            foreach ($suscribers as $sus) {
                if ($img->user->id == $sus->user_id) {
                    array_push($posts, $img);
                }
            }
        }
        // foreach($images as $img){
        //     var_dump($img->id);
        // }
        // die();
        return view('dashboard', array(
            'images' => $posts,
            'suscribers' => $suscribers
        ));
    }
};
