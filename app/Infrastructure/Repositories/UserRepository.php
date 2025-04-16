<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use App\Domain\Users\Service\UserService;
use App\Interfaces\Http\Requests\LoginRequest;
use App\Interfaces\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
    public function __construct(private User $model , private UserService $userService){
        parent::__construct($this->model);
    }

    public function register(RegisterRequest $request) : array{
        $user = $this->model->create($request->validated());
        $token = $this->userService->createToken($user);
        return ["user" => $user , "token" => $token];
    }

    public function login(LoginRequest $request) : array{
        $user = $this->model->where('email' , $request->email)->first();
        if(!$user || !Hash::check($request->password , $user->password)){
            throw new UnauthorizedException("password or email is incorrect" , 401);
        }
        $token = $this->userService->createToken($user);
        return ["user" => $user , "token" => $token];
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return true;
    }
}