<?php

namespace Cinema\Http\Controllers;

use Cinema\User;
use Cinema\TiposUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cinema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uss = User::join('tipos_usuarios','users.id_tipo_usuario','=','tipos_usuarios.id')->select(['users.id','users.nombre','users.apellido','users.created_at','users.email','users.id_tipo_usuario','tipos_usuarios.descripcion as descripcion']);
        $uss->where('users.id', '!=', Auth::id());
        $uss->where('users.estado','=','activo');
        $usuarios = $uss->get(); //importante asignar el resultado final a otra variable distinta antes de convertirlo a json con compact, caso contrario se crashea el navegador
        return view('Administrador.abmlUsuarios',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposUsuarios = TiposUsuarios::all();
        return view('Administrador.altaUsuario',compact('tiposUsuarios'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_tipo_usuario' => ['required','integer'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $rules = [
                'nombre' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
                'apellido' => ['required','regex:/^[A-Za-z\s-_]+$/' , 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'id_tipo_usuario' => ['required','integer'],
              ];   

      $messages = [ 'nombre.regex'=>'Formato de nombre incorrecto',
                    'nombre.required'=>'Complete el campo requerido',
                    'nombre.max'=>'La longitud del nombre supera el máximo requerido',
                    'apellido.regex'=>'Formato de apellido incorrecto',
                    'apellido.required'=>'Complete el campo requerido',
                    'apellido.max'=>'La longitud del nombre supera el máximo requerido',
                    'email.unique'=>'El email ingresado ya existe',
                    'password.min'=>'La contraseña debe tener almenos 8 caracteres',
                    'password.confirmed'=>'Las contraseñas no coinciden',
                    'id_tipo_usuario.required'=>'Seleccine un tipo de usuario'

                  ];          
     $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $us = new User();
        $us->nombre = $request['nombre'];
        $us->apellido = $request['apellido'];
        $us->email = $request['email'];
        $us->password = Hash::make($request['password']);
        $us->id_tipo_usuario= $request['id_tipo_usuario'];
        $us->save(); 
        return redirect('abmlUsuarios')->with('success','Usuario registrado con éxito');
     }          
             
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $us = User::find($id);
        $tiposUsuarios = TiposUsuarios::all();

        if($us && $tiposUsuarios)
        {
          return view('Administrador.editarUsuario',compact('us','tiposUsuarios'));  
        }
        else
        {
          return back()->with('error','Usuario no encontrado.');
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $Us = User::select('id')->where('id','=',$request['id']);
      $idUs = $Us->where('email','=',$request['email'])->get();
      if(isset($idUs))
      {
        $ruleMail = [];
      }
      else
      {
        $ruleMail = ['string', 'email', 'max:255', 'unique:users'];
      } 
      $rules = [
                'nombre' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
                'apellido' => ['required','regex:/^[A-Za-z\s-_]+$/' , 'max:255'],
                'email' => $ruleMail ,
                'id_tipo_usuario' => ['required','integer'],
               ];   

      $messages = [ 
                    'nombre.regex'=>'Formato de nombre incorrecto',
                    'nombre.required'=>'Complete el campo requerido',
                    'nombre.max'=>'La longitud del nombre supera el máximo requerido',
                    'apellido.regex'=>'Formato de apellido incorrecto',
                    'apellido.required'=>'Complete el campo requerido',
                    'apellido.max'=>'La longitud del nombre supera el máximo requerido',
                    'email.unique'=>'El email ingresado ya existe',
                    'id_tipo_usuario.required'=>'Seleccine un tipo de usuario'
                  ];          

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
       /* $u = [ 'nombre'=>$request['nombre'],
               'apellido'=>$request['apellido'],
               'email'=>$request['email'],
               'id_tipo_usuario'=>$request['id_tipo_usuario']
             ];            
        if(isset($request['password_prev']))
        {
            $co = User::select('id')->where('id','=',$request['id']);
            $c = $co->where('password','=',$request['password_prev']);
            $coinciden = $c->get();
            if(isset($coinciden))
            {
                if(isset($request['password']))
                {
                     array_push($u ,'password' => Hash::make($request['password']));                     
                }
            }
            else
            {
                return back()->with('error','La contraseña previa es incorrecta');
            }    
         }  */   
        $us = User::find($request['id']);
        $us->update($request->all());
        return redirect('abmlUsuarios')->with('success','Usuario actualizado con éxito');
     }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logic_delete($id)
    {
        $us = User::find($id);
        if($us)
        {
           $us->estado = 'inactivo';
           $us->save(); 
           return back()->with('success','Usuario eliminado con éxito.');
        }
        else
        {
           return back()->with('error','Usuario no encontrado');
        }    
    }
}
