<?php

namespace App\Http\Controllers;

use App\Models\Sitemap;
use App\Page;
use App\Services\QRCode\QRService;
use App\Services\SeoService\SitemapService;
use App\Toolset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ToolController extends Controller
{
    protected $qrService;
    protected $sitemapService;

    public function __construct(QRService $qrService, SitemapService $sitemapService){
        $this->qrService = $qrService;
        $this->sitemapService = $sitemapService;
    }

    public function index(){
        $tools = Toolset::where('status','PUBLISHED')->get();

        return view('tools.index',compact('tools'));
    }

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
        ],[
            'url.required_if' => 'The URL field is required.',
            'ssid.required_if' => 'Wifi name (SSID) is required'
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

        $logoWithBg = $this->qrService->createLogoWithWhiteBg($logoPath);

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

    //Sitemap 
    public function sitemap(){
        return view('tools.sitemap');
    }

    public function sitemapSubmit(Request $request){
        $request->validate([
            'website_url' => 'required|url'
        ]);

        $baseUrl = rtrim($request->website_url,'/');

        if(!$this->sitemapService->isValidPublicUrl($baseUrl)){
            return back()->with('error', 'Invalid or private URL.');
        }

        $urls = $this->sitemapService->crawl($baseUrl);

        $urls = collect($urls)->map(function($url) use($baseUrl){
            $url = preg_replace('/#.*$/','',$url);

            if($url !== $baseUrl){
                $url = rtrim($url, '/');
            }

            return $url;
        })
        ->unique()
        ->values()
        ->all();
        
        $sitemap = Sitemap::create([
            'website_url' => $baseUrl,
            'urls' => json_encode($urls)
        ]);

        $xml = $this->sitemapService->generateXml($urls);

        $fileName = 'sitemap_'.$sitemap->id.'.xml';
        Storage::disk('public')->put('sitemap/'.$fileName, $xml);
        
        return response()->json([
            'file' => asset('public/storage/sitemap/'. $fileName)
        ]);
    }
}
