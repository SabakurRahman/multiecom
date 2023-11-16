<?php

namespace App\Models;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Manager\PhotoUploadManager;
use App\Manager\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public const STATUS_ACTIVE=1;
    public const STATUS_INACTIVE=0;
    public const STATUS_LIST=[
        self::STATUS_ACTIVE=>'Active',
        self::STATUS_INACTIVE=>'Inactive'
    ];

    public const CATEGORY_IMAGE_PATH='uploads/category/';
    public const CATEGORY_IMAGE_THUMB_PATH='uploads/category/thumb/';
    public const CATEGORY_IMAGE_WIDTH=300;
    public const CATEGORY_IMAGE_HEIGHT=300;
    public const CATEGORY_IMAGE_THUMB_WIDTH=100;
    public const CATEGORY_IMAGE_THUMB_HEIGHT=100;

    public function storeCategory(StoreCategoryRequest $request)
    {
        return self::query()->create($this->prepareStoreCategory($request));
    }

    private function prepareStoreCategory(StoreCategoryRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'slug'=>Utility::prepare_slug($request->name),
            'status'=>$request->status ?? self::STATUS_ACTIVE,

        ];
        if ($request->hasFile('photo')) {
            $photo = (new PhotoUploadManager)->file($request->file('photo'))
                ->name(Utility::prepare_name($request->input('name')))
                ->path(self::CATEGORY_IMAGE_PATH)
                ->height(self::CATEGORY_IMAGE_HEIGHT)
                ->width(self::CATEGORY_IMAGE_WIDTH)
                ->upload();
            $data['image'] = $photo;

        }
        return $data;

    }

    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $data = [
            'name' => $request->name ?? $category->name,
            'slug' => Utility::prepare_slug($request->name) ?? $category->slug,
            'status' => $request->status ?? $category->status,

        ];
        if ($request->hasFile('photo')) {

            if ($category->image) {
                (new PhotoUploadManager)->deletePhoto(self::CATEGORY_IMAGE_PATH,$category->image);
            }

            $photo = (new PhotoUploadManager)->file($request->file('photo'))
                ->name(Utility::prepare_name($request->input('name')))
                ->path(self::CATEGORY_IMAGE_PATH)
                ->height(self::CATEGORY_IMAGE_HEIGHT)
                ->width(self::CATEGORY_IMAGE_WIDTH)
                ->upload();
            $data['image'] = $photo;

        }
        $category->update($data);
    }



}
