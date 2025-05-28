<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\Category\CategoriesResource;
use App\Http\Resources\Admin\Category\EditCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoriesResource::collection( Category::orderBy('name', 'asc')->paginate(20));

        return Inertia::render('Admin/Category/Index', ['categories' => $categories, 'title' => 'Категорії']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Category/Create', ['title' => 'Створити категорію']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return to_route('category.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Category/Edit', [
            'category' => new EditCategoryResource ($category),
            'title' => "Редагувати категорію '$category->name'"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->validated());
        return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('category.index');
    }

    public function search(Request $request)
    {
        $search = trim($request->search);

        $categories  = CategoriesResource::collection( Category::where("name", "like", "%$search%")->paginate(20));
        return Inertia::render('Admin/Category/Index', [
            'title' => "Пошук за '$search'" ,
            'categories' => $categories,
        ]);
    }
}
