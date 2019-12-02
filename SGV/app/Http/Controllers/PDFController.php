<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Cinema\Inscripcion;
use Cinema\Vacante;
//use NahidulHasan\Html2pdf\Facades\Pdf;
use App;
//use Barryvdh\DomPDF\Facade as PDF;
use NahidulHasan\Html2pdf\Pdf;
use Illuminate\Support\Facades\File;
use View;
use Illuminate\Support\Facades\Auth;
use Cinema\Constancia;
use Cinema\ConstanciaController;
use Illuminate\Database\QueryException;

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
        
    }

    public function generarPDF(Request $request,$id_vacante)
    { //https://github.com/nahidulhasan/laravel-pdf
        $vacante= Vacante::find($id_vacante);
        if (isset($vacante)) 
        {
                $obj = new Pdf();
               
                $html=$this->htmlString($vacante);    
                $invoice = $obj->generatePdf($html);

                define('INVOICE_DIR', public_path('constancias'));

                if (!is_dir(INVOICE_DIR)) {
                    mkdir(INVOICE_DIR, 0755, true);
                }

                $outputName = 'constancia_vacante_'.$vacante->id.'_'.date('d-m-Y H:mm:ss').'_';
                $pdfPath = INVOICE_DIR.'/'.$outputName.'.pdf';


                File::put($pdfPath, $invoice);

                $headers = [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' =>  'attachment; filename="'.'filename.pdf'.'"',
                ];
                try
                {
                    $constancia = new Contancia();
                    $constancia->ruta = $pdfPath;
                    $contancia->id_orden = $vacante->orden->id;
                    $constancia->save();
                    return response()->download($pdfPath, $outputName.'.pdf', $headers);
                }
                catch(QueryException $e)
                {
                    return redirect(route('homeJefeCatedra'))->with('error','Error al generar constancia');
                }
                
        }

        else
        {
            return redirect(route('calificarOrdenMerito',$id_vacante))->with('error','Error al generar PDF');
        }
    }

    public function htmlString($vacante)
    {
         $html='';
         $html='<!DOCTYPE html>
        <html>
        <head>
            <title></title>'.
              '<meta charset='.'"'.'utf8'.'"'.'>'.
        '</head>
        <body>'.
            '<style type="text/css">
                .container{
                    width:100%;
                    border:1px solid black;
                    min-height:850px;

                }
                .row{
                    width:95%;
                    display: inline-block;          

                }
                .col{
                    width:30%;
                    height:180px;
                    border-color: black;
                    text-align: left;
                    float: left;
                    margin-left: 3%;
                }
                .col-min{
                    width:32%;
                    font-size:12px;
                }

                .col-content{
                    text-align:center;
                }
                .table
                {
                    margin-right:20px;
                    width: inherit;
                    color:black;
                }
            </style>'.
            '<div class="container">

                <div class="row">
                        <div class="col">
                            <div style="text-align:center;">
                                    <img style='.'"'.'height:80px;width:80px;margin-top:10px;'.'"'.' src='.'"'.'../public/imagenes/logo.png'.'"'.'>'.
                                    '<h4>Universidad Tecnologica Nacional</h4>
                                      <h5 style="margin-top:-9px;">Facultad Regional Rosario</h5>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        <div class="col">
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h4>
                            <u><strong>Vacante:</strong></u>
                        </h4>'.
                        '<label><strong>Id:</strong>'.'  '.$vacante->id.'</label>'.
                        '<br>'.
                        '<label><strong>Asignatura:</strong>'.'  '.'<br>'.$vacante->asignatura->descripcion.'</label>'.
                        '<br>'.
                        '<label><strong>Tipo de cargo:</strong>'.'  '.'<br>'.$vacante->tipo_cargo->descripcion.'</label>'.
                        '<br>'.
                    '</div>'.
                    '<div class="col">'.
                        '<h4><u><strong>Orden:</u></strong></h4>'.
                        '<label><strong>Id:</strong>'.'  '.$vacante->orden->id.'</label>'.
                        '<br>'.
                        '<label><strong>Fecha creación:</strong>'.'<br>'.$vacante->orden->created_at->format('d-m-Y H:m:s').'<br>'.'</label>'.
                        '<br>'.
                        '<label><strong> Fecha generación constancia:</strong>'.'<br>'.$vacante->orden->updated_at->format('d-m-Y H:m:s').'<br>'.'</label>'.

                    '</div>'.
                    '<div class="col">'.
                        '<h4><u><strong>Jefe de Cátedra:</u></strong></h4>'.
                        '<label><strong>Apellido:</strong>'.'  '.Auth::user()->apellido.'</label>'.
                        '<br>'.
                        '<label><strong>Nombre:</strong>'.'  '.Auth::user()->nombre.'</label>'.
                    '</div>'.
                '</div>
                <hr>
                <center>
                    <h5>ORDEN DE MÉRITO</h5>
                </center>
                <hr>
                <center>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-min">Orden</th>
                                <th class="col-min" style="text-indent:35px;">Apellido y Nombre</th>
                                <th class="col-min">DNI</th>
                                <th class="col-min" style="text-indent:-15px;">Puntaje</th>
                            </tr>
                        </thead>
                        <tbody>';            
                        for($c=0;$c<count($vacante->inscripciones);$c++) 
                        {
                            $pos = $c +1;
                        $html.='<tr>'.
                                '<td class="col-min col-content">'.$pos.'</td>'.
                                '<td class="col-min col-content">'.$vacante->inscripciones[$c]->user->apellido .','.$vacante->inscripciones[$c]->user->nombre.'</td>'.
                                '<td class="col-min col-content">'.$vacante->inscripciones[$c]->user->dni.'</td>'.
                                '<td class="col-min col-content" >'.$vacante->inscripciones[$c]->calificacion.'</td>'.
                            '</tr>';
                        }
                       $html.='</tbody>                
                    </table>
                </center>
                <br>
                <div class="row" style="position: absolute;bottom:0;">
                    <center>
                            <sup>Fecha:'.'  '.date('d-m-Y H:mm:ss').'</sup>
                            <br>
                            <br>
                    </center>
                </div>
            </div>  
        </body>
        </html>';
         return $html;
    }



}
