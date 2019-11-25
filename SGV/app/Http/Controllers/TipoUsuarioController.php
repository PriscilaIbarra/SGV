<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;
use Cinema\TiposUsuarios;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TiposUsuarios::where('deleted_at', '=',null)->get();
        return view('Administrador.abmlTiposUsuarios',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador.altaTiposUsuarios');
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
            'descripcion' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
          ];
        
        $messages = [ 'descripcion.regex'=>'Formato de descripcion incorrecto',
          'descripcion.required'=>'Complete el campo requerido',
          'descripcion.max'=>'La longitud del nombre supera el máximo requerido',
        ];  
        
        $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $tip = new TiposUsuarios();
        $tip->descripcion = $request['descripcion'];
        $tip->save(); 
        return redirect('abmlTiposUsuarios')->with('success','Tipo de Usuario registrado con éxito.');
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
        $tip = TiposUsuarios::find($id);

        if(isset($tip))
        {
          return view('Administrador.editarTiposUsuarios',compact('tip'));  
        }
        else
        {
          return back()->with('error','Tipo de Usuario no encontrado.');
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
      $rules = [
                'descripcion' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
               ];   

      $messages = [ 
                    'descripcion.regex'=>'Formato de tipo cargo incorrecto',
                    'descripcion.required'=>'Complete el campo requerido',
                    'descripcion.max'=>'La longitud del tipo de cargo supera el máximo requerido',
                  
                  ];          

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $tipo = TiposUsuarios::find($request['id']);
        if(isset($tipo))
        {
          $tipo->descripcion = $request['descripcion'];
          $tipo->update();
          return redirect('abmlTiposUsuarios')->with('success','Tipo de Usuario actualizado con éxito.');
        }
        else
        {           
          return redirect('abmlTiposUsuarios')->with('error','Tipo de Usuario no encontrado.'); 
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
        $tip = TiposUsuarios::find($id);
        if($tip)
        {
           if(isset($tip->deleted_at))
           {
             $tip->deleted_at = null;
           }
           else
           {
            $tip->deleted_at =  date('Y-m-d H:i:s');
           }
           
           $tip->save(); 
           return back()->with('success','Tipo de usuario eliminado con éxito.');
        }
        else
        {
           return back()->with('error','Tipo de Usuario no encontrado.');
        }    
    }

    public static function GetIdOfTipoUsuario()
    {
        $id = TipoUsuario::where('descripcion','Usuario')->id;
        return view('register',compact('id'));
    }
}
