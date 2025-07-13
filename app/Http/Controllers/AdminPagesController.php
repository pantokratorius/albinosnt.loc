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


    Validator::validate($request->all(), [
        'photo.*' => [
            File::image()
                ->max(4096)
        ]
    ], [
        'photo.*' => ':attribute Nuotrauka per didele!'
    ]);

// Storage::disk('your_disk')->delete('file.jpg');
// dd($_POST)
        if(!empty($_POST['blocks'])){
            foreach($_POST['blocks'] as $k => $v){
                if(!empty($v['photo'])){
                    if(! Storage::disk('public')->exists('services'))
                        $path = $request->file('image')->store('services', 'public');
                }
            }
        }





                // foreach($request->file('photos') as $key => $val){



                //            $path =  $val->store('skelbimai', 'public');

                //           Image->save(storage_path('app/public/'. $path) );

                //         //    dd($image);



                //            $pathes[] = substr($path, 10);
                //         }
                //         // dd($pathes);
                //         $attrs[$k] = ( $data->photos != '' ? $data->photos . ';' : '' )   . implode(';', $pathes);

                //     }

        return view('pages.'. $name);
    }

    public function servicesUpdate(Request $request){
        $name = __FUNCTION__;

        dD($request->all());

        return view('pages.'. $name);
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
