<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Ip extends Model
{
    protected $fillable = ['user_id','ip'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
