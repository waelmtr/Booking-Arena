<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Models\User; 

class UserService {
    public function createToken(User $user){
        return $user->createToken('api-token')->plainTextToken;
    }
}