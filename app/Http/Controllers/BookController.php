<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Notification;

use App\Comment;
use App\User;

class BookController extends Controller
{
    public function index() {

        $comments = Comment::orderBy('created_at', 'desc')->paginate(15);
        
        return view('list', ['comments' => $comments]);
    }

    public function profile($id) {

        $comments = Comment::where('user_id', $id)->get();
        $user = User::where('id', $id)->first();
        
        return view('profile', ['comments' => $comments,
                                'user' => $user]);
    }

    public function comment(Request $request) {

        $validatedData = $request->validate([
            'comment' => 'required',
        ]);

        if (Auth::check()) {

            $comment = new Comment;

            $comment->user_id = Auth::id();
            $comment->user_name = Auth::user()->name;
            $comment->text = $request->comment;

            $comment->save();
        }

        $this->sendNotifications();

        return redirect(route('list'));
    }

    private function sendNotifications() {

        $users = User::where('id', '!=', Auth::id())->get();

        Notification::send($users, new NewCommentNotification());
    }
}