<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadCategoryController extends ApiController
{
    public function execute(int $id): JsonResponse
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
