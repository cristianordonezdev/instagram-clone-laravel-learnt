<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Models\Like;

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

    public function deleteImage($id){
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id',$id)->get();
        $likes = Like::where('image_id',$id)->get();

        if($user && $image && $user->id == $image->user_id){

            //ELIMINANDO LOS COMENTARIOS
            if($comments && count($comments) > 0){
                foreach($comments as $com){
                    $com->delete();
                }
            }
            //ELIMINANDO LIKES

            if($likes && count($likes) > 0){
                foreach($likes as $li){
                    $li->delete();
                }
            }

            //ELIMINANDO EL STORAGE

            Storage::disk('images')->delete($image->image_path);

            //ELIMINAR REGISTO DE IMAGEN
            $image->delete();
        }

        return redirect('/')->with('message','The post has been deleted');
    }

    public function editImage($id){
        $img = Image::find($id);
        return view('image.editImage',['img'=>$img]);
    }

    public function editSave(Request $request){

        $validate = $this->validate($request, array(
            'image' => 'mimes:png,jpg,jpeg'
        ));


        $user = Auth::user();
        $oldImage = Image::find($request->input('id'));
        $image = $request->file('image');
        $description = $request->input('description');

        if($image){
            Storage::disk('images')->delete($oldImage->image_path);

            $image_naem = time() . $image->getClientOriginalName();
            Storage::disk('images')->put($image_naem, File::get($image));
            $oldImage->image_path = $image_naem;
        }
        $oldImage->description = $description;
        $oldImage->update();

        return redirect('/')->with('message','The post has been uploaded');
    }
}
