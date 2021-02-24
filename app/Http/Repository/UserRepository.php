<?php

namespace App\Http\Repository;

use App\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


Class UserRepository 
{
    private $user, $admin;

    function __construct(User $user, Admin $admin){
        $this->user = $user;
        $this->admin = $admin;
    }

    function listAdmins(){

        if($search = request('search')):
            $this->admin = $this->admin->where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('mobile', 'like', '%'.$search.'%');
        endif;
        $this->admin = $this->admin->orderBy('updated_at', 'desc')->get();
        return getPaginationData($this->admin);
    }

    function listUsers(){
        if($search = request('search')):
            $this->user = $this->user->where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%'.$search.'%')
            ->orWhere('mobile', 'like', '%'.$search.'%');
        endif;
        $this->user = $this->user->orderBy('updated_at', 'desc')->get();
        return getPaginationData($this->user);
    }

    function login($data, $type = 'user') {

        if($data['login_type'] == 'email'){
            if($type == 'user'){
                $user = $this->user->where('email', $data['email'])->first();
            }
    
            if($type == 'admin'){
                $user = $this->admin->where('email', $data['email'])->first();
            }
            
            if(!$user || Hash::check($user->password, $data['password'])) return false;
        } else {
            $user = $this->user->where('social_id', $data['social_id'])->where('login_type', $data['login_type'])->first();
            
            if(!$user) return false;
        }

        $user->touch();

        return $user;

    }
}