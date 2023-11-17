<?php

namespace App\Models;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Manager\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;
    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive'
    ];

    public function storeSubCategory(StoreSubCategoryRequest $request)
    {
        return self::query()->create($this->prepareStoreSubCategory($request));
    }
    private function prepareStoreSubCategory(StoreSubCategoryRequest $request)
    {
        return[
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Utility::prepare_slug($request->name),
            'status'      => $request->status ?? self::STATUS_ACTIVE,
        ];

    }
    public function updateSubCategory(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $data = [
          'category_id' => $request->category_id ?? $subCategory->category_id,
            'name'        => $request->name ?? $subCategory->name,
            'slug'        => Utility::prepare_slug($request->name) ?? $subCategory->slug,
            'status'      => $request->status ?? $subCategory->status,
        ];
       return  $subCategory->update($data);
    }




    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
