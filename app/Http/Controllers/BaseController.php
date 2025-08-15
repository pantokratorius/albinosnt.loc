<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{

    public $itemtype;
    public $sellaction;
    public $where = [];
    public $submenu = [];
    public $main_menu = [];
    public $heating = [];
    public $additional_equipment = [];
    public $buildType = [];
    public $sellType = [];
    public $community = [];
    public $savivaldybe = [];
    public $purpose = [];
    public $purpose2 = [];
    public $min_years;
    public $active_main_menu_link;

     public function __construct(Request $request)
    {


        $this->heating = [
            'Centrinis',
            'Elektra',
            'Skystu kuru',
            'Centrinis kolektorinis',
            'Geoterminis',
            'Oroterminis',
            'Dujinis',
            'Kietu kuru',
            'Kita',
        ];



        $this->additional_equipment = [
            'Kondicionierius',
            'Skalbimo mašina',
            'Su baldais',
            'Šaldytuvas',
            'Šildomos grindys',
            'Virtuvės komplektas',
            'Viryklė',
            'Židinys',
            'Wavin vamzdžiai',
            'Indaplovė',
            'Dušo kabina',
            'Vonia',
        ];


            $this->main_menu = [
               'homepage' => 'nekilnojamas turtas',
                'services' => 'paslaugos',
                'partners' => 'partneriai',
                'contacts' => 'kontaktai',
            ];



            $this->submenu =     [
                'butas' => 'Butai',
                'namas' => 'Namai Kotedžai',
                'sodyba' => 'Sodybos',
                'sklypas' => 'Sklypai',
                'sodas' => 'Sodai',
                'patalpa' => 'Patalpos',
                // 'garazas' => 'Garažai',
            ];



  $this->buildType = [
            'Mūrinis',
            'Blokinis',
            'Monolitinis',
            'Medinis',
            'Karkasinis',
            'Rąstinis',
            'Kita',
        ];

        $this->sellType = [
            'Namas',
            'Namo dalis',
            'Kotedžas',
        ];



                 $this->purpose = [
                'Namų valda',
                'Daugiabučių statyba',
                'Žemės ūkio',
                'Sklypas soduose',
                'Miškų ūkio',
                'Pramonės',
                'Sandėliavimo',
                'Komercinė',
                'Rekreacinė',
                'Kita',
            ];

               $this->purpose2 = [
                'Administracinė',
                'Prekybos',
                'Viešbučių',
                'Paslaugų',
                'Sandėliavimo',
                'Gamybos ir pramonės',
                'Maitinimo',
                'Kita',
            ];


            $this->community = DB::table('bendrijos')->pluck('bendrijos_name');

             $this->savivaldybe = DB::table('vietove')->get();

    $this->min_years = DB::table('cms_module_ntmodulis')->whereRaw('LENGTH(years) = ?', [4])->min('years');

        }

     protected function init(){
         view()->share(
            [
                'submenu' => $this->submenu,
                'itemtype' => $this->itemtype,
                'sellaction' => $this->sellaction,
                'heating' => $this->heating,
                'additional_equipment' => $this->additional_equipment,
                'min_years' => $this->min_years,
                'main_menu' => $this->main_menu,
                'buildType' => $this->buildType,
                'sellType' => $this->sellType,
                'community' => $this->community,
                'savivaldybe' => $this->savivaldybe,
                'purpose' => $this->purpose,
                'purpose2' => $this->purpose2,
                'active_main_menu_link' => $this->active_main_menu_link,
            ]);
         }

}
