<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\services\CategoryDeleteService;
use Validator;

class CategoryController extends Controller
{
    public $categoryDeleteService;

    /**
     * CategoryController constructor.
     * @param CategoryDeleteService $categoryDeleteService
     */
    public function __construct(CategoryDeleteService $categoryDeleteService)
    {
        $this->categoryDeleteService = $categoryDeleteService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CategoryStoreRequest $request
     * @return CategoryResource
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return CategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CategoryUpdateRequest $request
     * @param \App\Models\Category $category
     * @return CategoryResource
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        return CategoryResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        return $this->categoryDeleteService->passStatus($this->categoryDeleteService->deleteCategory($category));
    }
}
