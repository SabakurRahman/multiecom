<?php

namespace App\Http\Controllers;

use App\Manager\PhotoUploadManager;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{

    public function __construct()
    {
      $this->brand = new Brand();
    }

    public function index()
    {
        //
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));

    }


    public function create()
    {
        //
        return view('admin.brand.create');
    }


    public function store(StoreBrandRequest $request)
    {
        //
        $this->brand->storeBrand($request);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }


    public function edit(Brand $brand)
    {
        //

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {

        //
        $this->brand->updateBrand($request, $brand);
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
    }


    public function destroy(Brand $brand)
    {

        //
        (new PhotoUploadManager())->deletePhoto(Brand::BRAND_PHOTO_UPLOAD_PATH,$brand->brand_image);
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully.');
    }
}
