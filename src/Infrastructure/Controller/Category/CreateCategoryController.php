<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Category;

use Airzone\Domain\Category\Category;
use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        $parentCategoryId = null !== $request->get('parent_id')
            ? CategoryId::fromInt($request->get('parent_id'))
            : null;

        if (null !== $parentCategoryId
            && null === $categoryRepository->findById($parentCategoryId)
        ) {
            return self::buildConflictResponse();
        }

        $name = Name::fromString($request->get('name'));
        $slug = Slug::fromString($request->get('slug'));

        $categoryExists = $categoryRepository->findByNameAndSlug($name, $slug);

        if (null !== $categoryExists) {
            return self::buildConflictResponse();
        }

        $category = Category::fromValues([
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'visible' => $request->get('visible'),
        ]);

        $categoryRepository->create($category);

        $createdCategory = $categoryRepository->findByNameAndSlug($name, $slug);

        return self::buildResponseFromArray(['id' => $createdCategory->id()->value()]);
    }
}
