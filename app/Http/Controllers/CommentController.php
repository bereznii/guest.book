<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Notification;

use App\User;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Checks middlewares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Auth::user()->isAdmin()) {
            Comment::destroy($id);
        }
        
        return redirect(route('list'));
    }

    /**
     * Send notification to users about new comment via Queue.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function sendNotifications() {

        $users = User::where('id', '!=', Auth::id())->get();

        Notification::send($users, new NewCommentNotification());
    }
}
