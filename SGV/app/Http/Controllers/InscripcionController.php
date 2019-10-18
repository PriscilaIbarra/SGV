<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Novedad;
use Cinema\Vacante;
use Cinema\Inscripcion;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_vacante)
    {
        $novedades = Novedad::select('id','descripcion')->where('estado','=','activo')->get();
        $vacan = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
                          ->join('tipos_cargos','vacantes.id_tipo_cargo','=','tipos_cargos.id')
                          ->join('departamentos','vacantes.id_departamento','=','departamentos.id')
                          ->where('departamentos.descripcion','LIKE','Ingenieria en Sistemas de Información')
                          ->where('vacantes.id','=',$id_vacante)
                          ->select('vacantes.id','asignaturas.descripcion as asig_desc','tipos_cargos.descripcion as desc_tipo_cargo')->get();
        $vacante = $vacan[0];     
        if(isset($novedades) && isset($vacante))
        {
          return view('Usuario.inscripcionVacante', compact('novedades','vacante'));    
        }
        else
        {
          return back()->with('error','Error al generar formulario de Inscripción'); 
        }    
        
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
            'dni' => ['required', 'numeric', 'max:255'],
            'tel' => ['required','numeric','phone_number'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cv'=>['required'],
          ];   

  $messages = [ 'nombre.regex'=>'Formato de nombre incorrecto',
                'nombre.required'=>'Complete el campo requerido',
                'nombre.max'=>'La longitud del nombre supera el máximo requerido',
                'apellido.regex'=>'Formato de apellido incorrecto',
                'apellido.required'=>'Complete el campo requerido',
                'apellido.max'=>'La longitud del apellido supera el máximo requerido',
                'dni.numeric'=>'Formato de dni invalido',
                'dni.required'=>'Complete el campo requerido',
                'dni.max'=>'La longitud del dni supera el maximo requerido',
                'tel.required'=>'Complete el campo requerido',
                'tel.numeric'=>'Formato de telefono incorrecto',
                'tel.phone_number'=>'Formato de telefono incorrecto',
                'cv.required'=>'Adjunte su cv',

              ];          
 $validacion = $this->validate($request,$rules,$messages);
 
 if($validacion)
 {
    $ins = new Inscripcion();
    $ins->id_vacante = trim($request['id_vacante']); 
    $ins->id_usuario = Auth::user()->id;
    $ins->dni = trim($request['dni']);
    $us->password = Hash::make(trim($request['password']));
    $us->id_tipo_usuario= trim($request['id_tipo_usuario']);
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
        //
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
        //
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
}
