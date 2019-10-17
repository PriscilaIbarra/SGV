<?php

namespace Cinema\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Cinema\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cinema\TiposCargo;
use Cinema\Asignatura;
use Cinema\Vacante;
use Cinema\Departamento;
use Carbon\Carbon;
use Cinema\User;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   // usar ORM 
        $vac = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
            ->join('tipos_cargos','vacantes.id_tipo_cargo','=','tipos_cargos.id')
            ->join('departamentos','vacantes.id_departamento','=','departamentos.id')
            ->select(['vacantes.id  as id','vacantes.fecha_apertura as fecha_apertura','vacantes.fecha_cierre as fecha_cierre','vacantes.requisitos as requisitos','vacantes.adicionales as adicionales','vacantes.presentacion as presentacion','vacantes.horario as horario','vacantes.estado as estado','vacantes.created_at as created_at','vacantes.updated_at as updated_at','vacantes.id_asignatura as id_asignatura','vacantes.id_tipo_cargo as id_tipo_cargo','vacantes.id_departamento as id_departamento','asignaturas.descripcion as asignatura_desc','tipos_cargos.descripcion as tipo_cargo_des','departamentos.descripcion as depto_desc'])->where('vacantes.id_usuario','=',Auth::user()->id);
        $vacan = $vac->whereNull('vacantes.deleted_at');
        $vacantes = $vacan ->get();
        return view('Administrador.abmlVacantes',compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asignaturas = Asignatura::all()->where('deleted_at',null);
        $departamentos = Departamento::all();
        $tipos_cargos = TiposCargo::all()->where('estado','activo');
        if(isset($asignaturas) && isset($departamentos) && isset($tipos_cargos))
        {
           return view('Administrador.altaVacante',compact('asignaturas','tipos_cargos','departamentos'));
        } 
        else
        {
            return back()->with('error','Alguno de los datos requeridos para procesar la operación no se encuentra disponible.');
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
     // #TODO FIND AND SET ARGENTINA TIME ZONE USING CARBON    
     $current_date = Carbon::now()->format('Y-m-d');

     $rules = [
                'id_asignatura' => ['required'],
                'id_tipo_cargo' => ['required'],
                'id_departamento' => ['required'],
                'fechaApertura' => ['required','date','after_or_equal:'.$current_date],
                'fechaCierre' => ['required','date','after_or_equal:'.$request['fechaApertura']],
                'horario' => ['required', 'string', 'max:255'],
                'requisitos' => ['required', 'string'],
                'adicionales' => ['required', 'string'],
                'presentacion' => ['required', 'string'],             
              ];   

      $messages = [
                    'id_asignatura.required'=>'Seleccione materia.',
                    'id_tipo_cargo.required'=>'Seleccione un tipo de cargo.',
                    'fechaApertura.required'=>'Ingrese fecha de apertura.',
                   // 'fechaApertura.after_or_equal'=>'La fecha de apertura debe ser mayor o igual a la fecha actual',
                    'fechaCierre.required'=>'Ingrese fecha de cierre.',
                    'fechaCierre.after_or_equal'=>'La fecha de cierre de debe ser mayor o igual a la de apertura.',
                    'horario.required'=>'Ingrese su disponibilidad horaria.',    
                    'horario.max'=>'La cantidad de caracteres ingresada supera la permitida',                 
                    'requisitos.required'=>'Complete el campo requerido.',
                    'adicionales.required'=>'Complete el campo requerido.',
                    'presentacion.required'=>'Complete el campo requerido.',
                  ];

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $va = new Vacante();
        $va->id_asignatura = $request['id_asignatura']; 
        $va->id_tipo_cargo = $request['id_tipo_cargo'];
        $va->id_departamento = $request['id_departamento'];
        $va->fecha_apertura = Carbon::parse($request['fechaApertura'])->format('Y-m-d');
        $va->fecha_cierre = Carbon::parse($request['fechaCierre'])->format('Y-m-d');
        $va->horario = $request['horario'];
        $va->requisitos = $request['requisitos'];
        $va->adicionales = $request['adicionales'];
        $va->presentacion = $request['presentacion'];
        $va->id_usuario = Auth::user()->id;
        $va->save(); 
        return redirect('abmlVacantes')->with('success','Vacante agregada con éxito.');
     }
     else
     {
        return redirect('abmlVacantes')->with('error','Error.No se ha podido registrar vacante.');
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
        $vac = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
            ->join('tipos_cargos','vacantes.id_tipo_cargo','=','tipos_cargos.id')
            ->join('departamentos','vacantes.id_departamento','=','departamentos.id')
            ->select(['vacantes.id  as id','vacantes.fecha_apertura as fecha_apertura','vacantes.fecha_cierre as fecha_cierre','vacantes.requisitos as requisitos','vacantes.adicionales as adicionales','vacantes.presentacion as presentacion','vacantes.horario as horario','vacantes.estado as estado','vacantes.created_at as created_at','vacantes.updated_at as updated_at','vacantes.id_asignatura as id_asignatura','vacantes.id_tipo_cargo as id_tipo_cargo','vacantes.id_departamento as id_departamento','asignaturas.descripcion as asignatura_desc','tipos_cargos.descripcion as tipo_cargo_des','departamentos.descripcion as depto_desc'])->where('vacantes.id_usuario','=',Auth::user()->id);
        $va = $vac->where('vacantes.id','=',$id);   
        $vacan = $va->get();
        $vacante = $vacan[0]; 
        $asignaturas = Asignatura::all()->where('deleted_at',null);
        $departamentos = Departamento::all();
        $tipos_cargos = TiposCargo::all()->where('estado','activo');
       
        if(isset($vacante) && isset( $asignaturas) && isset($departamentos) && isset($tipos_cargos))
        {
          return view('Administrador.editarVacante',compact('vacante','asignaturas','departamentos','tipos_cargos'));
        }
        else
        {
          return back()->with('error','Error.Alguno de los datos requeridos para procesar la operación no se encuentra disponible.');
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
     
      $current_date = Carbon::now()->format('Y-m-d');
      $rules = [
                'id_asignatura' => ['required'],
                'id_tipo_cargo' => ['required'],
                'id_departamento' => ['required'],
                'fechaApertura' => ['required','date','after_or_equal:'.$current_date],
                'fechaCierre' => ['required','date','after_or_equal:'.$request['fechaApertura']],
                'horario' => ['required', 'string', 'max:255'],
                'requisitos' => ['required', 'string'],
                'adicionales' => ['required', 'string'],
                'presentacion' => ['required', 'string'],             
              ];   

      $messages = [
                    'id_asignatura.required'=>'Seleccione materia.',
                    'id_tipo_cargo.required'=>'Seleccione un tipo de cargo.',
                    'fechaApertura.required'=>'Ingrese fecha de apertura.',
                    'fechaApertura.after_or_equal'=>'La fecha de apertura debe ser mayor o igual a la fecha actual',
                    'fechaCierre.required'=>'Ingrese fecha de cierre.',
                    'fechaCierre.after_or_equal'=>'La fecha de cierre de debe ser mayor o igual a la de apertura.',
                    'horario.required'=>'Ingrese su disponibilidad horaria.',    
                    'horario.max'=>'La cantidad de caracteres ingresada supera la permitida',                 
                    'requisitos.required'=>'Complete el campo requerido.',
                    'adicionales.required'=>'Complete el campo requerido.',
                    'presentacion.required'=>'Complete el campo requerido.',
                  ];

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $va = Vacante::find($request['id']);
        if(isset($va))
        {   
            $va->id_asignatura = $request['id_asignatura']; 
            $va->id_tipo_cargo = $request['id_tipo_cargo'];
            $va->id_departamento = $request['id_departamento'];
            $va->fecha_apertura = Carbon::parse($request['fechaApertura'])->format('Y-m-d');
            $va->fecha_cierre = Carbon::parse($request['fechaCierre'])->format('Y-m-d');
            $va->horario = $request['horario'];
            $va->requisitos = $request['requisitos'];
            $va->adicionales = $request['adicionales'];
            $va->presentacion = $request['presentacion'];
            $va->update(); 
            return redirect('abmlVacantes')->with('success','Vacante modificada con éxito.');
        }
        else
        {
            return redirect('abmlVacantes')->with('error','Vacante no encontrada.');
        }    
     }
     else
     {
        return redirect('abmlVacantes')->with('error','Error.No se ha podido actualizar la vacante.');
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
        $vac = Vacante::find($id);
        if($id)
        {
           if(isset($id->deleted_at))
           {
             $vac->deleted_at = null;
           }
           else
           {
            $vac->deleted_at =  date('Y-m-d H:i:s');
           }
           
           $vac->save(); 
           return back()->with('success','Vacante eliminada con exito.');
        }
        else
        {
           return back()->with('error','Vacante no encontrada');
        }
    } 

    public function getVacantesByAsig($id_asig)
    {
      //recuperar vacantes disponibles a las cuales el usuario no se encuentra inscripto      

        $query = User::join('inscripciones','users.id','=','inscripciones.id')
                      ->join('vacantes','vacantes.id','=','inscripciones.id_vacante')
                      ->select(['vacantes.id'])
                      ->where('users.id','=', Auth::user()->id)->get();  
        $vac = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
                       ->join('tipos_cargos','tipos_cargos.id','=','vacantes.id_tipo_cargo')
                       ->join('departamentos','departamentos.id','=','vacantes.id_departamento')
                       ->select(
                               [
                                'vacantes.id','vacantes.fecha_apertura','vacantes.fecha_cierre',
                                'vacantes.requisitos','vacantes.adicionales','vacantes.presentacion',
                                'vacantes.horario','vacantes.id_asignatura','asignaturas.descripcion as desc_asig',
                                'vacantes.id_tipo_cargo','tipos_cargos.descripcion as desc_tipo_cargo'
                               ]
                        )
                        ->whereNull('vacantes.deleted_at')
                        ->whereNull('asignaturas.deleted_at')
                        ->where('vacantes.fecha_apertura','<=',date('Y-m-d'))
                        ->where('vacantes.fecha_cierre','>=',date('Y-m-d'))
                        ->where('departamentos.descripcion','LIKE','Ingenieria en sistemas de Información')
                        ->where('vacantes.id_asignatura','=',$id_asig)
                        ->whereNotIn('vacantes.id',$query);               
        $vacan = $vac->get();
        $vacantes  = $vacan;                 
        return view('Usuario.vacantesDeUnaMateria',compact('vacantes'));
    }

    public function getVacantesOfAsig($id_asig)
    {   
        //recupera vacantes vigentes de una materia para el perfíl público
        $vac = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
                      ->join('tipos_cargos','tipos_cargos.id','=','vacantes.id_tipo_cargo')
                      ->join('departamentos','departamentos.id','=','vacantes.id_departamento')
                      ->select(
                               [
                                'vacantes.id','vacantes.fecha_apertura','vacantes.fecha_cierre',
                                'vacantes.requisitos','vacantes.adicionales','vacantes.presentacion',
                                'vacantes.horario','vacantes.id_asignatura','asignaturas.descripcion as desc_asig',
                                'vacantes.id_tipo_cargo','tipos_cargos.descripcion as desc_tipo_cargo'
                               ]
                        )
                        ->whereNull('vacantes.deleted_at')
                        ->whereNull('asignaturas.deleted_at')
                        ->where('vacantes.fecha_apertura','<=',date('Y-m-d'))
                        ->where('vacantes.fecha_cierre','>=',date('Y-m-d'))
                        ->where('departamentos.descripcion','LIKE','Ingenieria en sistemas de Información')
                        ->where('vacantes.id_asignatura','=',$id_asig);

        $vacantes = $vac->get();                
        return view('listadoVacantes',compact('vacantes'));
    }   

}
