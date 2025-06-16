<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class IndexController extends BaseController
{

  


    public function index(Request $request){
        
        


        
         $data = DB::table('cms_module_ntmodulis')
            ->select('*')
            // ->join('vietove', 'cms_module_ntmodulis.region', '=', 'vietove.id')
            // ->join('kvartalas', 'cms_module_ntmodulis.quarter', '=', 'kvartalas.id')
            // ->join('miestas', 'cms_module_ntmodulis.city', '=', 'miestas.id')
            // ->join('gatves', 'cms_module_ntmodulis.streets', '=', 'gatves.id')
            // ->join('users', 'cms_module_ntmodulis.userID', '=', 'users.id')
            ->where($this->where[0], $this->where[1])
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);


             $photo = [];  $region = []; $quarter = []; $city = []; $streets = []; $userID = [];


            foreach($data as $k => $v){
                if($v->photos != ''){
                    $photos  = explode(';', $v->photos); 
                    if(is_array($photos)) 
                        $photos = $photos[0];
                    $photo[$v->id] = $photos;
                }
                if($v->region > 0){
                    $region_value = DB::table('vietove')->find($v->region);
                    $region[$v->id] = !empty($region_value) ?  $region_value->vietove_name : '';
                }
                if($v->quarter > 0){
                    $quarter_value = DB::table('kvartalas')->find($v->quarter);
                    $quarter[$v->id] = !empty($quarter_value) ? $quarter_value->kvartalas_name : '';
                }
                if($v->city > 0){
                    $city_value = DB::table('miestas')->find($v->city);
                    $city[$v->id] = !empty($city_value) ? $city_value->miestas_name : '';
                }
                if($v->streets > 0){
                    $streets_value = DB::table('gatves')->find($v->streets);
                    $streets[$v->id] = !empty($streets_value) ? $streets_value->gatve_name : '';
                }
                if($v->userID > 0){
                    $userID_value = DB::table('users')->find($v->userID);
                    $userID[$v->id] = !empty($userID_value) ? $userID_value->first_name . ' ' . $userID_value->last_name  : '';
                }
            }

            if(isset($request->type ) && $request->type == 'simple'){
                $request->session()->put('type', 'simple');
            }    
            elseif(isset($request->type ) && $request->type == 'tile'){
                $request->session()->put('type', 'tile');
            } 
            
            
            



             return view('frontend.welcome',
                compact('data', 'photo', 'region', 'quarter', 'city', 'streets', 'userID')
            );

    }



    public function item($id){


        $data = []; $photos = []; $region = ''; $quarter = ''; $city = ''; $streets = ''; $user_data = [];
        
        $data = DB::table('cms_module_ntmodulis')
            ->find($id);

             if($data->photos != ''){
                    $photos  = explode(';', $data->photos);
                }
                if($data->region > 0){
                    $region = DB::table('vietove')->find($data->region);
                    if($region) $region = $region->vietove_name;
                }
                if($data->quarter > 0){
                    $quarter = DB::table('kvartalas')->find($data->quarter); 
                    if($quarter) $quarter = $quarter->kvartalas_name;
                }
                if($data->city > 0){
                    $city = DB::table('miestas')->find($data->city);
                    if($city)  $city =  $city->miestas_name;
                }
                if($data->streets > 0){
                    $streets = DB::table('gatves')->find($data->streets);
                    if($streets) $streets = $streets->gatve_name;
                }
                if($data->userID > 0){
                    $userID = DB::table('users')->find($data->userID);
                    if($userID){
                        $user_data['name'] = $userID->first_name . ' ' . $userID->last_name ;
                        $user_data['phone'] = substr($userID->phone, 0, 4) .' ' . substr($userID->phone,4, 3) .' ' . substr($userID->phone,7);
                        $user_data['email'] = $userID->email;
                        $user_data['photo'] = $userID->photo;
                    } 
                }
         $similar = DB::table('cms_module_ntmodulis')
            ->select('*')
            ->where('itemType', $data->itemType)
            ->inRandomOrder()
            ->limit(4)
            ->get();

             return view('frontend.item',
                compact('data', 'photos', 'region', 'quarter', 'city', 'streets', 'user_data', 'similar')
            );


    }





}
