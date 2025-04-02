<?php

namespace App;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;


class ExperienceCategory extends Model
{
    public function skills(){
        return $this->hasMany(Experience::class,'category_id');
    }
}
