<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\User;

class BookController extends Controller
{
    public function index() {

        $comments = Comment::get();
        
        return view('list')->with('comments', $comments);
    }

    public function profile($id) {

        $comments = Comment::where('user_id', $id)->get();
        $user = User::where('id', $id)->first();
        
        return view('profile')->with('comments', $comments)->with('user', $user);
    }

    public function comment(Request $request) {

        if (Auth::check()) {

            $comment = new Comment;

            $comment->user_id = Auth::id();
            $comment->user_name = Auth::user()->name;
            $comment->text = $request->comment;

            $comment->save();
        }

        return redirect(route('list'));
    }
}