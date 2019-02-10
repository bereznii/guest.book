<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Checks is current user is admin.
     */
    public function isAdmin() {
        if($this->where('id', Auth::id())->first()->role == 'admin') return 1;
    }

    /**
     * Checks is current user is blocked.
     */
    public function isBlocked() {
        if($this->where('id', Auth::id())->first()->blocked == '1') return 1;
    }
}
