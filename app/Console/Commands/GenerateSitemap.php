<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {

// fetch static pages
$pages = [
    "https://alginosnt.lt/",
    "https://alginosnt.lt/paslaugos/",
    "https://alginosnt.lt/partneriai/",
    "https://alginosnt.lt/kontaktai",
    "https://alginosnt.lt/privatumo-politika",
    "https://alginosnt.lt/ru",
    "https://alginosnt.lt/услуги",
    "https://alginosnt.lt/партнеры",
    "https://alginosnt.lt/контакты",
    "https://alginosnt.lt/политика-конфиденциальности",
];

// fetch dynamic listings
$listings = DB::select("SELECT id FROM cms_module_ntmodulis WHERE state = 'active'");

$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// static pages
foreach ($pages as $p) {
    $xml .= "  <url>\n";
    $xml .= "    <loc>$p</loc>\n";
    $xml .= "    <lastmod>" . date("Y-m-d") . "</lastmod>\n";
    $xml .= "    <changefreq>weekly</changefreq>\n";
    $xml .= "    <priority>1.0</priority>\n";
    $xml .= "  </url>\n";
}
// dynamic listings
foreach ($listings as $row) {
    $url = "https://alginosnt.lt/nekilnojamas-turtas/skelbimas/" . $row->id;
    $lastmod = date("Y-m-d");
    $xml .= "  <url>\n";
    $xml .= "    <loc>$url</loc>\n";
    $xml .= "    <lastmod>$lastmod</lastmod>\n";
    $xml .= "    <changefreq>daily</changefreq>\n";
    $xml .= "    <priority>0.8</priority>\n";
    $xml .= "  </url>\n";
}
foreach ($listings as $row) {
    $url = "https://alginosnt.lt/недвижимость/объявление/" . $row->id;
    $lastmod = date("Y-m-d");
    $xml .= "  <url>\n";
    $xml .= "    <loc>$url</loc>\n";
    $xml .= "    <lastmod>$lastmod</lastmod>\n";
    $xml .= "    <changefreq>daily</changefreq>\n";
    $xml .= "    <priority>0.8</priority>\n";
    $xml .= "  </url>\n";
}

$xml .= "</urlset>";

// echo '<pre>'; print_r($xml); exit;
file_put_contents(public_path('sitemap.xml'), $xml);


    }
}
