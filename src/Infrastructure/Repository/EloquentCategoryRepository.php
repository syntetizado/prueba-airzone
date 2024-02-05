<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository;

use Airzone\Domain\Category\Category;
use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Support\Facades\Cache;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function findById(CategoryId $id): ?Category
    {
        /** @var CategoryDao $categoryDao */
        $categoryDao = CategoryDao::find($id->value());

        if (null === $categoryDao) {
            return null;
        }

        return Category::fromValues([
            'id' => $categoryDao->id,
            'parent_id' => $categoryDao->parent_id,
            'name' => $categoryDao->name,
            'slug' => $categoryDao->slug,
            'visible' => $categoryDao->visible
        ]);
    }

    public function findByNameAndSlug(Name $name, Slug $slug): ?Category
    {
        /** @var CategoryDao $categoryDao */
        $categoryDao = CategoryDao::query()
            ->where('name', $name->value())
            ->orWhere('slug', $slug->value())
            ->first();

        if (null === $categoryDao) {
            return null;
        }

        return Category::fromValues([
            'id' => $categoryDao->id,
            'parent_id' => $categoryDao->parent_id,
            'name' => $categoryDao->name,
            'slug' => $categoryDao->slug,
            'visible' => $categoryDao->visible
        ]);
    }

    public function delete(CategoryId $id): void
    {
        CategoryDao::find($id->value())->delete();
    }

    public function save(Category $category): void
    {
        /** @var CategoryDao $categoryDao */
        $categoryDao = CategoryDao::find($category->id()->value());

        $categoryDao->parent_id = $category->parentId()?->value();
        $categoryDao->name = $category->name()->value();
        $categoryDao->slug = $category->slug()->value();
        $categoryDao->visible = $category->visible();

        $categoryDao->save();
    }

    public function create(Category $category): void
    {
        $categoryDao = new CategoryDao;

        $categoryDao->parent_id = $category->parentId()?->value();
        $categoryDao->name = $category->name()->value();
        $categoryDao->slug = $category->slug()->value();
        $categoryDao->visible = $category->visible();

        $categoryDao->save();

        Cache::set('CREATED_CATEGORY_ID', $categoryDao->id);
    }
}
