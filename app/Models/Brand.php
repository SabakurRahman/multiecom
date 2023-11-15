<?php

namespace App\Models;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Manager\PhotoUploadManager;
use App\Manager\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;
    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public const BRAND_PHOTO_UPLOAD_PATH = 'uploads/brand/';
    public const BRAND_PHOTO_UPLOAD_PATH_THUMB = 'uploads/brand/thumb/';

    public const BRAND_PHOTO_WIDTH = 600;
    public const BRAND_PHOTO_HEIGHT = 600;
    public const BRAND_PHOTO_WIDTH_THUMB = 150;
    public const BRAND_PHOTO_HEIGHT_THUMB = 150;

    public function storeBrand(StoreBrandRequest $request)
    {
        return self::query()->create($this->prepareBrandData($request));
    }

    private function prepareBrandData(StoreBrandRequest $request)
    {
        $data = [
            'brand_name' => $request->input('brand_name'),
            'brand_slug'       => Utility::prepare_slug($request->input('brand_name')),
            'status' => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        if ($request->hasFile('photo')) {
            $photo = (new PhotoUploadManager)->file($request->file('photo'))
                ->name(Utility::prepare_name($request->input('brand_name')))
                ->path(self::BRAND_PHOTO_UPLOAD_PATH)
                ->height(self::BRAND_PHOTO_HEIGHT)
                ->width(self::BRAND_PHOTO_WIDTH)
                ->upload();
            $data['brand_image'] = $photo;

        }

        return $data;

    }

    public function updateBrand(UpdateBrandRequest $request, Brand $brand)
    {
        $data=[
            'brand_name' => $request->input('brand_name')??$brand->brand_name,
            'status' => $request->input('status') ?? $brand->status,
        ];
        if ($request->hasFile('photo')) {
            (new PhotoUploadManager())->deletePhoto(self::BRAND_PHOTO_UPLOAD_PATH,$brand->brand_image);
            $photo = ( new PhotoUploadManager)->file($request->file('photo'))
                ->name(Utility::prepare_name($request->input('brand_name')))
                ->path(self::BRAND_PHOTO_UPLOAD_PATH)
                ->height(self::BRAND_PHOTO_HEIGHT)
                ->width(self::BRAND_PHOTO_WIDTH)
                ->upload();
            $data['brand_image'] = $photo;

        }

        return $brand->update($data);
    }


}
