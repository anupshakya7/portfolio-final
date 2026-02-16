<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    public function blogCategory(){
        return $this->belongsTo(BlogCategory::class,'category');
    }
}
