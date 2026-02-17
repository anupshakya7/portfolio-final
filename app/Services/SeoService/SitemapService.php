<?php

namespace App\Services\SeoService;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Http;

class SitemapService
{
    private $maxPages;

    public function __construct($maxPages = 500)
    {
        $this->maxPages = $maxPages;
    }

    public function crawl($baseUrl)
    {
        $visited = [];
        $toVisit = [$baseUrl];
        $client = new Client(['timeout' => 10]);

        while (!empty($toVisit) && count($visited) < $this->maxPages) {
            $batch = array_splice($toVisit, 0, 10);
            $promises = [];

            foreach ($batch as $url) {
                if (in_array($url, $visited)) continue;
                $promises[$url] = $client->getAsync($url);
            }

            $results = Promise\Utils::settle($promises)->wait();

            foreach ($results as $url => $result) {
                if ($result['state'] === 'fulfilled') {
                    $body = (string) $result['value']->getBody();
                    $visited[] = $url;

                    $links = $this->extractLinks($body, $baseUrl);
                    foreach ($links as $link) {
                        if (!in_array($link, $visited) && !in_array($link, $toVisit)) {
                            $toVisit[] = $link;
                        }
                    }
                }
            }


            //     $url = array_shift($toVisit);

            //     if(in_array($url, $visited)){
            //         continue;
            //     }

            //     try{
            //         $response = Http::timeout(10)->get($url);

            //         if($response->successful()){
            //             $visited[] = $url;

            //             $links = $this->extractLinks($response->body(), $baseUrl);

            //             foreach($links as $link){
            //                 if(!in_array($link, $visited) && !in_array($link, $toVisit)){
            //                     $toVisit[] = $link;
            //                 }
            //             }
            //         }
            //     }catch(Exception $e){
            //         continue;
            //     }
        }

        return $visited;
    }

    public function generateXml($urls)
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);

        $writer->startElement('urlset');
        $writer->writeAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');

        $now = now()->toAtomString();

        foreach ($urls as $url) {
            $path = parse_url($url, PHP_URL_PATH) ?? '/';

            $level = trim($path, '/');
            $levelCount = empty($level) ? 0 : substr_count($level, '/') + 1;


            if ($levelCount === 0) {
                $priority = 1.0;
            } elseif ($levelCount === 1) {
                $priority = 0.9;
            } elseif ($levelCount === 2) {
                $priority = 0.7;
            } else {
                $priority = 0.5;
            }

            // $priority = match (true) {
            //     $levelCount === 0 => 1.0,
            //     $levelCount === 1 => 0.9,
            //     $levelCount === 2 => 0.7,
            //     default => 0.5
            // };

            // $xml .= '<url>';
            // $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
            // $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            // $xml .= '<priority>' . number_format($priority, 1) . '</priority>';
            // $xml .= '</url>';
            $writer->startElement('url');

            $writer->writeElement('loc',$url);
            $writer->writeElement('lastmod', $now);
            $writer->writeElement('priority', $priority);

            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();

        // $xml .= '</urlset>';

        return $writer->outputMemory();
    }

    public function extractLinks($html, $baseUrl)
    {
        $links = [];

        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
        $html = preg_replace('#<!--(.*?)-->#s', '', $html);

        preg_match_all('/<a\s+[^>]*href=["\']?([^"\'>\s]+)["\']?/i', $html, $matches);
        $rawLinks = $matches[1] ?? [];

        foreach ($rawLinks as $href) {
            if (empty($href) || $href === '#' || str_starts_with($href, '#')) {
                continue;
            }

            if (strpos($href, 'http') === 0) {
                $url = rtrim($href, '/');
            } elseif (strpos($href, '/') === 0) {
                $url = rtrim($baseUrl . $href, '/');
            } else {
                continue;
            }

            $url = preg_replace('/#.*$/', '', $url);
            $url = strtok($url, '?');

            if (strpos($url, $baseUrl) === 0) {
                $links[] = $url;
            }
        }

        return array_unique($links);
    }

    public function isValidPublicUrl($url)
    {
        $host = parse_url($url, PHP_URL_HOST);
        if (!$host) return false;

        $ip = gethostbyname($host);

        return !filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
    }
}