<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    
    public $savivaldybe = [];
    public $buildType = [];
    public $equipment = [];


    public function __construct()
    {
        $this->savivaldybe = DB::table('vietove')->get();
        $this->buildType = [
        1 => 'Mūrinis',
            'Blokinis',
            'Monolitinis',
            'Medinis',
            'Karkasinis',
            'Rąstinis',
            'Kita',
        ];

        $this->equipment = [
            'Įrengtas',
            'Dalinė apdaila',
            'Neįrengtas',
            'Nebaigtas statyti',
            'Pamatai',
            'Kita',
        ];

    }
    
    
    
     public function __invoke()
    {

        return view('skelbimai.naujas', [
            'savivaldybe' => $this->savivaldybe,
            'buildType' => $this->buildType,
            'equipment' => $this->equipment,
        ]);
    }

    public function getRegion(){
        $res = DB::select('select id, miestas_name from miestas where parent_id = ?', [(int)$_GET['region']]);

        if($res) {
            $arr = '<option value="">Pasirinkite</option>';
            $selected = 'selected';
            foreach($res as $v){
                $arr .= '<option value="'.$v->id.'" '.$selected.'>'.$v->miestas_name.'</option>';
                $selected = '';
            }
            echo $arr;
        }
    }

    public function getMikroregion(){
        $res = DB::select('select id, kvartalas_name from kvartalas where parent_id = ?', [(int)$_GET['miestas']]);

        if($res) {
            $arr = '<option value="">Pasirinkite</option>';
            $selected = 'selected';
            foreach($res as $v){
                $arr .= '<option value="'.$v->id.'" '.$selected.'>'.$v->kvartalas_name.'</option>';
                $selected = '';
            }
            echo $arr;
        }
    }

    public function getGatve(){
        $res = DB::select('select id, gatve_name from gatves where parent_id = ?', [(int)$_GET['miestas']]);

        if($res) {
            $arr = '<option value="">Pasirinkite</option>';
            $selected = 'selected';
            foreach($res as $v){
                $arr .= '<option value="'.$v->id.'" '.$selected.'>'.$v->gatve_name.'</option>';
                $selected = '';
            }
            echo $arr;
        }
    }


    
    public function skelbimai(){
        $data = DB::select('SELECT *,  cms_module_ntmodulis.id as idd
            FROM cms_module_ntmodulis 
            LEFT JOIN `vietove` ON cms_module_ntmodulis.region=vietove.id 
            LEFT JOIN `kvartalas` ON cms_module_ntmodulis.quarter=kvartalas.id 
            LEFT JOIN `miestas` ON cms_module_ntmodulis.city=miestas.id 
            LEFT JOIN `gatves` ON cms_module_ntmodulis.streets=gatves.id 
            LEFT JOIN `cms_users` ON cms_module_ntmodulis.userID=cms_users.id 
            WHERE state=:active ORDER BY cms_module_ntmodulis.create_date DESC', ['active' => 'active']);



        return view('skelbimai.index',   
            compact('data')
        );
    }

    
    public function skelbimai_redaguoti($id){

       
        $data = DB::select('SELECT *,  cms_module_ntmodulis.id as idd
            FROM cms_module_ntmodulis 
            LEFT JOIN `vietove` ON cms_module_ntmodulis.region=vietove.id 
            LEFT JOIN `kvartalas` ON cms_module_ntmodulis.quarter=kvartalas.id 
            LEFT JOIN `miestas` ON cms_module_ntmodulis.city=miestas.id 
            LEFT JOIN `gatves` ON cms_module_ntmodulis.streets=gatves.id 
            LEFT JOIN `cms_users` ON cms_module_ntmodulis.userID=cms_users.id 
            WHERE cms_module_ntmodulis.id =:id', ['id' => $id]);

        $data = $data[0];

        $miestas = DB::select('select id, miestas_name from miestas where parent_id = ?', [(int)$data->city]);
        // $mikroregion = DB::select('select id, gatve_name from gatves where parent_id = ?', [(int)$data->city]);

        return view('skelbimai.redagavimas',   
            [
                'data' => $data,
                'savivaldybe' => $this->savivaldybe,
                'buildType' => $this->buildType,
                'equipment' => $this->equipment,
                'miestas' => $miestas,
                // 'mikroregion' => $mikroregion,
            ]
        );
    }


}
