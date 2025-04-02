<?php

namespace App\Models;

use App\ExperienceCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['skills','category_id','level','user_id'];

    public function category(){
        return $this->belongsTo(ExperienceCategory::class,'category_id');
    }
}
