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
        $managers = DB::select('SELECT * FROM users WHERE id != 1');


        return view('managers.index',
            compact('managers')
        );
    }



     public function add(Request $request)
    {


        if ($request->isMethod('post')) {

            $req = $request->except(['_token', 'submit']);
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],[], [
                'email' => '"E-mailas"',
                'first_name' => '"Vardas"',
                'password' => '"Slaptažodis"',
            ]);

            if(!empty($req['photo']) ){
                    $path = $request->file('photo')->store('vartotojai', 'public');
                    $req['photo'] = substr($path, 11);
            }
            // dd($req);
            try{

                DB::transaction(function () use ($req) {
                    $user = User::create($req);

                    $user->assignRole($req['role']);
                });

                return redirect(route('admin.managers'))->with('success', 'Išsaugota sėkmingai!');
            } catch (\Throwable $th) {
                return redirect(route('admin.managers'))->with('error', 'Išsaugoti nepavyko!');
            }
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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

            try{

                $data->update($req);

                return redirect(route('admin.managers'))->with('success', 'Išsaugota sėkmingai!');
            } catch (\Throwable $th) {
                return redirect(route('admin.managers'))->with('error', 'Išsaugoti nepavyko!');
            }

        }


        return view('managers.edit', [
            'data' => $data,
            'permissions' => $this->permissions,
            'role' => $role
        ], ['success' => 'Issaugota sėkmingai!']
        );
    }


    public function removeImage(Request $request){
        try{
            DB::update('UPDATE users set photo = "" WHERE id = :id', [
                'id' => $request->input('id'),
            ]);
            return response()->json(['status'=> 200]);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500]);
        }
    }


    public function delete(Request $request){
        try{
            DB::transaction(function () use($request) {
                $id = (int)$request->query('id');
                $user = User::find($id);
                $user->delete();
                DB::delete('DELETE FROM model_has_roles WHERE model_id = ?', [$id]);
            });
            return response()->json(['status'=> 200]);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500]);
        }
    }







}
