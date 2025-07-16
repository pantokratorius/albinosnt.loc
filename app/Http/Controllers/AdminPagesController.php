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
                }else{
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

        return view('pages.'. $name);
    }





}
