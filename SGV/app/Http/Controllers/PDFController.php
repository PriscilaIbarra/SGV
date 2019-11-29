<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Cinema\Inscripcion;
use Cinema\Vacante;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

     public function printVacante($idVacante)
    {
        $vacante= Vacante::find($idVacante);
        if(isset($vacante)){
            return view('Generico.vistaImpresionVacante',compact('vacante'));
        }
        else{
            $error = "No se pudo imprimir archivo";
            return view('Generico.mostrarPDF',compact('error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idInscripcion)
    {
      $inscripcion = Inscripcion::find($idInscripcion);
      if(isset($inscripcion))
      {
        $ruta = '..'.'/'.$inscripcion->cv;
        return Response::make(file_get_contents($ruta),200,[

                                                                    'Content-Type'=>'application/pdf',
                                                                    'Content-Disposition'=>'inline'
                                                                      ]
                 );
      } 
      else
      {
        $error = "Archivo no encontrado";
        return view('Generico.mostrarPDF',compact('error'));
      }   
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

    public function generarPDF(Request $request,$id_vacante)
    {
        $vacante= Vacante::find($id_vacante);
        if (isset($vacante)) 
        {
               //view()->share('vacante',$vacante);

           
                $pdf= PDF::loadView('JefeCatedra.constanciaOrdenMerito',$vacante);
                $fecha = date('d-m-Y H:mm:ss');
                $name="constanciaOrden";
                $extension=".pdf";
                $nameFile=$name.$extension;

                $ruta = "public/constancias".'/'.$nameFile;

                $pdf->save(public_path('../public/cvs'),$nameFile);

                return $pdf->download($nameFile);

            
            //return view('JefeCatedra.constanciaOrdenMerito');
        }

        else
        {
            return redirect(route('calificarOrdenMerito',$id_vacante))->with('error','Error al generar PDF');
        }
    }

}
