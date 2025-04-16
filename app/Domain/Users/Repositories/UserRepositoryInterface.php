<?php

namespace App\Domain\Users\Repositories;

use App\Interfaces\Http\Requests\LoginRequest;
use App\Interfaces\Http\Requests\RegisterRequest;

interface UserRepositoryInterface {
    public function register(RegisterRequest $request):array;
    public function login(LoginRequest $request):array;
    public function logout();
}