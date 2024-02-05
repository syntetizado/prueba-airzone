<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Application\Query\Category\Read\ReadCategoryQuery;
use Airzone\Domain\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadCategoryController extends ApiController
{
    public function execute(int $id, CategoryRepository $categoryRepository): JsonResponse
    {
        $response = self::handleQuery(new ReadCategoryQuery($id));

        return self::buildResponseFromArray($response->toArray());
    }
}
