<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request){

        $buscar = $request->get('buscar');
        $usuarios = DB::table('users')
        ->where('email','LIKE','%'.$buscar.'%')
        ->orwhere('name','LIKE','%'.$buscar.'%')
        ->get();

        return view('usuarios.index',compact('usuarios','buscar'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(Request $request){
        $validator = $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|max:150|email|unique:users',
            'password'=>'required|max:20|confirmed',
            'dni'=>'required|max:8|min:8|unique:users',
            'role'=>'required|max:20',
        ]);
        try {
            $user = new User;
            $user->name=$request->get('name');
            $user->email=$request->get('email');
            $user->password=bcrypt($request->get('password'));
            $user->dni=$request->get('dni');
            $user->role=$request->get('role');
            $imgname = uniqid();
            $extension = $request->poster->extension();
            $imageName = $imgname.'.'.$request->poster->extension();  
            $request->poster->move(public_path('perfiles'), $imageName);
            $user->poster = $imageName;
            $user->estado = 'Activo';
            $user->save();

            Session::flash('success', 'Se registró el usuario con exito');
            return Redirect::to('panel/usuarios');

        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function edit($dni){

        $user = User::where('dni','=',$dni)->firstOrFail();
        
        return view('usuarios.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $validator = $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|max:150|email|unique:users,email,'.$request->get('email').',email',
            'password'=>'max:20|confirmed',
            'dni'=>'required|max:8|min:8|unique:users,dni,'.$request->get('dni').',dni',
            'role'=>'required|max:20',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name=$request->get('name');
            $user->email=$request->get('email');
            if($request->get('password')){
                $user->password=bcrypt($request->get('password'));
            }
            $user->dni=$request->get('dni');
            $user->role=$request->get('role');
            if($request->poster){
                $imgname = uniqid();
                $extension = $request->poster->extension();
                $imageName = $imgname.'.'.$request->poster->extension();  
                $request->poster->move(public_path('perfiles'), $imageName);
                $user->poster = $imageName;
            }
            $user->estado = 'Activo';
            $user->update();

            Session::flash('success', 'Se actualizó el usuario con exito');
            return Redirect::to('panel/usuarios');

        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }
}
