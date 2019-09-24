<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\TipoCargo;

class TiposCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoCargo::all();
        $tiposCargo = $tipos->get(); //importante asignar el resultado final a otra variable distinta antes de convertirlo a json con compact, caso contrario se crashea el navegador
        return view('Administrador.abmlTipoCargo',compact('tiposCargo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          ];
        
        $messages = [ 'nombre.regex'=>'Formato de nombre incorrecto',
          'nombre.required'=>'Complete el campo requerido',
          'nombre.max'=>'La longitud del nombre supera el máximo requerido',
        ];  
        
        $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $tip = new TipoCargo();
        $tip->nombre = trim($request['nombre']);
        $tip->save(); 
        return redirect('abmlTipoCargo')->with('success','TipoCargo registrado con éxito');
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
        $tip = TipoCargo::find($id);

        if(isset($tip))
        {
          return view('Administrador.editarTipoCargo',compact('tip'));  
        }
        else
        {
          return back()->with('error','TipoCargo no encontrado.');
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $Tip = TipoCargo::select('id')->where('id','=',$request['id']);
      $idTip = $Tip->where('email','=',$request['email'])->get();
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
        $tip = TipoCargo::find($id);
        if(isset($tip))
        {
           $tip->estado = 'inactivo';
           $tip->save(); 
           return back()->with('success','TipoCargo eliminado con éxito.');
        }
        else
        {
           return back()->with('error','TipoCargo no encontrado');
        }    
    }
}
