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

        $qr = QrCode::size(500)
            ->margin(2)
            ->generate($request->url);

        return $qr;
    }
}
