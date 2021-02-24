<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepository;


class UserController extends Controller
{
    private $userRepo;

    function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function userLogin(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password'=> 'required'
            ]);

            if($validator->fails()) throw new \Exception($validator->errors()->first(), 403);

            if(!$user = $this->userRepo->login($request->all())) throw new \Exception('User not found', 404);

            return success($user, 'Login Successful', ['token' => $user->createToken($user->email)->accessToken]);

        } catch (\Throwable $th) {
            return error($th->getMessage(), 500);
        }
    }

    public function adminLogin(Request $request){

    }
}
