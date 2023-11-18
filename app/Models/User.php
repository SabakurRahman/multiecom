<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\StoreUserControllerRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];
    public function updateAdminProfile(Request $request,$user)
    {
        $data= [
               'name'                => $request->input('name'),
               'email'               => $request->input('email'),
               'phone'               => $request->input('phone'),
               'address'             => $request->input('address'),
        ];

        if($request->file('photo'))
        {
            $photoUpLoadPath = '/upload/admin_images/';
            $file            = $request->file('photo');
            @unlink(public_path($photoUpLoadPath.$user->photo));
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path($photoUpLoadPath),$fileName);
            $data['photo'] = $fileName;

        }

        return $user->update($data);
    }

    public function getUserWithAll()
    {
        return self::query()->orderByDesc('id')->paginate(10);
    }
    public function storeUser(StoreUserControllerRequest $request)
    {
        return self::query()->create($this->prepareUserData($request));
    }


    private function prepareUserData($request)
    {
        return[
            'name'     =>$request->name,
            'username' =>$request->username,
            'email'    =>$request->email,
            'phone'    =>$request->phone,
            'address'  =>$request->address,
            'role'     =>$request->role,
            'status'   =>$request->status ?? self::STATUS_ACTIVE,
            'password' =>Hash::make($request->password)
        ];
    }

    public function updateUserProfile(Request $request, $user)
    {
        $data= [
            'username'            => $request->input('username')??$user->username, //??'
            'name'                => $request->input('name')??$user->name,
            'email'               => $request->input('email')??$user->email,
            'phone'               => $request->input('phone')??$user->phone,
            'address'             => $request->input('address')??$user->address,
        ];

        if($request->file('photo'))
        {
            $photoUpLoadPath = '/upload/user_images/';
            $file            = $request->file('photo');
            @unlink(public_path($photoUpLoadPath.$user->photo));
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path($photoUpLoadPath),$fileName);
            $data['photo'] = $fileName;

        }

        return $user->update($data);
    }


}
