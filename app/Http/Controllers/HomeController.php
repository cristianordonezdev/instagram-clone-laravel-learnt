<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function index(){
        $images = Image::orderBy('id','desc')->paginate(4);
        return view('dashboard',array(
            'images'=>$images
        ));
    }
}
