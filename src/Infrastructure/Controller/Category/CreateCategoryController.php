<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CreateCategoryController extends ApiController
{
    public function execute(Request $request, CategoryDaoFactory $factory): JsonResponse
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

        $parentId = $request->get('parent_id');

        if (null !== $parentId && !CategoryDao::find($parentId)) {
            return self::buildConflictResponse();
        }

        $name = $request->get('name');
        $slug = $request->get('slug');

        $categoryExists = CategoryDao::where([
            'name' => $name,
            'slug' => $slug
        ])->first();

        if (null !== $categoryExists) {
            return self::buildConflictResponse();
        }

        $newCategory = $factory->create([
            'parent_id' => $parentId,
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'visible' => $request->get('visible'),
        ]);

        return self::buildResponseFromArray(['id' => $newCategory->id]);
    }
}
