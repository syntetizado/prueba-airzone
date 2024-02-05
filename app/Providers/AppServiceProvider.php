<?php

namespace App\Providers;

use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Post\PostRepository;
use Airzone\Infrastructure\Repository\EloquentCategoryRepository;
use Airzone\Infrastructure\Repository\EloquentPostRepository;
use Airzone\Shared\Cqrs\CommandBus;
use Airzone\Shared\Cqrs\CommandBus\SimpleCommandBus;
use Airzone\Shared\Cqrs\QueryBus;
use Airzone\Shared\Cqrs\QueryBus\SimpleQueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: CategoryRepository::class,
            concrete: EloquentCategoryRepository::class
        );
        $this->app->bind(
            abstract: PostRepository::class,
            concrete: EloquentPostRepository::class
        );
        $this->app->bind(
            abstract: CommandBus::class,
            concrete: SimpleCommandBus::class
        );
        $this->app->bind(
            abstract: QueryBus::class,
            concrete: SimpleQueryBus::class
        );
    }

    public function boot(): void
    {
    }
}
