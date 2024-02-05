<?php

namespace App\Providers;

use Airzone\Application\Command\Category\Create\CreateCategory;
use Airzone\Application\Command\Category\Create\CreateCategoryCommand;
use Airzone\Application\Command\Category\Delete\DeleteCategory;
use Airzone\Application\Command\Category\Delete\DeleteCategoryCommand;
use Airzone\Application\Command\Category\Update\UpdateCategory;
use Airzone\Application\Command\Category\Update\UpdateCategoryCommand;
use Airzone\Application\Query\Category\Read\ReadCategory;
use Airzone\Application\Query\Category\Read\ReadCategoryQuery;
use Airzone\Application\Query\Post\Read\ReadPost;
use Airzone\Application\Query\Post\Read\ReadPostQuery;
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
        $this->app->singleton(
            abstract: CommandBus::class,
            concrete: SimpleCommandBus::class
        );
        $this->app->singleton(
            abstract: QueryBus::class,
            concrete: SimpleQueryBus::class
        );
    }

    public function boot(): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = \app(CommandBus::class);
        $commandBus->register(CreateCategoryCommand::class, \app(CreateCategory::class));
        $commandBus->register(DeleteCategoryCommand::class, \app(DeleteCategory::class));
        $commandBus->register(UpdateCategoryCommand::class, \app(UpdateCategory::class));

        /** @var QueryBus $queryBus */
        $queryBus = \app(QueryBus::class);
        $queryBus->register(ReadCategoryQuery::class, \app(ReadCategory::class));
        $queryBus->register(ReadPostQuery::class, \app(ReadPost::class));
    }
}
