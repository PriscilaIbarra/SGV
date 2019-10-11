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
        $nov->descripcion = trim($request['descripcion']);
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
        $nov = Novedad::select('id')->where('id','=',$request['id']);
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
        $nov = Novedad::find($request['id']);
        $nov->descripcion = $request['descripcion'];
        $nov->update();
        return redirect('abmlNovedades')->with('success','Novedad actualizada con éxito.');
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
        $nov = Novedad::find($id);
        if(isset($nov))
        {
            if($nov->estado=='inactivo')
            {
                $nov->estado = 'activo';
                $nov->save();
                return back()->with('success','Novedad habilitada con éxito.');
            }
            else{
                $nov->estado = 'inactivo';
                $nov->save();
                return back()->with('success','Novedad deshabilitada con éxito.');
            }                    
           
        }
        else
        {
           return back()->with('error','Novedad no encontrada.');
        }    
    }
}
