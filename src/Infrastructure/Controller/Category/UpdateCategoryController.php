<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UpdateCategoryController extends ApiController
{
    public function execute(int $id, Request $request): JsonResponse
    {
        /** @var CategoryDao $categoryDao */
        $categoryDao = CategoryDao::find($id);

        if (!$categoryDao) {
            return self::buildNotFoundResponse();
        }

        try {
            $request->validate([
                'parent_id' => 'nullable|integer',
                'name' => 'nullable|string',
                'slug' => 'nullable|string',
                'visible' => 'nullable|boolean',
            ]);
        } catch (Exception) {
            return self::buildBadRequestResponse();
        }

        $parentId = $request->get('parent_id');
        $name = $request->get('name');
        $slug = $request->get('slug');
        $visible = $request->get('visible');

        $parentId === null ?: $categoryDao->parent_id = $parentId;
        $name === null ?: $categoryDao->name = $name;
        $slug === null ?: $categoryDao->slug = $slug;
        $visible === null ?: $categoryDao->visible = $visible;

        $categoryDao->save();

        return self::buildEmptyResponse();
    }
}
