<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ToolController extends Controller
{
    public function gpaCalculator(){
        return view('tools.gpa-calculator');
    }

    public function qrCode(){
        return view('tools.qr-generator');
    }

    public function qrCodeSubmit(Request $request){
        $request->validate([
            'url' => 'required|url',
            'color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:1024'
        ]);

        //Logo
        $logoPath = public_path('assets/images/logo.png');

        if($request->hasFile('logo')){
            $logoPath = $request->file('logo')->getRealPath();
        }

        if(!file_exists($logoPath)){
            abort(404,'Logo file not found');
        }
        //Logo

        //Color
        $color = $request->color ? sscanf($request->color,'#%02x%02x%02x') : [0,0,0];
        //Color

        $qr = QrCode::format('png')
            ->size(500)
            ->margin(2)
            ->errorCorrection('H')
            ->color($color[0],$color[1],$color[2])
            ->merge($logoPath,0.18,true)
            ->generate($request->url);

        return response()->json([
            'qr' => 'data:image/png;base64,'.base64_encode($qr)
        ]);
    }
}
