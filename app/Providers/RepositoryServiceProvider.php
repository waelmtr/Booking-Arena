<?php

namespace App\Providers;

use App\Domain\Arenas\Repositories\ArenaRepositoryInterface;
use App\Domain\TimeSlots\Repositories\TimeSlotRepositoryInterface;
use App\Domain\Users\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\ArenaRepository;
use App\Infrastructure\Repositories\TimeSlotRepository;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
        $this->app->bind(ArenaRepositoryInterface::class , ArenaRepository::class);
        $this->app->bind(TimeSlotRepositoryInterface::class , TimeSlotRepository::class);
    //    $this->app->bind(ArenaRepositoryInterface::class , ArenaRepository::class);
    //    $this->app->bind(ArenaRepositoryInterface::class , ArenaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
