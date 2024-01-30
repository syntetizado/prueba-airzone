<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Model\CategoryDao;
use Airzone\Infrastructure\Model\Factory\CategoryDaoFactory;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class DeleteCategoryController extends ApiController
{
    public function execute(int $id): JsonResponse
    {
        /** @var CategoryDao $categoryDao */
        $categoryDao = CategoryDao::find($id);

        if (!$categoryDao) {
            return self::buildNotFoundResponse();
        }

        $categoryDao->delete();

        return self::buildEmptyResponse();
    }
}
