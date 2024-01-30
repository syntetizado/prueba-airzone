<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Model\CategoryDao;
use Airzone\Infrastructure\Model\Factory\CategoryDaoFactory;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadCategoryController extends ApiController
{
    public function execute(int $id, CategoryDaoFactory $factory): JsonResponse
    {
        $categoryDao = CategoryDao::find($id);

        if (!$categoryDao) {
            return self::buildNotFoundResponse();
        }

        return self::buildResponseFromArray([
            'id' => $categoryDao->id,
            'parent_id' => $categoryDao->parent_id,
            'name' => $categoryDao->name,
            'slug' => $categoryDao->slug,
            'visible' => $categoryDao['visible'],

        ]);
    }
}
