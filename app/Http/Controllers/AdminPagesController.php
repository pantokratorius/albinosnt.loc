<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;


use Intervention\Image\Laravel\Facades\Image;

class AdminPagesController extends Controller
{

   
    public function wantToSell(Request $request){
        $name = __FUNCTION__;

        return view('pages.'. $name);
    }   

   
    public function services(Request $request){
        $name = __FUNCTION__;

        return view('pages.'. $name);
    }   
   
    public function servicesUpdate(Request $request){
        $name = __FUNCTION__;

        dD($request->all());

        return view('pages.'. $name);
    }   
   
    public function partners(Request $request){
        $name = __FUNCTION__;

        return view('pages.'. $name);
    }   
   
    public function contacts(Request $request){
        $name = __FUNCTION__;

        return view('pages.'. $name);
    }   





}
