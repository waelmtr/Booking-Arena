<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Users\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\LoginRequest;
use App\Interfaces\Http\Requests\RegisterRequest;

class UserController extends Controller {
    public function __construct(private UserRepositoryInterface $userRepository){}

    public function register(RegisterRequest $request){
        $result = $this->userRepository->register($request);
        return $this->success($result);
    }
    public function login(LoginRequest $request){
        $result = $this->userRepository->login($request);
        return $this->success($result);
    }
    public function logout(){
        $result = $this->userRepository->logout();
        return $this->success($result);
    }
}