<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $fillable = ['title', 'content', 'image', 'published_at', 'category_id', 'name'];
}
