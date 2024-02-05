<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Application\Command\Category\Create\CreateCategoryCommand;
use Airzone\Domain\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class CreateCategoryController extends ApiController
{
    public function execute(Request $request, CategoryRepository $categoryRepository): JsonResponse
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
            new CreateCategoryCommand(
                parentId: $request->get('parent_id'),
                name: $request->get('name'),
                slug: $request->get('slug'),
                visible: $request->get('visible')
            )
        );

        return self::buildResponseFromArray(['id' => Cache::get('CREATED_CATEGORY_ID')]);
    }
}
