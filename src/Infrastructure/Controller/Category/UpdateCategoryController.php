<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Application\Command\Category\Update\UpdateCategoryCommand;
use Airzone\Domain\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UpdateCategoryController extends ApiController
{
    public function execute(int $id, Request $request, CategoryRepository $categoryRepository): JsonResponse
    {
        try {
            $request->validate([
                'parent_id' => 'nullable|integer',
                'name' => 'required|string',
                'slug' => 'required|string',
                'visible' => 'required|boolean',
            ]);
        } catch (Exception) {
            return self::buildBadRequestResponse();
        }

        self::handleCommand(
            new UpdateCategoryCommand(
                id: $id,
                parentId: $request->get('parent_id'),
                name: $request->get('name'),
                slug: $request->get('slug'),
                visible: $request->get('visible'),
            )
        );



        return self::buildEmptyResponse();
    }
}
