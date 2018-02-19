<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Obnova extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'obnova';
    public $timestamps = false;
    
    
    protected $fillable = [
        'obnova_name','obnova_user_id', 'obnova_shop_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    
}