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

 if($request->has('submit_search')){


        $this->where['condition'] = ['1'];
        $this->where['param'] = [];
// dD($request->all());

            if($request->filled('floor_from')){
                $this->where['condition'] = ['(floor >= ? OR floorNr >= ?)'];
                $this->where['param'] = [$request->input('floor_from'), $request->input('floor_from')];
            }
            if($request->filled('area_from')){
                $this->where['condition'] = ['size >= ?'];
                $this->where['param'] = $request->input('area_to');
            }
            if($request->filled('area_to')){
                $this->where['condition'] = ['size <= ?'];
                $this->where['param'] = $request->input('area_to');
            }
            if($request->filled('itemType')){
                $this->where['condition'] = ['itemType = ?'];
                $this->where['param'] = $request->input('itemType');
            }
            if($request->filled('floor_to')){
                $this->where['condition'] = ['(floor <= ? OR floorNr <= ?)'];
                $this->where['param'] =  [$request->input('floor_to'), $request->input('floor_to')]; 
            }
            if($request->filled('price_from')){
                $this->where['condition'] = ['(price >= ?)'];
                $this->where['param'] =  $request->input('price_from'); 
            }
            if($request->filled('price_to')){
                $this->where['condition'] = ['(price <= ?)'];
                $this->where['param'] =  $request->input('price_to'); 
            }
            if($request->filled('roomAmount_from')){
                $this->where['condition'] = ['(roomAmount >= ?)'];
                $this->where['param'] =  $request->input('roomAmount_from'); 
            }
            if($request->filled('years_from')){
                $this->where['condition'] = ['(years >= ?)'];
                $this->where['param'] =  $request->input('years_from'); 
            }
            if($request->filled('roomAmount_to')){
                $this->where['condition'] = ['(roomAmount <= ?)'];
                $this->where['param'] =  $request->input('roomAmount_to'); 
            }
            if($request->filled('years_to')){
                $this->where['condition'] = ['(years <= ?)'];
                $this->where['param'] =  $request->input('years_to'); 
            }
            if($request->filled('roomAmount_to')){
                $this->where['condition'] = ['(roomAmount <= ?)'];
                $this->where['param'] =  $request->input('roomAmount_to'); 
            }
            if($request->filled('with_photos')){

                $this->where['condition'] = ['(photos != "")'];
                
            }
            if($request->filled('heating')){

                // $temp_data = explode(';', $request->input('heating'));
                // foreach($temp_data)

                // $this->where[] = ['photos', '!=', ''];
            }

    }else{




        if(isset($request->itemtype)){ 
            $request->session()->put('itemType', $request->itemtype);
            $request->session()->forget('sellAction');
            $this->itemtype = $request->itemtype;
            $itemtype = $request->itemtype;
            $sellaction = 1;
            $this->sellaction = 1;
            $this->where['condition'] = ['itemType = ?'];
            $this->where['param'] = $request->itemtype;
        }elseif(isset($request->sellaction)){
            $request->session()->put('sellAction', $request->sellaction);
            $request->session()->forget('itemType');
            $this->sellaction = $request->sellaction;
            $sellaction = $request->sellaction;
            $this->itemtype = '';
            $itemtype = '';

            $this->where['condition'] = ['sellAction = ?'];
            $this->where['param'] = $request->sellaction;
        }
        else{ 
            if(!empty($request->session()->get('itemType'))){
                $type = $request->session()->get('itemType');
                $this->itemtype = $type;
                $itemtype = $type;
                $this->where['condition'] = ['itemType = ?'];
                $this->where['param'] =  $type;
            }elseif(!empty($request->session()->get('sellAction'))){
                $sellaction = $request->session()->get('sellAction');
                $this->sellaction = $sellaction;
                $this->where['condition'] = ['sellAction = ?'];
                $this->where['param'] = $sellaction;
            }
            else {
                $this->itemtype = 'butas';
                $itemtype = 'butas';

                $this->where['condition'] = ['itemType = ?'];
                $this->where['param'] = 'butas';
            }
        }
    }

    $min_years = DB::table('cms_module_ntmodulis')->whereRaw('LENGTH(years) = ?', [4])->min('years');

            // dd($min_years);
        view()->share(compact('submenu', 'itemtype', 'sellaction', 'heating', 'additional_equipment', 'min_years'));
    }
}
