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

        if(Auth::user() && Auth::user()->isAdmin()) {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }
        //Auth::user()->isAdmin();

        $comments = Comment::orderBy('created_at', 'desc')->paginate(15);
        
        return view('list', [
            'comments' => $comments,
            'isAdmin' => $isAdmin
        ]);
    }

    public function getProfile($id) {

        if(Auth::user() && Auth::user()->isAdmin()) {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }

        $comments = Comment::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $user = User::where('id', $id)->first();
        
        return view('profile', [
            'comments' => $comments,
            'user' => $user,
            'isAdmin' => $isAdmin
        ]);
    }

    public function setComment(Request $request) {

        $validatedData = $request->validate([
            'comment' => 'required',
        ]);

        if (Auth::check() && !Auth::user()->isBlocked()) {

            $comment = new Comment;

            $comment->user_id = Auth::id();
            $comment->user_name = Auth::user()->name;
            $comment->text = $request->comment;

            $comment->save();
            
            $this->sendNotifications();
        }

        return redirect(route('list'));
    }

    public function destroyComment($id) {
        
        if(Auth::user()->isAdmin()) {
            Comment::destroy($id);
        }
        
        return redirect(route('list'));
    }

    public function updateUser(Request $request, $id) {
        
        $user = User::find($id);
        $user->blocked = $request->blocked;
        $user->save();
        
        return redirect(route('profile', ['id' => $id]));
    }

    private function sendNotifications() {

        $users = User::where('id', '!=', Auth::id())->get();

        Notification::send($users, new NewCommentNotification());
    }
}