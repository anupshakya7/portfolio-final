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
            'type' => 'required|in:url,wifi',
            'url' => 'required_if:type,url|url',
            'ssid' => 'required_if:type,wifi',
            'password' => 'nullable',
            'security' => 'required_if:type,wifi|in:WPA,WEP,nopass',
            'color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'logo' => 'nullable|max:1024'
        ]);

        //QR Data
        if($request->type === 'wifi'){
            $qrData = sprintf(
                'WIFI:T:%s;S:%s;P:%s;H:false;;',
                $request->security,
                addslashes($request->ssid),
                addslashes($request->password)
            );
        }else{
            $qrData = $request->url;
        }

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

        $logoWithBg = $this->logoWithWhiteBg($logoPath);

        $qr = QrCode::format('png')
            ->size(500)
            ->margin(2)
            ->errorCorrection('H')
            ->color($color[0],$color[1],$color[2])
            ->mergeString(file_get_contents($logoWithBg),0.18,false)
            ->generate($qrData);

        if(file_exists($logoWithBg)){
            unlink($logoWithBg);
        }

        return response()->json([
            'qr' => 'data:image/png;base64,'.base64_encode($qr)
        ]);
    }

    private function logoWithWhiteBg($logoPath){
        $logo = imagecreatefromstring(file_get_contents($logoPath));

        $logoW = imagesx($logo);
        $logoH = imagesy($logo);

        $padding = 50;

        $bgW = $logoW + $padding;
        $bgH = $logoH + $padding;

        $canvas = imagecreatetruecolor($bgW,$bgH);

        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $bgW, $bgH, $white);

        imagecopyresampled(
            $canvas,
            $logo,
            $padding /2,
            $padding /2,
            0,
            0,
            $logoW,
            $logoH,
            $logoW,
            $logoH
        );

        $dir = public_path('assets/tmp');

        if(!file_exists($dir)){
            mkdir($dir, 0755, true);
        }

        $filename = 'logo_white_bg_'.uniqid().'.png';
        $path = $dir.'/'.$filename;

        imagepng($canvas,$path);

        imagedestroy($logo);
        imagedestroy($canvas);

        return $path;
    }
}
