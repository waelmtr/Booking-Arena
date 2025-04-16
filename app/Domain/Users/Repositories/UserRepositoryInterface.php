<?php

namespace App\Domain\Users\Repositories;

interface UserRepositoryInterface {
    public function register($request){}
    public function login($request)  {}
    public function logout() {} 
}