<?php
namespace App\Services\QRCode;

class QRService{
    public function createLogoWithWhiteBg($logoPath){
         $logo = imagecreatefromstring(file_get_contents($logoPath));

        if (!$logo) {
            throw new \Exception('Invalid logo image.');
        }

        $logoW = imagesx($logo);
        $logoH = imagesy($logo);

        $padding = 50;

        $bgW = $logoW + $padding;
        $bgH = $logoH + $padding;

        $canvas = imagecreatetruecolor($bgW, $bgH);

        // Enable transparency
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $bgW, $bgH, $white);

        imagecopyresampled(
            $canvas,
            $logo,
            $padding / 2,
            $padding / 2,
            0,
            0,
            $logoW,
            $logoH,
            $logoW,
            $logoH
        );

        $dir = public_path('assets/tmp');

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = 'logo_white_bg_' . uniqid() . '.png';
        $path = $dir . '/' . $filename;

        imagepng($canvas, $path);

        imagedestroy($logo);
        imagedestroy($canvas);

        return $path;
    }
}
?>