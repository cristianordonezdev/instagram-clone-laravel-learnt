<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{


    public function uploadImage()
    {
        return view('image.uploadImage');
    }

    public function uploadImageSave(Request $request)
    {

        //Validando mis datos

        $validate = $this->validate($request, array(
            'image' => 'required|mimes:png,jpg,jpeg'
        ));

        //Guardando mis valores
        $image = $request->file('image');
        $decription = $request->input('description');

        //Guardando en la base de datos
        $img = new Image();
        $img->user_id = Auth::user()->id;
        $img->description = $decription;
        if ($image) {
            $image_naem = time() . $image->getClientOriginalName();
            Storage::disk('images')->put($image_naem, File::get($image));
            $img->image_path = $image_naem;
        }

        $img->save();

        return redirect('/')->with('message', 'The post has been uploaded');
    }

    public function getImagePost($image_name){
        $file = Storage::disk('images')->get($image_name);
        return Response($file,200);
    }

    public function detail($id){
        $img = Image::find($id);

        return view('image.detail',array(
            'img' => $img
        ));
    }
}
