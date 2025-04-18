<?php

namespace Tests\Unit;

use App\Domain\Arenas\Models\Arena;
use App\Domain\Users\Enums\RoleEnum;
use App\Domain\Users\Models\User;
use App\Infrastructure\Repositories\ArenaRepository;
use App\Interfaces\Http\Requests\ArenaRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ArenaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_arena_can_be_created()
    {
        $user = User::create([
            "name" => "wael" ,
            "email" => "wael@gmail.com" ,
            "password" => "12345678" ,
            "role" => RoleEnum::ArenaOwner->value ,
        ]);
        $this->actingAs($user);
    
        // Create a mock request
        $requestMock = Mockery::mock(ArenaRequest::class);
        $requestMock->shouldReceive('validated')
                   ->andReturn([
                       'name' => 'Test Arena',
                       'description' => 'This Is Test Arena' ,
                       'location' => [
                        "lon" => 33.4 ,
                        "lat" => 33.3 ,
                    ], 
                   ]);
    
        // Create repository instance and call the method
        $repository = new ArenaRepository(new Arena());
        $arena = $repository->create($requestMock);
    
        // Assertions
        $this->assertInstanceOf(Arena::class, $arena);
        $this->assertEquals('Test Arena', $arena->name);
        $this->assertEquals('This Is Test Arena', $arena->description);
        $this->assertEquals([
            "lon" => 33.4 ,
            "lat" => 33.3 ,
        ], $arena->location);
        $this->assertEquals($user->id, $arena->owner_id);
    }
}
