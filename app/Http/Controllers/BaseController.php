<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if(isset($request->itemtype)){ 
            $request->session()->put('itemType', $request->itemtype);
            $request->session()->forget('sellAction');
            $this->itemtype = $request->itemtype;
            $itemtype = $request->itemtype;
            $sellaction = 1;
            $this->sellaction = 1;
            $this->where = ['itemType', $request->itemtype];
        }elseif(isset($request->sellaction)){
            $request->session()->put('sellAction', $request->sellaction);
            $request->session()->forget('itemType');
            $this->sellaction = $request->sellaction;
            $sellaction = $request->sellaction;
            $this->itemtype = '';
            $itemtype = '';
            $this->where = ['sellAction', $request->sellaction];
        }
        else{ 
            if(!empty($request->session()->get('itemType'))){
                $type = $request->session()->get('itemType');
                $this->itemtype = $type;
                $itemtype = $type;
                $this->where = ['itemType', $type];
            }elseif(!empty($request->session()->get('sellAction'))){
                $sellaction = $request->session()->get('sellAction');
                $this->sellaction = $sellaction;
                $this->where = ['sellAction', $sellaction];
            }
            else {
                $this->itemtype = 'butas';
                $itemtype = 'butas';
                $this->where = ['itemType', 'butas'];
            }
        }
  
            
        view()->share(compact('submenu', 'itemtype', 'sellaction', 'heating', 'additional_equipment'));
    }
}
