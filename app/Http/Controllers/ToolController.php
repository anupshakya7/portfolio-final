<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function tool($slug){
        $single = Page::where('slug',$slug)->where('status','published')->first();
        
        return view('tools.single',compact('single'));
    }
}
