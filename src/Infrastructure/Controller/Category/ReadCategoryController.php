<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadCategoryController extends ApiController
{
    public function execute(int $id, CategoryRepository $categoryRepository): JsonResponse
    {
        $categoryId = CategoryId::fromInt($id);
        $category = $categoryRepository->findById($categoryId);

        if (null === $category) {
            return self::buildNotFoundResponse();
        }

        return self::buildResponseFromArray([
            'parent_id' => $category->parentId()?->value(),
            'name' => $category->name()->value(),
            'slug' => $category->slug()->value(),
            'visible' => $category->visible()
        ]);
    }
}
