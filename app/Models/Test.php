<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getAllTest()
    {
        return $this->orderBy('id', 'desc')->paginate(10);
    }

}
