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
    public $water = [];
    public $features = [];
    public $additional_premises = [];
    public $additional_equipment = [];
    public $security = [];

    public $reservoir = [];
    public $house_type = [];
    public $purpose = [];

    public $except = [];

    public function __construct()
    {

        $this->except = ['_token', 'submit', 'morePremises'];

        $this->savivaldybe = DB::table('vietove')->get();

        $this->buildType = [
            'Mūrinis',
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

        $this->heating = [
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

        $this->water = [
            'Artezinis',
            'Miesto vandentiekis',
            'Šulinys',
            'Vietinis vandentiekis',
            'Kita',
        ];

        $this->features = [
            'Atskiras įėjimas',
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
            'Sandėliukas',
            'Balkonas',
            'Terasa',
            'Rūsys',
            'Garažas',
            'Pirtis',
            'Yra palėpė',
            'Drabužinė',
        ];

        $this->additional_equipment = [
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

        $this->security = [
            'Aptverta teritorija',
            'Šarvuotos durys',
            'Signalizacija',
            'Kodinė laiptinės spyna',
            'Videokameros',
            'Budintis sargas',
        ];

        $this->reservoir = [
            'Jūra',
            'Ežeras',
            'Upė',
            'Tvenkinys',
        ];


        $this->house_type = [
            1 =>   'Namas',
            'Namo dalis',
            'Kotedžas',
        ];

        $this->purpose = [
            1 => 'Namų valda',
                'Daugiabučių statyba',
                'Žemės ūkio',
                'Sklypas soduose',
                'Miškų ūkio',
                'Pramonės',
                'Sandėliavimo',
                'Komercinė',
                'Rekreacinė',
                'Kita',
            ];

    }



    public function skelbimai(){
        $data = DB::select('SELECT *,  cms_module_ntmodulis.id as idd
            FROM cms_module_ntmodulis
            LEFT JOIN `vietove` ON cms_module_ntmodulis.region=vietove.id
            LEFT JOIN `kvartalas` ON cms_module_ntmodulis.quarter=kvartalas.id
            LEFT JOIN `miestas` ON cms_module_ntmodulis.city=miestas.id
            LEFT JOIN `gatves` ON cms_module_ntmodulis.streets=gatves.id
            LEFT JOIN `cms_users` ON cms_module_ntmodulis.userID=cms_users.id
            ORDER BY cms_module_ntmodulis.create_date DESC');
            // WHERE state=:active


     $managers = DB::select('SELECT id, first_name, last_name FROM cms_users WHERE first_name != "" AND last_name != ""');




        return view('skelbimai.index',
            compact('data')
        );
    }



     public function skelbimai_naujas(Request $request)
    {
        $params = [
            'savivaldybe' => $this->savivaldybe,
            'buildType' => $this->buildType,
            'equipment' => $this->equipment,
            'heating' => $this->heating,
            'water' => $this->water,
            'features' => $this->features,
            'additional_premises' => $this->additional_premises,
            'additional_equipment' => $this->additional_equipment,
            'security' => $this->security,
            'reservoir' => $this->reservoir,
            'house_type' => $this->house_type,
            'purpose' => $this->purpose,
        ];

        $attrs['state'] = 'active';

        if ($request->isMethod('post')) {

            // dd($request->file('photos.0')->store('upload_file'));

            foreach($request->except($this->except) as $k => $v){
                if($v != ''){
                    if($k == 'heating' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'water' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                   elseif($k == 'addOptions' && !empty($v))
                       $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addRooms' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addEquipment' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'security' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'purpose' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif(in_array($k, ['showHouseNr', 'showRoomNr', 'swap', 'showLandSizeNr'])){
                        $attrs[$k] = 1 ;
                    }
                    elseif($k == 'photos' &&  !empty($v) ){
                        $pathes = [];
                        foreach($request->file('photos') as $key => $val){
                           $path =  $val->store('skelbimai', 'public');
                           $pathes[] = substr($path, 10);
                        }

                        $attrs[$k] = implode(';', $pathes);

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
                return redirect(route('admin.skelbimai'))->with('success', 'Išsaugota sėkmingai!');
            }else{
                return redirect(route('admin.skelbimai'))->with('error', 'Išsaugoti nepavyko!');
            }

        }


        return view('skelbimai.naujas', $params);
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
        $water_values = explode(';', $data->water);
        $features_values = explode(';', $data->addOptions);
        $additional_premises_values = explode(';', $data->addRooms);
        $additional_equipment_values = explode(';', $data->addEquipment);
        $security_values = explode(';', $data->security);
        $purpose_values = explode(';', $data->purpose);

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
            'water' => $this->water,
            'heating_values' => $heating_values,
            'water_values' => $water_values,
            'features' => $this->features,
            'features_values' => $features_values,
            'additional_premises' => $this->additional_premises,
            'additional_premises_values' => $additional_premises_values,
            'additional_equipment' => $this->additional_equipment,
            'additional_equipment_values' => $additional_equipment_values,
            'security' => $this->security,
            'reservoir' => $this->reservoir,
            'security_values' => $security_values,
            'miestas' => $miestas,
            'mikroregion' => $mikroregion,
            'street' => $street,
            'photos' => $photos,
            'photos_str' => $data->photos,
            'house_type' => $this->house_type,
            'purpose' => $this->purpose,
            'purpose_values' => $purpose_values,
       ];


       if ($request->isMethod('post')) {

           $req = $request->except($this->except);

            // dd($req);


            foreach($req as $k => $v){
                if($v != ''){
                    if($k == 'heating' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'water' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                   elseif($k == 'addOptions' && !empty($v))
                       $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addRooms' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'addEquipment' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'security' && !empty($v))
                        $attrs[$k] =  implode(';', $v);
                    elseif($k == 'purpose' && !empty($v))
                        $attrs[$k] =  implode(';', $v);

                    elseif($k == 'photos' &&  !empty($v) ){
                        $pathes = [];
                        foreach($request->file('photos') as $key => $val){
                           $path =  $val->store('skelbimai', 'public');
                           $pathes[] = substr($path, 10);
                        }
                        // dd($pathes);
                        $attrs[$k] = ( $data->photos != '' ? $data->photos . ';' : '' )   . implode(';', $pathes);

                    }
                    else {

                        $attrs[$k] = $v;

                    }

                    if(in_array($k, ['showHouseNr', 'showRoomNr', 'swap', 'showLandSizeNr'])){
                        $attrs[$k] = 1;
                    }else{
                        if(!isset($req['showHouseNr'])){
                            $attrs['showHouseNr'] = 0;
                        }
                        if(!isset($req['showRoomNr'])){
                            $attrs['showRoomNr'] = 0;
                        }
                        if(!isset($req['swap'])){
                            $attrs['swap'] = 0;
                        }
                        if(!isset($req['showLandSizeNr'])){
                            $attrs['showLandSizeNr'] = 0;
                        }
                    }

                    if($req['size'] > 0){
                        $attrs['sizeFrom'] = null;
                        $attrs['sizeTo'] = null;
                    }
                    if($req['floor'] > 0){
                        $attrs['floorFrom'] = null;
                        $attrs['floorTo'] = null;
                    }
                    if($req['premisesAmount'] > 0){
                        $attrs['premisesAmountFrom'] = null;
                        $attrs['premisesAmountTo'] = null;
                    }
                    if($req['sizeFrom'] > 0){
                        $attrs['size'] = null;
                    }
                    if($req['floorFrom'] > 0){
                        $attrs['floor'] = null;
                    }
                    if($req['premisesAmountFrom'] > 0){
                        $attrs['premisesAmount'] = null;
                    }

                }
                else {
                    $attrs[$k] = $v;
                }


            }

            // dd($attrs);




            $keys = array_keys($attrs);
            // $placeholders = ':' . implode(',:',  $keys);
            $keys = implode(' = ?,', $keys) . ' = ?';
            $values = array_values($attrs);
            $values[] = $id;
            if(DB::insert('UPDATE cms_module_ntmodulis  set '.$keys. ' WHERE id = ?', $values )){
                return redirect(route('admin.skelbimai'))->with('success', 'Išsaugota sėkmingai!');
            }else{
                return redirect(route('admin.skelbimai'))->with('error', 'Išsaugoti nepavyko!');
            }

        }


    return view('skelbimai.edit_tabs.' . $data->itemType ,$params);
    }


    public function getManagers(){
        $managers = DB::select('SELECT id, first_name, last_name FROM cms_users WHERE first_name != "" AND last_name != ""');

        return response()->json($managers);
    }

    public function updateManager(){
        DB::update('UPDATE cms_module_ntmodulis set userID = :val WHERE id = :id  ', [
            'id' => (int)$_GET['id'],
            'val' => (int)$_GET['val'],
        ]);
        return response()->json(['status' => 200]);

    }


    public function delete(){
        DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' =>(int)$_GET['id']]);
    }



    public function skelbimai_trinti($id){
        if(DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' => (int)$id]))
            return redirect('/admin/skelbimai')->with('success', 'Ištrinta sėkmingai!');
    }


    public function getRegion(){
        $res = DB::select('select id, miestas_name from miestas where parent_id = ? ORDER BY miestas_name', [(int)$_GET['region']]);

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
        $res = DB::select('select id, kvartalas_name from kvartalas where parent_id = ? ORDER BY kvartalas_name', [(int)$_GET['miestas']]);

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
        $res = DB::select('select id, gatve_name from gatves where parent_id = ? ORDER BY gatve_name', [(int)$_GET['miestas']]);

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



    public function updateOrder(){
        if(!empty($_POST['photos'])){
            if(DB::update('UPDATE cms_module_ntmodulis set photos = :photos WHERE id = :id',
            [
                'id' => (int)$_POST['id'],
                'photos' => implode(';',$_POST['photos'])
            ])) return response()->json(['status'=> 200]);
        }
    }









}
