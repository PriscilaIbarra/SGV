<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Novedad;

class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $novedades = Novedad::all();
        return view('Administrador.abmlNovedades',compact('novedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador.altaNovedades');
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
            'descripcion' => ['required','string', 'max:255'],
          ];
        
        $messages = [ 'descripcion.string'=>'Formato de descripcion incorrecto',
          'descripcion.required'=>'Complete el campo requerido',
          'descripcion.max'=>'La longitud de la descripcion supera el máximo requerido',
        ];  
        
        $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $nov = new Novedad();
        $nov->descripcion = $request['descripcion'];
        $nov->save(); 
        return redirect('abmlNovedades')->with('success','Novedad registrada con éxito.');
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
        $nov = Novedad::find($id);

        if(isset($nov))
        {
          return view('Administrador.editarNovedad',compact('nov'));  
        }
        else
        {
          return back()->with('error','Novedad no encontrada.');
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
                'descripcion' => ['required','string', 'max:255'],
               ];   

      $messages = [ 
                    'descripcion.string'=>'Formato de descripcion incorrecto.',
                    'descripcion.required'=>'Complete el campo requerido',
                    'descripcion.max'=>'La longitud de la descripción supera el máximo requerido',
                  ];          

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $novedad = Novedad::find($request['id']);
        if(isset($novedad))
        {
             $novedad->descripcion = $request['descripcion'];
             $novedad->update();               
             return redirect('abmlNovedades')->with('success','Novedad actualizada con éxito.');
        }
        else
        {
           return redirect('abmlNovedades')->with('error','Error al actualizar novedad');
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
        $novedad = Novedad::find($id);
        if(isset($novedad))
        {
            if($novedad->estado=='inactivo')
            {
                $novedad->estado = 'activo';
                $novedad->save();
                return back()->with('success','Novedad habilitada con éxito.');
            }
            else{
                $novedad->estado = 'inactivo';
                $novedad->save();
                return back()->with('success','Novedad deshabilitada con éxito.');
            }                    
           
        }
        else
        {
           return back()->with('error','Novedad no encontrada.');
        }    
    }
}
