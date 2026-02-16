<?php
namespace App\Services\SeoService;

use Exception;
use Illuminate\Support\Facades\Http;

class SitemapService{
    private $maxPages;

    public function __construct($maxPages = 200){
        $this->maxPages = $maxPages;
    }

    public function crawl($baseUrl){
        $visited = [];
        $toVisit = [$baseUrl];

        while(!empty($toVisit) && count($visited) < $this->maxPages){
            $url = array_shift($toVisit);

            if(in_array($url, $visited)){
                continue;
            }

            try{
                $response = Http::timeout(10)->get($url);

                if($response->successful()){
                    $visited[] = $url;

                    $links = $this->extractLinks($response->body(), $baseUrl);

                    foreach($links as $link){
                        if(!in_array($link, $visited) && !in_array($link, $toVisit)){
                            $toVisit[] = $link;
                        }
                    }
                }
            }catch(Exception $e){
                continue;
            }
        }

        return $visited;
    }

    public function generateXml($urls){
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach($urls as $url){
            $path = parse_url($url, PHP_URL_PATH) ?? '/';

            $level = trim($path, '/');
            $levelCount = empty($level) ? 0 : substr_count($level, '/')+1;
            
            $priority = match(true){
                $levelCount === 0 => 1.0,
                $levelCount === 1 => 0.9,
                $levelCount === 2 => 0.7,
                default => 0.5
            };

            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars($url).'</loc>';
            $xml .= '<lastmod>'.now()->toAtomString().'</lastmod>';
            $xml .= '<priority>'.number_format($priority, 1).'</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $xml;
    }

    public function extractLinks($html, $baseUrl){
        $links = [];
        $dom = new \DOMDocument();

        @$dom->loadHTML($html);

        foreach($dom->getElementsByTagName('a') as $tag){
            $href = $tag->getAttribute('href');
            if(empty($href)) continue;

            if($href === '#' || str_starts_with($href, '#')){
                continue;
            }

            if(strpos($href, 'http') === 0){
                $url = rtrim($href, '/');
            }elseif(strpos($href, '/') === 0){
                $url = rtrim($baseUrl . $href, '/');
            }else{
                continue;
            }

            $url = preg_replace('/#.*$/','',$url);

            if(strpos($url, $baseUrl) === 0){
                $links[] = $url;
            }
        }

        return array_unique($links);
    }

    public function isValidPublicUrl($url){
        $host = parse_url($url, PHP_URL_HOST);
        if(!$host) return false;

        $ip = gethostbyname($host);

        return !filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
    }
}
?>