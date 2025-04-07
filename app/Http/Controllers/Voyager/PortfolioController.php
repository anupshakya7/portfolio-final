<?php

namespace App\Http\Controllers\Voyager;

use App\ExperienceCategory;
use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
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
        $projects = Project::where('status',1)->get();

        return view('vendor.Voyager.portfolio.main',compact('educations','experienceCategories','experiences','projects'));
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

    public function projectStore(Request $request){
        $validatedData = $request->validate([
            // 'project_id'=>'nullable|array',
            'title'=>'required|array|min:1',
            'title.*'=>[new NonEmptyArrayValue],
            'project_pic'=>'required|array|min:1',
            'project_pic.*'=>'required|mimes:jpeg,png,jpg|max:2048',
            'live'=>'required|array|min:1',
            'live.*'=>[new NonEmptyArrayValue],
            'github'=>'nullable|array'
        ]);
        

        try{
            $projectsDetails = [];
            foreach($validatedData['title'] as $key=>$title){
                
                if(isset($validatedData['project_pic'][$key])){
                    $file = $validatedData['project_pic'][$key];

                    if($file !== null && $file->isValid()){
                        $projectImgs = Project::select('project_pic')->where('user_id',auth()->user()->id)->get();
                            
                        if(count($projectImgs) > 0){
                            foreach($projectImgs as $projectImg){

                                if($projectImg->project_pic !== null && Storage::exists($projectImg->project_pic)){     
                                    Storage::delete($projectImg->project_pic);
                                }
                            }
                        }
                        
                        $imageName = time().'-'.($key+1).'.'.$file->getClientOriginalExtension();
                        $file->storeAs('projects/'.$imageName);
             
                        $imageDBPath = 'projects/'.$imageName;
                    }
                }else{
                    $imageDBPath = null;
                }

                Project::where('user_id',auth()->user()->id)->delete();
                $time = now()->format('Y-m-d H:i:s');

                $projectsDetails[] = [
                    'title'=>$title,
                    'project_pic'=>$imageDBPath,
                    'live'=>$validatedData['live'][$key],
                    'github'=>$validatedData['github'][$key],
                    'status'=>1,
                    'user_id'=>auth()->user()->id,
                    'created_at'=>$time,
                    'updated_at'=>$time,
                ]; 
            }

            Project::insert($projectsDetails);

            return redirect()->back()->with('success','Successfully Update Project Data!!!');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
