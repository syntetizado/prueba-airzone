<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Domain\Category\CategoryId;
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

        $categoryId = CategoryId::fromInt($id);
        $category = $categoryRepository->findById($categoryId);

        if (null === $category) {
            return self::buildNotFoundResponse();
        }

        $parentCategoryId = null !== $request->get('parent_id')
            ? CategoryId::fromInt($request->get('parent_id'))
            : null;

        if (null !== $parentCategoryId
            && null === $categoryRepository->findById($parentCategoryId)
        ) {
            return self::buildConflictResponse();
        }

        $valuesToUpdate = [
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'visible' => $request->get('visible'),
        ];

        $category = $category->withUpdatedValues($valuesToUpdate);

        $categoryRepository->save($category);

        return self::buildEmptyResponse();
    }
}
