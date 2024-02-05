<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Application\Command\Category\Delete\DeleteCategoryCommand;
use Airzone\Domain\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class DeleteCategoryController extends ApiController
{
    public function execute(int $id, CategoryRepository $categoryRepository): JsonResponse
    {
        self::handleCommand(new DeleteCategoryCommand($id));

        return self::buildEmptyResponse();
    }
}
