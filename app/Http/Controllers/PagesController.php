<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class PagesController extends BaseController
{

  


    public function wantToSell(Request $request){
        
      

            // $this->where['condition'][] = 'itemType = ?';
            // $this->where['param'][] = 'butas';
            // $request->session()->forget('itemType');
            // $request->session()->forget('sellAction');
            // $request->session()->forget('condition');
            // $request->session()->forget('param');


    

       


 
        $active_main_menu_link = 'want_to_sell';
 

             return view('frontend.want_to_sell',
                compact('active_main_menu_link')
            );

    }





}
