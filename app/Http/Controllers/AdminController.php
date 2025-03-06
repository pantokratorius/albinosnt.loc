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
    /**
     * Display the user's profile form.
     */
    public function __invoke()
    {

        $savivaldybe = DB::table('vietove')->get();
        $buildType = [
        1 => 'Mūrinis',
            'Blokinis',
            'Monolitinis',
            'Medinis',
            'Karkasinis',
            'Rąstinis',
            'Kita',
        ];

        $equipment = [
            'Įrengtas',
            'Dalinė apdaila',
            'Neįrengtas',
            'Nebaigtas statyti',
            'Pamatai',
            'Kita',
        ];


        return view('ntmodulis',
        compact('savivaldybe', 'buildType', 'equipment'));
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


}
