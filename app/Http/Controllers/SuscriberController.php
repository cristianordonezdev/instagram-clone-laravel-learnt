<?php

namespace App\Http\Controllers;

use App\Models\Suscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscriberController extends Controller
{
    public function suscribeAction($user_id)
    {
        $suscriberPerson = Auth::user()->id;

        $isset_suscriber = Suscriber::where('user_id', $user_id)->where('suscriber_id', $suscriberPerson)->count();
        if ($isset_suscriber == 0 && $suscriberPerson != $user_id) {
            $suscriber = new Suscriber();
            $suscriber->suscriber_id = $suscriberPerson;
            $suscriber->user_id = $user_id;
            $suscriber->save();

            return Response()->json([
                'suscriber' => $suscriber
            ]);
        } else {
            $suscriber = Suscriber::where('user_id', $user_id)->where('suscriber_id', $suscriberPerson)->first();
            if ($suscriber) {
                $suscriber->delete();
            }
        }

        // if($isset_like==0){
        //     $like = new Like();
        //     $like->user_id = $user_id;
        //     $like->image_id=$image_id;
        //     $like->save();

        //     return Response()->json([
        //         'like'=> $like
        //     ]);
        // }else{
        //     $like = Like::where('user_id',$user_id)->where('image_id',$image_id)->first();
        //     $like->delete();
        // }
        // die();
    }
}
