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

    if ($request->isMethod('post')) {
            
            
           


//    Validator::validate($request->all(), [
//         'blocks.*.photo' => [
//             File::image(allowSvg: true)
//                 ->max('1kb')
//         ]
//     ]);
// dd($request->file('blocks.1.photo'));

    if(!empty($request->all()['blocks'])){
        foreach($request->all()['blocks'] as $k => $v){  
            if(!empty($v['photo'])){

                // if($data[0]->block_image != $v['photo']){
                //     Storage::disk('public')->delete('/services/'.$data[0]->block_image);
                //     unlink(public_path('storage/services/'.$data[0]->block_image));
                // }
                    if(! Storage::disk('public')->exists('services/' .$v['photo'])  )
                        // Storage::putFile('services', new File('services/' .$v['photo']), 'public');
                //    $request->file('blocks.'.$k.'.photo')->storeAs('services', $v['photo'],'public');
                        // Storage::disk('public')->put( 'services/'. $v['photo'], $request->file('blocks.'.$k.'.photo'));
                        $path =  $request->file('blocks.'.$k.'.photo')->store('services', 'public');
                        Image::read($request->file('blocks.'.$k.'.photo'))->save(storage_path('app/public/'. $path) );
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
