<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules;


use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagersController extends Controller
{

    public $permissions = [];


    public function __construct()
    {
        $this->permissions = Role::where('id', '!=', '3')->pluck('name');
    }


    public function index(){
        $managers = DB::select('SELECT * FROM cms_users');

      
        return view('managers.index',
            compact('managers')
        );
    }



     public function add(Request $request)
    {
   

        if ($request->isMethod('post')) {

            $req = $request->except(['_token', 'submit']);
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        dd($user);

            // $keys = array_keys($attrs);
            // // $placeholders = ':' . implode(',:',  $keys);
            // $keys = implode(',', $keys);
            // $values = array_values($attrs);
            // $quests = '?' . str_repeat(',?', count($attrs) - 1);

            // try{
            //     DB::insert('insert into cms_module_ntmodulis ('.$keys.') values ('.$quests.')', $values);
            //     return redirect(route('admin.skelbimai'))->with('success', 'Išsaugota sėkmingai!');
            // } catch (\Throwable $th) {
            //     return redirect(route('admin.skelbimai'))->with('error', 'Išsaugoti nepavyko!');
            // }

        }


        return view('managers.add', [
            'permissions' => $this->permissions
        ]);
    }



    public function edit(Request $request, $id){


        $data = DB::select('SELECT * FROM cms_users
            WHERE id =:id', ['id' => $id]);
        $data = $data[0];

// dd($data);






        


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


    return view('managers.edit', compact('data') );
    }


    


    public function delete(){
        DB::delete('DELETE FROM cms_module_ntmodulis WHERE id = :id', ['id' =>(int)$_GET['id']]);
    }






}
