<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AdminController extends Controller
{

    public $savivaldybe = [];
    public $buildType = [];
    public $equipment = [];

    public $heating = [];
    public $features = [];
    public $additional_premises = [];
    public $additional_equipment = [];
    public $security = [];


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
        1 => 'Įrengtas',
            'Dalinė apdaila',
            'Neįrengtas',
            'Nebaigtas statyti',
            'Pamatai',
            'Kita',
        ];

        $this->heating = [
        1 => 'Centrinis',
            'Elektra',
            'Skystu kuru',
            'Centrinis kolektorinis',
            'Geoterminis',
            'Oroterminis',
            'Dujinis',
            'Kietu kuru',
            'Kita',
        ];

        $this->features = [
        1 => 'Atskiras įėjimas',
            'Aukštos lubos',
            'Butas palėpėje',
            'Butas per kelis aukštus',
            'Tualetas ir vonia atskirai',
            'Nauja kanalizacija',
            'Nauja elektros instaliacija',
            'Uždaras kiemas',
            'Renovuotas namas',
            'Virtuvė sujungta su kambariu',
            'Internetas',
            'Kabelinė televizija',
        ];

        $this->additional_premises = [
        1 => 'Sandėliukas',
            'Balkonas',
            'Terasa',
            'Rūsys',
            'Garažas',
            'Pirtis',
            'Yra palėpė',
            'Drabužinė',
        ];

        $this->additional_equipment = [
        1 => 'Kondicionierius',
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
        $this->security = [
        1 => 'Aptverta teritorija',
            'Šarvuotos durys',
            'Signalizacija',
            'Kodinė laiptinės spyna',
            'Videokameros',
            'Budintis sargas',
        ];

    }



     public function __invoke(Request $request)
    {
        $params = [
            'savivaldybe' => $this->savivaldybe,
            'buildType' => $this->buildType,
            'equipment' => $this->equipment,
            'heating' => $this->heating,
            'features' => $this->features,
            'additional_premises' => $this->additional_premises,
            'additional_equipment' => $this->additional_equipment,
            'security' => $this->security,
        ];


        if ($request->isMethod('post')) {

            // dd($request->file('photos.0')->store('upload_file'));

            foreach($request->except(['_token', 'submit']) as $k => $v){
                if($v != ''){
                    if($k == 'heating' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                   elseif($k == 'addOptions' && !empty($v))
                       $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addRooms' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addEquipment' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'security' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif(in_array($k, ['showHouseNr', 'showRoomNr', 'swap'])){
                        $attrs[$k] = 1 ;
                    }
                    elseif($k == 'photos' &&  !empty($v) ){ 
                        $pathes = '';
                        foreach($request->file('photos') as $key => $val){
                           $path =  $val->store('skelbimai', 'public');
                           $pathes .= ';' . substr($path, 10);
                        }
                        // dd($pathes);
                        $attrs[$k] = $pathes; 

                    }
                    else {

                        $attrs[$k] = $v;

                    }

                }
            }




            $keys = array_keys($attrs);
            // $placeholders = ':' . implode(',:',  $keys);
            $keys = implode(',', $keys);
            $values = array_values($attrs);
            $quests = '?' . str_repeat(',?', count($attrs) - 1);

            if(DB::insert('insert into cms_module_ntmodulis ('.$keys.') values ('.$quests.')', $values)){
                return redirect(url()->current())->with('success', 'Išsaugota sėkmingai!');
            }else{
                return redirect(url()->current())->with('error', 'Išsaugoti nepavyko!');
            }

        }


        return view('skelbimai.naujas', $params);
    }

    public function getRegion(){
        $res = DB::select('select id, miestas_name from miestas where parent_id = ?', [(int)$_GET['region']]);

        if($res) {
            $arr = '<option value="">Pasirinkite</option>';
            $selected = '';
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
            $selected = '';
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
            $selected = '';
            foreach($res as $v){
                $arr .= '<option value="'.$v->id.'" '.$selected.'>'.$v->gatve_name.'</option>';
                $selected = '';
            }
            echo $arr;
        }
    }

    public function delete(){
        DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' =>(int)$_GET['id']]);
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


    public function skelbimai_redaguoti(Request $request, $id){


        $data = DB::select('SELECT *,  cms_module_ntmodulis.id as idd
            FROM cms_module_ntmodulis
            LEFT JOIN `vietove` ON cms_module_ntmodulis.region=vietove.id
            LEFT JOIN `kvartalas` ON cms_module_ntmodulis.quarter=kvartalas.id
            LEFT JOIN `miestas` ON cms_module_ntmodulis.city=miestas.id
            LEFT JOIN `gatves` ON cms_module_ntmodulis.streets=gatves.id
            LEFT JOIN `cms_users` ON cms_module_ntmodulis.userID=cms_users.id
            WHERE cms_module_ntmodulis.id =:id', ['id' => $id]);

$data = $data[0];


        $miestas = DB::select('select id, miestas_name from miestas where parent_id = ?', [(int)$data->region]);
        $mikroregion = DB::select('select id, kvartalas_name from kvartalas where parent_id = ?', [(int)$data->city]);
        $street = DB::select('select id, gatve_name from gatves where parent_id = ?', [(int)$data->city]);

        $heating_values = explode(';', $data->heating);
        $features_values = explode(';', $data->addOptions);
        $additional_premises_values = explode(';', $data->addRooms);
        $additional_equipment_values = explode(';', $data->addEquipment);
        $security_values = explode(';', $data->security);

        $photos = [];
        if($data->photos != ''){
            $photos = explode(';', $data->photos);
        }


        $params = [
            'data' => $data,
            'savivaldybe' => $this->savivaldybe,
            'buildType' => $this->buildType,
            'equipment' => $this->equipment,
            'heating' => $this->heating,
            'heating_values' => $heating_values,
            'features' => $this->features,
            'features_values' => $features_values,
            'additional_premises' => $this->additional_premises,
            'additional_premises_values' => $additional_premises_values,
            'additional_equipment' => $this->additional_equipment,
            'additional_equipment_values' => $additional_equipment_values,
            'security' => $this->security,
            'security_values' => $security_values,
            'miestas' => $miestas,
            'mikroregion' => $mikroregion,
            'street' => $street,
            'photos' => $photos,
       ];



        if ($request->isMethod('post')) {

            // dd($request->file('photos.0')->store('upload_file'));

            foreach($request->except(['_token', 'submit']) as $k => $v){
                if($v != ''){
                    if($k == 'heating' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                   elseif($k == 'addOptions' && !empty($v))
                       $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addRooms' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addEquipment' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'security' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif(in_array($k, ['showHouseNr', 'showRoomNr', 'swap'])){
                        $attrs[$k] = 1;
                    }
                    elseif($k == 'photos' &&  !empty($v) ){ 
                        $pathes = '';
                        foreach($request->file('photos') as $key => $val){
                           $path =  $val->store('skelbimai', 'public');
                           $pathes .= ';' . substr($path, 10);
                        }
                        // dd($pathes);
                        $attrs[$k] = $data->photos . $pathes; 

                    }
                    else {

                        $attrs[$k] = $v;

                    }

                }
            }

           




            $keys = array_keys($attrs);
            // $placeholders = ':' . implode(',:',  $keys);
            $keys = implode(' = ?,', $keys) . ' = ?';
            $values = array_values($attrs);
            $values[] = $id;
            if(DB::insert('UPDATE cms_module_ntmodulis  set '.$keys. ' WHERE id = ?', $values )){
                return redirect(url()->current())->with('success', 'Išsaugota sėkmingai!');
            }else{
                return redirect(url()->current())->with('error', 'Išsaugoti nepavyko!');
            }

        }



    return view('skelbimai.redagavimas',$params);
    }



    public function skelbimai_trinti($id){
        if(DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' => (int)$id]))
            return redirect('/admin/skelbimai')->with('success', 'Ištrinta sėkmingai!');
    }







}
