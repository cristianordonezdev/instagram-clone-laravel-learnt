<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller{
    public function like($image_id){
        $user_id = Auth::user()->id;
        
        $isset_like = Like::where('user_id',$user_id)->where('image_id',$image_id)->count();


        if($isset_like==0){
            $like = new Like();
            $like->user_id = $user_id;
            $like->image_id=$image_id;
            $like->save();
            
            return Response()->json([
                'like'=> $like
            ]);
        }else{
            $like = Like::where('user_id',$user_id)->where('image_id',$image_id)->first();
            $like->delete();
        }
        die();
    }
}
