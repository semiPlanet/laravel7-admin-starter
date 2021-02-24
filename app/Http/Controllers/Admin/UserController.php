<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\UserRepository;

class UserController extends Controller
{
    private $repo;

    function __construct(UserRepository $repo){

        $this->repo = $repo;

        $this->middleware('auth:admin');

    }

    public function listAdmins(){
        
        $users = $this->repo->listAdmins();

        return view('admin.list-admin', compact('users'));
    }

    public function listUsers(){

        $users = $this->repo->listUsers();

        return view('admin.list-user', compact('users'));
    }
}
