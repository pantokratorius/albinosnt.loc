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


    public function wantToSell(Request $request){
        $name = __FUNCTION__;

        return view('pages.'. $name);
    }


    public function services(Request $request){
        $name = __FUNCTION__;

        $data = DB::table(table: $name)->get();
        // dd($data[0]);

if ($request->isMethod('post')) {
    Validator::validate($request->all(), [
        'photo.*' => [
            File::image()
                ->max(4096)
        ]
    ], [
        'photo.*' => ':attribute Nuotrauka per didele!'
    ]);



    if(!empty($_POST['blocks'])){
        foreach($_POST['blocks'] as $k => $v){
            if(!empty($v['photo'])){
                if($data[0]->block_image != $v['photo']){
                    Storage::disk('public')->delete('/services/'.$data[0]->block_image);
                    unlink(asset('/services/'.$data[0]->block_image));
                }
                    if(! Storage::disk('public')->exists('services'))
                        $path = $request->file('image')->store('services', 'public');
                }
            }
        }

    }




        return view('pages.'. $name, compact('data'));
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
