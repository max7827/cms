<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class category extends Model
{
    use SoftDeletes;

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
