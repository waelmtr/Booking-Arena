<?php

namespace Tests\Unit;

use App\Domain\Arenas\Models\Arena;
use App\Domain\Users\Enums\RoleEnum;
use App\Domain\Users\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArenaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_arena_can_be_created()
    {
        $owner = User::create([
            "name" => "wael" ,
            "email" => "wael@gmail.com" ,
            "password" => "12345678" ,
            "role" => RoleEnum::ArenaOwner->value
        ]);
        $arena = Arena::create([
            'name' => 'Test Arena',
            'description' => 'this is test arena',
            'location' => [
                "lon" => 33.4 ,
                "lat" => 34.6 ,
            ] ,
            'owner_id' => $owner->id
        ]);
        $this->assertInstanceOf(Arena::class, $arena);
    }
}
