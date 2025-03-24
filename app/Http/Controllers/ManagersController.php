<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;


use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ManagersController extends Controller
{



    public function index(){
        $managers = DB::select('SELECT * FROM cms_users');


        return view('managers.index',
            compact('managers')
        );
    }



     public function skelbimai_naujas(Request $request)
    {
   

        $attrs['state'] = 'active';

        if ($request->isMethod('post')) {

            // dd($request->all());

            foreach($request->all() as $k => $v){
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

            try{
                DB::insert('insert into cms_module_ntmodulis ('.$keys.') values ('.$quests.')', $values);
                return redirect(route('admin.skelbimai'))->with('success', 'Išsaugota sėkmingai!');
            } catch (\Throwable $th) {
                return redirect(route('admin.skelbimai'))->with('error', 'Išsaugoti nepavyko!');
            }

        }


        return view('skelbimai.naujas');
    }



    public function edit(Request $request, $id){


        $data = DB::select('SELECT * FROM cms_users
            WHERE id =:id', ['id' => $id]);
        $data = $data[0];

dd($data);



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


        


       if ($request->isMethod('post')) {

           $req = $request->all();
    
            Validator::validate($req, [
                'photos.*' => [
                    File::image()
                        ->max(4096)
                ]
            ], [
                'photos.*' => ':attribute Nuotrauka per didele!'
            ]);


            // $keys = array_keys($attrs);
            // // $placeholders = ':' . implode(',:',  $keys);
            // $keys = implode(' = ?,', $keys) . ' = ?';
            // $values = array_values($attrs);
            // $values[] = $id;

            // try{
            //     DB::insert('UPDATE cms_module_ntmodulis  set '.$keys. ' WHERE id = ?', $values );
            //     return redirect(route('admin.skelbimai'))->with('success', 'Išsaugota sėkmingai!');
            // } catch (\Throwable $th) {
            //     return redirect(route('admin.skelbimai'))->with('error', 'Išsaugoti nepavyko!');
            // }
        }


    return view('skelbimai.edit_tabs.' . $data->itemType );
    }


    


    public function delete(){
        DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' =>(int)$_GET['id']]);
    }






}
