<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminPagesController extends Controller
{




    public function services(Request $request){
        $name = __FUNCTION__;

      $data = DB::table(table: $name)->get();


    if ($request->isMethod('post')) {



$params = [];

DB::update('UPDATE services set title = ?, description = ? WHERE id = ? ', [
    $request->all()['title'],
    $request->all()['description'],
    1
]);

    if(!empty($request->all()['blocks'])){
        foreach($request->all()['blocks'] as $k => $v){
            if(!empty($v['photo'])){
                    Storage::disk('public')->delete( paths: 'services/' . $data[$k - 1]->block_image);
                    $request->file('blocks.'.$k.'.photo')->store('services', 'public' );
                    DB::update('UPDATE services set block_title = ?, block_text = ?, block_image = ? WHERE id = ? ', [
                        $v['title'],
                        $v['description'],
                        $request->file('blocks.'.$k.'.photo')->hashName(),
                        $k,
                    ]);
                }else{
                    DB::update('UPDATE services set block_title = ?, block_text = ? WHERE id = ? ', [
                        $v['title'],
                        $v['description'],
                        $k,
                    ]);
                }





            }

        }





    }


    $data = DB::table(table: $name)->get();

        return view('pages.'. $name, compact('data'));
    }

public function partners(Request $request){
        $name = __FUNCTION__;

      $data = DB::table(table: $name)->get();


    if ($request->isMethod('post')) {

// dd($request->all());

$params = [];

DB::update('UPDATE partners set title = ?, description = ? WHERE id = ? ', [
    $request->all()['title'],
    $request->all()['description'],
    1
]);

    if(!empty($request->all()['blocks'])){
        foreach($request->all()['blocks'] as $k => $v){
            if(!empty($v['photo'])){
                    Storage::disk('public')->delete( paths: 'partners/' . $data[$k - 1]->block_image);
                    $request->file('blocks.'.$k.'.photo')->store('partners', 'public' );
                    DB::update('UPDATE partners set block_title = ?, block_text = ?, block_image = ? WHERE id = ? ', [
                        $v['title'],
                        $v['description'],
                        $request->file('blocks.'.$k.'.photo')->hashName(),
                        $k,
                    ]);
                }
                if(!empty($v['files'])){
                    Storage::disk('public')->delete( paths: 'partners_files/' . $data[$k - 1]->block_files);
                    $request->file('blocks.'.$k.'.files')->store('partners_files', 'public' );
                    DB::update('UPDATE partners set block_title = ?, block_text = ?, block_files = ? , block_names = ? WHERE id = ? ', [
                        $v['title'],
                        $v['description'],
                        $request->file('blocks.'.$k.'.files')->hashName(),
                        $request->file('blocks.'.$k.'.files')->getClientOriginalName(),
                        $k,
                    ]);
                }

            if( empty($v['photo']) && empty($v['files']) ){
                    DB::update('UPDATE partners set block_title = ?, block_text = ? WHERE id = ? ', [
                        $v['title'],
                        $v['description'],
                        $k,
                    ]);
                }    

            }

        }



    }

    $data = DB::table(table: $name)->get();

        return view('pages.'. $name, compact('data'));
    }

    public function contacts(Request $request){
        $name = __FUNCTION__;

        $r = $request->all();

        if ($request->isMethod('post')) {
            DB::update('UPDATE contacts set title =?, ik =?, mk =?, phone =?, email =?, address =?, map =?', [
                $r['title'],
                $r['ik'],
                $r['mk'],
                $r['phone'],
                $r['email'],
                $r['address'],
                $r['map'],
            ]);
        }

        $data = DB::table(table: $name)->find(1);
        return view('pages.'. $name, compact('data'));
    }

    public function delete_files(){
    
        $id = (int)$_POST['id'];
        
        $file_name = DB::table('partners')->where('id', $id)->value('block_files');
        
        Storage::disk('public')->delete( paths: 'partners_files/' . $file_name);
        DB::update('UPDATE partners set block_files = "", block_names = "" WHERE id = ?', [
            $id
        ]);
    }



}
