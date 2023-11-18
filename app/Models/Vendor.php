<?php

namespace App\Models;

use App\Manager\PhotoUploadManager;
use App\Manager\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];
   public const SHOP_PHOTO_UPLOAD_PATH = 'upload/vendor/';
    public const SHOP_PHOTO_UPLOAD_PATH_THUMB = 'upload/vendor/thumb/';

    public const SHOP_PHOTO_WIDTH = 600;
    public const SHOP_PHOTO_HEIGHT = 600;
    public const SHOP_PHOTO_WIDTH_THUMB = 150;
    public const SHOP_PHOTO_HEIGHT_THUMB = 150;



    public function createVendor(Request $request, $user)
    {
        return self::query()->create($this->getVendorData($request, $user));
    }

    private function getVendorData(Request $request, $user)
    {

        $data = [
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'join_date' => $request->join_date,
            'address' => $request->address,
            'description' => $request->description,
        ];
        if ($request->hasFile('shop_logo')) {
            $photo = (new PhotoUploadManager)->file($request->file('shop_logo'))
                ->name(Utility::prepare_name($request->input('shop_name')))
                ->path(self::SHOP_PHOTO_UPLOAD_PATH)
                ->height(self::SHOP_PHOTO_HEIGHT)
                ->width(self::SHOP_PHOTO_WIDTH)
                ->upload();
            $data['shop_logo'] = $photo;
        }
        return $data;

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
