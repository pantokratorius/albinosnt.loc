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
use Illuminate\Validation\Rule;
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
        $managers = DB::select('SELECT * FROM users WHERE id != 1111');

      
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
            ],[], [
                'email' => '"E-mailas"',
                'name' => '"Vardas"',
                'password' => '"Slaptažodis"',
            ]);

            if(!empty($req['photo']) ){
                    $path = $request->file('photo')->store('vartotojai', 'public');
                    $req['photo'] = substr($path, 11);
            }
            // dd($req);
    
            DB::transaction(function () use ($req) { 
               $user = User::create($req);

             
               $user->assignRole($req['role']);
            });
           

     
        // dd($user);

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

        $role = '';

        $data = User::find($id);

        $role = DB::scalar('select roles.name from model_has_roles 
        LEFT JOIN roles ON roles.id = model_has_roles.role_id
        where model_id = ?', [$id]);


       if ($request->isMethod('post')) {

        $req = $request->except(['_token', 'submit']);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($data->id),],
        ],[], [
            'email' => '"E-mailas"',
            'name' => '"Vardas"',
            'password' => '"Slaptažodis"',
        ]);

            if(!empty($req['photo']) ){
                    $path = $request->file('photo')->store('vartotojai', 'public');
                    $req['photo'] = substr($path, 11);
            }

            if($req['password'] == null)
                unset($req['password']);

            $data->update($req);

        }


        return view('managers.edit', [
            'data' => $data,
            'permissions' => $this->permissions,
            'role' => $role
        ], ['success' => 'Issaugota sėkmingai!'] 
        );
    }


    public function removeImage(){

        dd($_POST);
        try{
            DB::update('UPDATE users set photo = "" WHERE id = :id', [
                'id' => $_POST['id'],
            ]);
            return response()->json(['status'=> 200]);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500]);
        } 
    }


    public function delete(){
        try{
        DB::delete('DELETE FROM users WHERE id = :id', ['id' =>(int)$_GET['id']]);
        return response()->json(['status'=> 200]);
    } catch (\Throwable $th) {
        return response()->json(['status'=> 500]);
    } 
    }
    






}
