<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{

    public $itemtype;
    public $sellaction;
    public $where = [];
    
     public function __construct(Request $request)
    {
        

        $heating = [
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

        

        $additional_equipment = [
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

        $itemtype = ''; $sellaction = '';
        
            $submenu =     [
                'butas' => 'Butai',
                'namas' => 'Namai Kotedžai',
                'sodyba' => 'Sodybos',
                'sklypas' => 'Sklypai',
                'sodas' => 'Sodai',
                'patalpa' => 'Patalpos',
                'garazas' => 'Garažai',
            ];



    
// dd($request->session()->get('itemType'));

        // if(isset($request->itemtype)){ 
        //     $request->session()->put('itemType', $request->itemtype);
        //     $request->session()->forget('sellAction');
        //     $this->itemtype = $request->itemtype;
        //     $itemtype = $request->itemtype;
        //     $sellaction = 1;
        //     $this->sellaction = 1;
        //     $this->where['condition'][] = 'itemType = ?';
        //     $this->where['param'][] = $request->itemtype;
        //     $request->session()->forget('condition');
        //     $request->session()->forget('param');
        // }elseif(isset($request->sellaction)){
        //     $request->session()->put('sellAction', $request->sellaction);
        //     $request->session()->forget('itemType');
        //     $this->sellaction = $request->sellaction;
        //     $sellaction = $request->sellaction;
        //     $this->itemtype = '';
        //     $itemtype = '';

        //     $this->where['condition'][] = 'sellAction = ?';
        //     $this->where['param'][] = $request->sellaction;
        //     $request->session()->forget('condition');
        //     $request->session()->forget('param');
        // }
        // else{ 
        //     if(!empty($request->session()->get('itemType'))){
        //         $type = $request->session()->get('itemType');
        //         $this->itemtype = $type;
        //         $itemtype = $type;
        //         $this->where['condition'][] = 'itemType = ?';
        //         $this->where['param'][] =  $type;
        //         $request->session()->forget('condition');
        //         $request->session()->forget('param');
        //     }elseif(!empty($request->session()->get('sellAction'))){
        //         $sellaction = $request->session()->get('sellAction');
        //         $this->sellaction = $sellaction;
        //         $this->where['condition'][] = 'sellAction = ?';
        //         $this->where['param'][] = $sellaction;
        //         $request->session()->forget('condition');
        //         $request->session()->forget('param');
        //     }elseif(!empty($request->session()->get('condition'))){
        //         $this->where['condition'] = $request->session()->get('condition');
        //         $this->where['param'] = $request->session()->get('param');
        //         $request->session()->forget('itemType');
        //         $request->session()->forget('sellAction');
        //     }
        //     else {
        //         $this->itemtype = 'butas';
        //         $itemtype = 'butas';

        //         $this->where['condition'][] = 'itemType = ?';
        //         $this->where['param'][] = 'butas';

        //         $request->session()->forget('condition');
        //         $request->session()->forget('param');
        //     }
        // }


        


    $min_years = DB::table('cms_module_ntmodulis')->whereRaw('LENGTH(years) = ?', [4])->min('years');

            // dd($this->where);
        view()->share(compact('submenu', 'itemtype', 'sellaction', 'heating', 'additional_equipment', 'min_years'));
    }
}
