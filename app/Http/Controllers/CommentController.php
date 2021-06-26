<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function saveComment(Request $request){

        $validation = $this->validate($request,array(
           'comment' => 'required'
        ));
        $image_id = $request->input('image_id');
        $commentForm= $request->input('comment');
        $user = Auth::user()->id;
        $comment = new Comment();
        
        $comment->user_id = $user;
        $comment->image_id = $image_id;
        $comment->content = $commentForm;
        $comment->save();

        return redirect('detail/'.$image_id);
    }

    public function deleteComment($id){

        $user = Auth::user();
        $comment = Comment::find($id);

        if($comment->user_id==$user->id || $comment->image->user_id==$user->id){
            $comment->delete();
        }

        return redirect('detail/'.$comment->image->id);
    }
}
