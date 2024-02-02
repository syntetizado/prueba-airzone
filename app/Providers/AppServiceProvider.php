<?php

namespace App\Providers;

use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Post\PostRepository;
use Airzone\Infrastructure\Repository\EloquentCategoryRepository;
use Airzone\Infrastructure\Repository\EloquentPostRepository;
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
    }

    public function boot(): void
    {
    }
}
