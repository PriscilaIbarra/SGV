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
        $usuarios = User::where('users.id', '!=', Auth::id())->get();
        return view('Administrador.abmlUsuarios',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposUsuarios = TiposUsuarios::all()->where('deleted_at',null);
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
                'dni' => ['required', 'regex:/^[0-9]+$/', 'digits:8'],
                'telefono'=>['required','regex:/^[0-9]+$/','max:255'],
                'id_tipo_usuario' => ['required','integer'],
              ];   

      $messages = [ 'nombre.regex'=>'Formato de nombre incorrecto',
                    'nombre.required'=>'Complete el campo requerido',
                    'nombre.max'=>'La longitud del nombre supera el máximo requerido',
                    'apellido.regex'=>'Formato de apellido incorrecto',
                    'apellido.required'=>'Complete el campo requerido',
                    'apellido.max'=>'La longitud del nombre supera el máximo requerido',
                    'dni.regex'=>'Formato de dni incorrecto',
                    'dni.required'=>'Complete el campo requerido',
                    'dni.digits'=>'El tamaño del dni es incorrecto',
                    'telefono.required'=>'Complete el campo requerido',
                    'telefono.regex'=>'Formato de telefono incorrecto',
                    'telefono.max'=>'La longitud del telefono supera el maximo requerido',
                    'email.required'=>'Complete el campo requerido',
                    'email.max'=>'La longitud del email supera el maximo requerido',
                    'email.string'=>'Formato de email incorrecto',
                    'email.email'=>'Formato de email incorrecto',
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
        $us->dni = $request['dni'];
        $us->telefono = $request['telefono'];
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
        
        $tiposUsuarios = TiposUsuarios::all()->where('deleted_at',null);

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
      $idUsuario = User::where('id','=',$request['id'])->where('email','=',$request['email'])->get()->first()->id;
      if(isset($idUsuario))
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
                'telefono'=>['required','regex:/^[0-9]+$/','max:255'],
                'id_tipo_usuario' => ['required','integer'],
               ];   

      $messages = [ 
                    'nombre.regex'=>'Formato de nombre incorrecto',
                    'nombre.required'=>'Complete el campo requerido',
                    'nombre.max'=>'La longitud del nombre supera el máximo requerido',
                    'apellido.regex'=>'Formato de apellido incorrecto',
                    'apellido.required'=>'Complete el campo requerido',
                    'apellido.max'=>'La longitud del nombre supera el máximo requerido',
                    'email.required'=>'Complete el campo requerido',
                    'email.max'=>'La longitud del email supera el maximo requerido',
                    'email.string'=>'Formato de email incorrecto',
                    'email.email'=>'Formato de email incorrecto',
                    'email.unique'=>'El email ingresado ya existe',
                    'telefono.required'=>'Complete el campo requerido',
                    'telefono.regex'=>'Formato de telefono incorrecto',
                    'telefono.max'=>'La longitud del telefono supera el maximo requerido',
                    'id_tipo_usuario.required'=>'Seleccine un tipo de usuario'
                  ];          

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $usuario = User::find($request['id']);
        if(isset($usuario))
        {
            $usuario->update($request->all());
            return redirect('abmlUsuarios')->with('success','Usuario actualizado con éxito');
        }
        else
        {
            return back()->with('error','Usuario no encontrado.');
        }      
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
           if(isset($us->deleted_at))
           {
             $us->deleted_at = null;
           }
           else
           {
            $us->deleted_at =  date('Y-m-d H:i:s');
           }
           
           $us->save(); 
           return back()->with('success','Estado de usuario modificado con éxito.');
        }
        else
        {
           return back()->with('error','Usuario no encontrado');
        }    
    }

   public function cambiarPassword ()
   {
        return view('cambiarPassword');
   }


   public function actualizarPassword(Request $request)
   {
      $rules = [
                'passwordActual' => ['required', 'string', 'min:8'],
                'passwordNuevo' => ['required', 'string', 'min:8'],
                'passwordConfirmar' => ['required', 'string', 'min:8', 'same:passwordNuevo'],                
              ];   

      $messages = [ 
                    'passwordActual.min'=>'La contraseña debe tener almenos 8 caracteres',
                    'passwordNuevo.min'=>'La contraseña debe tener almenos 8 caracteres',
                    'passwordConfirmar.min'=>'La contraseña debe tener almenos 8 caracteres',
                    'passwordConfirmar.same'=>'Las contraseñas no coinciden'
                    

                  ];          
     $validacion = $this->validate($request,$rules,$messages);
    if($validacion)
    {
       
        try
        {
             $user= User::where('password','=',Hash::make($request['passwordActual']))->firstOrFail();
             $user->password=Hash::make($request['passwordNuevo']);
             $user->save();
             return redirect(route('home'))->with('success','Contraseña actualizada con exito');
        }
        catch(Exception $e)
        {
            return redirect(route('changePassword'))->with('error','Error al actualizar la contraseña');
        }
    }


   }
}
