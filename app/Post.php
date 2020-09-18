<?php

namespace App;

use App\Category;
use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use SoftDeletes;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
