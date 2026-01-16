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

        $qr = QrCode::format('png')
            ->size(400)
            ->margin(2)
            ->errorCorrection('H')
            ->merge(public_path('assets/images/logo.png'), 0.25, true)
            ->generate($request->url);

        return response($qr, 200, [
            'Content-Type' => 'image/png'
        ]);
    }
}
