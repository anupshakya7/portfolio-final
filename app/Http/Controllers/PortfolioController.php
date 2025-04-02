<?php

namespace App\Http\Controllers;

use App\ExperienceCategory;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $educations = Education::all();
        $experiences = ExperienceCategory::with('skills')->get();

        return view('home',compact('educations','experiences'));
    }
}
