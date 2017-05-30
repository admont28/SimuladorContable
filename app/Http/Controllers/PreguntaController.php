<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pregunta;
use App\RespuestaMultipleUnica;
use App\Curso;
use App\Taller;
use Yajra\Datatables\Datatables;
use Validator;
use Redirect;
use DateTime;

class PreguntaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que el taller no tenga respuestas de usuarios, debido a que estos quedarían sin respuestas a las nuevas preguntas.
        if ($taller->usuariosPorTaller()->isNotEmpty()) {
            flash('No se pueden adicionar más preguntas al taller porque ya existen respuestas almacenadas de usuarios.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $posiblesOpciones = Pregunta::getPossibleEnumValues();
        $taller = Taller::find($tall_id);
        return View('profesor.curso.taller.pregunta.crear_pregunta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('opciones', $posiblesOpciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que el taller no tenga respuestas de usuarios, debido a que estos quedarían sin respuestas a las nuevas preguntas.
        if ($taller->usuariosPorTaller()->isNotEmpty()) {
            flash('No se pueden adicionar más preguntas al taller porque ya existen respuestas almacenadas de usuarios.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo preg_tipo de tipo enum.
        $opciones = Pregunta::getPossibleEnumValues();
        $opcionesSeparadasPorComas = implode(",", $opciones);
        $validator = Validator::make($request->all(), [
            'texto_pregunta' => 'required|max:500|min:5',
            'tipo_pregunta' => 'required|in:'.$opcionesSeparadasPorComas,
            'porcentaje_pregunta'=>'required|integer|min:1|max:100'
        ])->validate();
        $porcentajePreguntaNueva = $request['porcentaje_pregunta']/100;
        $total = $taller->totalPorcentajePreguntas();
        $totalPorcentajes = $total + $porcentajePreguntaNueva;
        if ($totalPorcentajes > 1) {
            $validator = Validator::make(array(), array());
            $validator->getMessageBag()->add('porcentaje_pregunta', 'El porcentaje de la pregunta sumado a los otros porcentajes de las otras preguntas superan el 100%. Total porcentajes: '.($totalPorcentajes * 100).'%');
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // Almaceno en bd la nueva pregunta
        Pregunta::create([
            'preg_texto'=> $request['texto_pregunta'],
            'preg_tipo'=> $request['tipo_pregunta'],
            'preg_porcentaje'=> $request['porcentaje_pregunta']/100,
            'tall_id'=>$tall_id
        ]);
        flash('Pregunta "'.$request['texto_pregunta'].'" creada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        return view('profesor.curso.taller.pregunta.ver_pregunta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $posiblesOpciones = Pregunta::getPossibleEnumValues();
        // Retornamos la vista para editr la pregunta,
        // y le enviamos el modelo pregunta y taller  para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.taller.pregunta.editar_pregunta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta)
                    ->with('opciones', $posiblesOpciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        Validator::make($request->all(), [
            'texto_pregunta' => 'required|max:500|min:5',
            'porcentaje_pregunta'=>'required|integer|min:1|max:100'
        ])->validate();
        $porcentajePreguntaEditada = $request['porcentaje_pregunta']/100;
        $total = $taller->totalPorcentajePreguntas();
        $totalPorcentajes = $total + $porcentajePreguntaEditada - $pregunta->preg_porcentaje;
        if ($totalPorcentajes > 1) {
            $validator = Validator::make(array(), array());
            $validator->getMessageBag()->add('porcentaje_pregunta', 'El porcentaje de la pregunta sumado a los otros porcentajes de las otras preguntas superan el 100%. Total porcentajes: '.($totalPorcentajes * 100).'%');
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $pregunta->preg_texto = $request->input('texto_pregunta');
        $pregunta->preg_porcentaje = $request->input('porcentaje_pregunta')/100;
        $pregunta->save();
        flash('La pregunta "'.substr($pregunta->preg_texto, 0, 80).'..." ha sido editada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id, 'tall_id'=> $tall_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        if($pregunta->preg_tipo == 'unica-multiple' && ! $pregunta->respuestasMultiplesUnicas->isEmpty()){
            flash('Pregunta: "'.substr($pregunta->preg_texto,0,80).'..." no puede ser eliminada, debido a que posee respuestas asociadas.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        if($pregunta->respuestas->isNotEmpty()){
            flash('Pregunta: "'.substr($pregunta->preg_texto,0,80).'..." no puede ser eliminada, debido a que posee respuestas de estudiantes.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        $pregunta->delete();
        flash('Pregunta: "'.substr($pregunta->preg_texto,0,80).'..." eliminada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);

    }

    public function verRespuestasPorPregunta($curs_id, $tall_id, $preg_id)
    {
        $pregunta = Pregunta::find($preg_id);
        $respuestas = $pregunta->respuestasMultiplesUnicas;
        return Datatables::of($respuestas)
            ->addColumn('opciones', function ($respuesta) {
                $method_field = method_field('DELETE');
                $csrf_field = csrf_field();
                return
                    '<a href="'.route('profesor.curso.taller.pregunta.respuesta.editar', ['curs_id'=>$respuesta->pregunta->taller->curs_id,'tall_id' => $respuesta->pregunta->taller->tall_id,'preg_id'=>$respuesta->pregunta->preg_id, 'remu_id' => $respuesta->remu_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <form action="'.route('profesor.curso.taller.pregunta.respuesta.eliminar', ['curs_id'=>$respuesta->pregunta->taller->curs_id,'tall_id' => $respuesta->pregunta->taller->tall_id,'preg_id'=>$respuesta->pregunta->preg_id, 'remu_id' => $respuesta->remu_id]).'" method="POST" class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block">
                        '.$method_field.'
                        '.$csrf_field.'
                        <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                    </form>';
            })
            ->editColumn('remu_correcta', '@if($remu_correcta == 1) <span class="label label-success">SI</span> @else <span class="label label-danger">NO</span> @endif')
            ->rawColumns(['opciones','remu_correcta'])
            ->make(true);
    }

    /**
     * Esta función permite que el estudiante vea las respuesta de una pregunta unica-multiple.
     * @param  int $curs_id Es la llave foranea entre curso y pregunta.
     * @param  int $tall_id Es la llave foranea entre taller y curso.
     * @return  View(ver_preguntas) Retorna la vista de ver_preguntas con el curso,taller y pregunta respectivamente
     */
    public function verPreguntasPorTaller($curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso');
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el taller exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller) || $taller->curs_id != $curso->curs_id) {
            flash('El taller con ID: '.$tall_id.' no pertenece al curso seleccionado. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso');
        }
        //verificamos que el taller sea un taller de tipo diagnóstico o teórico
        if ( ! ($taller->tall_tipo == "diagnostico" ||  $taller->tall_tipo == "teorico") ) {
            flash('El taller con ID: '.$tall_id.' no es un taller de tipo diagnóstico o teórico. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso');
        }
        //verificamos que el taller contenga preguntas
        if ($taller->preguntas->isEmpty()) {
            flash('El taller con ID: '.$tall_id.' no posee preguntas. Verifique por favor.')->error();
            return $this->redireccionarSegunTipoTaller($taller, $curso);
        }
        $fechaActual = new DateTime();
        $fechaTaller = new DateTime($taller->tall_tiempo);
        if($fechaActual > $fechaTaller){
            flash('El taller ha expirado, no se han podido guardar las respuestas.')->error();
            return $this->redireccionarSegunTipoTaller($taller, $curso);
        }
        $preguntas = $taller->preguntas;
        foreach ($preguntas as $p ) {
            if($p->preg_tipo == "unica-multiple" && $p->respuestasMultiplesUnicas->isEmpty()){
                flash('El taller posee preguntas de tipo unica-multiple y estas no poseen opciones de respuesta, Por favor contacte a su profesor.')->error();
                return $this->redireccionarSegunTipoTaller($taller, $curso);
            }
        }
        $intentoTaller = DB::table('IntentoTaller')->select('inta_cantidad', 'inta_id')->where('usua_id', Auth::user()->id)->where('tall_id', $taller->tall_id)->first();
        if(!isset($intentoTaller)){
            DB::table('IntentoTaller')->insert([
                'inta_cantidad' => 1,
                'usua_id' => Auth::user()->id,
                'tall_id' => $taller->tall_id
            ]);
        }else{
            $intentos = $intentoTaller->inta_cantidad + 1;
            if($intentos >= 3){
                flash('Ha superado el número de intentos permitidos para este taller.')->error();
                return $this->redireccionarSegunTipoTaller($taller, $curso);
            }else{
                DB::table('IntentoTaller')->where('inta_id', $intentoTaller->inta_id)->increment('inta_cantidad');
            }
        }
        return view('estudiante.curso.taller.pregunta.ver_preguntas')
                    ->with('curso', $curso)
                    ->with('taller',$taller)
                    ->with('preguntas', $preguntas);
    }

    private function redireccionarSegunTipoTaller($taller, $curso)
    {
        if($taller->tall_tipo == "diagnostico"){
            return redirect()->route('estudiante.curso.ver.talleresdiagnostico',['curs_id'=>$curso->curs_id]);
        }
        elseif($taller->tall_tipo == "teorico")
            return redirect()->route('estudiante.curso.ver.talleresteorico',['curs_id'=>$curso->curs_id]);
        else {
            return redirect()->route('estudiante.curso');
        }
    }

}
