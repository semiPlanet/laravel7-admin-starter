<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Ip;
use Laravel\Passport\HasApiTokens;
use App\Models\Order;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','device_token','address','lat','long','mobile','image','social_id','login_type','role'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($image){
        if(!$image) return asset('dist/img/default-150x150.png');
        return $image;
    }

    public function ips($sort = false){

        $sorting = $this->hasMany(Ip::class);
        
        if(!$sort) return $sorting;

        return $sorting->orderBy('updated_at','desc')->first();
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
