<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Infrastructure\Model\CategoryDao;
use Airzone\Infrastructure\Model\Factory\CategoryDaoFactory;
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
                'id' => 'integer',
                'parent_id' => 'nullable|integer',
                'name' => 'string',
                'slug' => 'string',
                'visible' => 'boolean',
            ]);
        } catch (Exception) {
            return self::buildBadRequestResponse();
        }

        $id = $request->get('id');
        $parentId = $request->get('parent_id');

        if (CategoryDao::find($id)) {
            return self::buildConflictResponse();
        }

        if (null !== $parentId && !CategoryDao::find($parentId)) {
            return self::buildConflictResponse();
        }

        $factory->create([
            'id' => $id,
            'parent_id' => $parentId,
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'visible' => $request->get('visible'),
        ]);

        return self::buildEmptyResponse();
    }
}
