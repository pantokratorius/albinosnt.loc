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
            $this->itemtype = $request->itemtype;
            $itemtype = $request->itemtype;
            $sellaction = 1;
            $this->sellaction = 1;
            $this->where = ['itemType', $request->itemtype];
        }elseif(isset($request->sellaction)){
            $request->session()->put('sellAction', $request->sellaction);
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
            }else {
                $this->itemtype = 'butas';
                $itemtype = 'butas';
                $this->where = ['itemType', 'butas'];
            }
             $sellaction = 1;
             $this->sellaction = 1;
        }
  


            
        view()->share(compact('submenu', 'itemtype', 'sellaction'));
    }
}
