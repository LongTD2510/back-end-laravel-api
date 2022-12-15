<?php

namespace App\Providers;

use App\Repositories\Auth\AuthInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Post\PostInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Room\RoomInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(RoomInterface::class, RoomRepository::class);
        $this->app->bind(MessageInterface::class, MessageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
