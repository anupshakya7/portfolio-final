<?php

namespace App\Http\Controllers\Voyager;

use App\ExperienceCategory;
use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Rules\NonEmptyArrayValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Models\Setting;

class PortfolioController extends Controller
{
    public function index(){  
        $educations = Education::all();
        $experienceCategories = ExperienceCategory::where('status','Active')->get();
        $experiences = Experience::with('category')->get();

        return view('vendor.Voyager.portfolio.main',compact('educations','experienceCategories','experiences'));
    }

    public function aboutStore(Request $request){
        $validatedData = $request->validate([
            'description'=>'required|string',
            'about_pic'=>'nullable|mimes:jpeg,png,jpg|max:2048',
            'degree'=>'required|array|min:1',
            'degree.*'=>[new NonEmptyArrayValue],
            'gpa'=>'required|array|min:1',
            'gpa.*'=>[new NonEmptyArrayValue]
        ]);

        try{
            if($request->hasFile('about_pic')){
                $checkAboutPic = DB::table('settings')->where('key','site.about_pic')->whereNot('value','')->first();
    
                if($checkAboutPic && Storage::exists('public/'.$checkAboutPic->value)){     
                    Storage::delete('public/'.$checkAboutPic->value);
                }
     
                $image = $request->file('about_pic');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/users/about_me/'.$imageName);
     
                //Add About Pic
                Setting::where('key','site.about_pic')->first()->update([
                     'value'=>'users/about_me/'.$imageName
                ]);
             }
     
            // //Add About Description
            Setting::where('key','site.about_description')->first()->update([
                 'value'=>$validatedData['description']
            ]);

            //Education
            Education::where('user_id',auth()->user()->id)->delete();

            foreach($validatedData['degree'] as $key => $degree){
                Education::create([
                    'degree'=>$degree,
                    'gpa'=>$validatedData['gpa'][$key],
                    'user_id'=>auth()->user()->id
                ]);
            }

            return redirect()->back()->with('success','Successfully Update About Data Portfolio Datails!!!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function experienceStore(Request $request){
        $validatedData = $request->validate([
            'skills'=>'required|array|min:1',
            'skills.*'=>[new NonEmptyArrayValue],
            'category'=>'required|array|min:1',
            'category.*'=>[new NonEmptyArrayValue],
            'level'=>'required|array|min:1',
            'level.*'=>[new NonEmptyArrayValue],
        ]);

        try{
            Experience::where('user_id',auth()->user()->id)->delete();

            foreach($validatedData['skills'] as $key => $skills){
                Experience::create([
                    'skills'=>$skills, 
                    'category_id'=>$validatedData['category'][$key], 
                    'level'=>$validatedData['level'][$key], 
                    'user_id'=>auth()->user()->id, 
                ]);
            }
            return redirect()->back()->with('success','Successfully Update Experience Data!!!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
