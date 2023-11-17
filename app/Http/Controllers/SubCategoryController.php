<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{

public function __construct()
    {
        $this->subCategory = new SubCategory();
    }

    public function index()
    {
        //
        $subCategory = SubCategory::query()->with('category')->paginate(5);
        return view('admin.category.sub-category.index',compact('subCategory'));
    }


    public function create()
    {
        //
        $category = Category::query()->pluck('name','id');
        return view('admin.category.sub-category.create',compact('category'));
    }


    public function store(StoreSubCategoryRequest $request)
    {
        //
        $notification = [
            'message' => 'Sub Category Created Successfully',
            'alert-type' => 'success'
        ];
        $this->subCategory->storeSubCategory($request);
        return redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }


    public function edit(SubCategory $subCategory)
    {

        $category = Category::query()->pluck('name','id');
        return view('admin.category.sub-category.edit',compact('subCategory','category'));
    }


    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        //
        $notification = [
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success'
        ];
       $this->subCategory->updateSubCategory($request,$subCategory);
        return redirect()->back()->with($notification);
    }


    public function destroy(SubCategory $subCategory)
    {

        $notification = [
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        ];
        $subCategory->delete();
        return redirect()->back()->with($notification);
    }
}
