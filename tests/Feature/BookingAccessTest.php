<?php

namespace Tests\Feature;

use App\Domain\Users\Enums\RoleEnum;
use App\Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingAccessTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function allow_arena_owners_to_get_bookings(){
        $owner = User::create([
            "name" => "owner-arena" ,
            "email" => "owner-arena@gmail.com" ,
            "password" => "12345678" ,
            "role" => RoleEnum::ArenaOwner->value
        ]);
        $response = $this->actingAs($owner)->get('/api/bookings');
        $response->assertStatus(200);
    }

    public function denies_access_to_non_owners(){
        $user = User::create([
            "name" => "user" ,
            "email" => "user@gmail.com" ,
            "password" => "12345678" ,
            "role" => RoleEnum::User->value
        ]);
        $response = $this->actingAs($user)->get('/api/bookings');
        $response->assertForbidden();
    }
}
