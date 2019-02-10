<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\User;

class BookController extends Controller
{
    /**
     * Shows starting page with comments.
     *
     * @return 'list' view with comments.
     */
    public function index() {

        if(Auth::user() && Auth::user()->isAdmin()) {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }

        $comments = Comment::orderBy('created_at', 'desc')->paginate(15);
        
        return view('list', [
            'comments' => $comments,
            'isAdmin' => $isAdmin
        ]);
    }
}