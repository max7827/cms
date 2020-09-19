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
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tag->pluck('id')->toArray());
    }
}
