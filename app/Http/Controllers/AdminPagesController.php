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
// dd('services/' . $data[0]->block_image);
    if ($request->isMethod('post')) {




//    Validator::validate($request->all(), [
//         'blocks.*.photo' => [
//             File::image(allowSvg: true)
//                 ->max('1kb')
//         ]
//     ]);
// dd(File::exists('services/' . $data[0]->block_image));

    if(!empty($request->all()['blocks'])){
        foreach($request->all()['blocks'] as $k => $v){
            if(!empty($v['photo'])){
                    Storage::disk('public')->delete( paths: 'services/' . $data[$k - 1]->block_image);
                    $request->file('blocks.'.$k.'.photo')->store('services', 'public' );
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
