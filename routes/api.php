<?php

use Airzone\Infrastructure\Controller\Category\CreateCategoryController;
use Airzone\Infrastructure\Controller\Category\DeleteCategoryController;
use Airzone\Infrastructure\Controller\Category\ReadCategoryController;
use Airzone\Infrastructure\Controller\Category\UpdateCategoryController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('', fn () => new JsonResponse(["Welcome to my API !"]));

Route::group(['prefix' => 'categories'], function () {
    Route::post('', [CreateCategoryController::class, 'execute']);
    Route::get('{id}', [ReadCategoryController::class, 'execute']);
    Route::put('{id}', [UpdateCategoryController::class, 'execute']);
    Route::delete('{id}', [DeleteCategoryController::class, 'execute']);
});

Route::fallback(fn () => new JsonResponse(["Route not found"], Response::HTTP_NOT_FOUND));
