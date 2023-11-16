<?php

namespace App\Http\Controllers;

use App\Manager\PhotoUploadManager;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
        //
        $categories = Category::query()->paginate(5);
        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        //
        return view('admin.category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        //
        $this->category->storeCategory($request);
        return redirect()->route('category.index')->with('success','Category created successfully');


    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
        return view('admin.category.edit',compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //

        $this->category->updateCategory($request,$category);
        return redirect()->route('category.index')->with('success','Category updated successfully');
    }


    public function destroy(Category $category)
    {

        if ($category->image){
            (new PhotoUploadManager)->deletePhoto(Category::CATEGORY_IMAGE_PATH,$category->image);
        }
        $category->delete();
        return redirect()->route('category.index')->with('success','Category created successfully');
    }
}
