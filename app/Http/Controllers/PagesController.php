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


    public function __construct(Request $request)
    {
        parent::__construct($request);
        
    }
  




    public function wantToSell(Request $request){
      
    $name = __FUNCTION__;
      $this->active_main_menu_link = $name;
        $this->init();
 
            
        return view('frontend.' . $name);

    }
    

    public function services(Request $request){
      
    $name = __FUNCTION__;
      $this->active_main_menu_link = $name;
        $this->init();
    
        $data = DB::table($name)->get();
        
        return view('frontend.' . $name, compact('data'));

    }


       
    public function partners(Request $request){
      
    $name = __FUNCTION__;
      $this->active_main_menu_link = $name;
        $this->init();
 
            
        $data = DB::table($name)->get();
        
        return view('frontend.' . $name, compact('data'));

    }

           
    public function contacts(Request $request){
      
    $name = __FUNCTION__;
      $this->active_main_menu_link = $name;
        $this->init();
 
            
        return view('frontend.' . $name);

    }







}
