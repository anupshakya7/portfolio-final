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
            'url' => 'required|url'
        ]);

        $logoPath = public_path('assets/images/logo.png');

        if(!file_exists($logoPath)){
            abort(404,'Logo file not found');
        }

        $qr = QrCode::format('png')
            ->size(500)
            ->errorCorrection('H')
            ->merge($logoPath,0.18,true)
            ->generate($request->url);

        return response()->json([
            'qr' => 'data:image/png;base64,'.base64_encode($qr)
        ]);
    }
}
