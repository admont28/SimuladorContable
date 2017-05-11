<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taller;
use App\TallerAsientoContable;
use App\TallerNomina;
use App\Curso;
use App\Pregunta;
use App\Respuesta;
use App\RespuestaAbierta;
use App\RespuestaArchivo;
use App\Tarifa;
use App\Calificacion;
use App\RespuestaTallerAsientoContable;
use App\RespuestaTallerNomina;
use App\FilaTallerNomina;
use App\DataTables\TallerDataTables;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Auth;
use Redirect;
use Storage;
use DateTime;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TallerDataTables $dataTable,$curs_id = "")
    {
        return $dataTable->render('profesor.curso.taller.index')->with('curs_id',$curs_id );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id = "")
    {
        $curso = Curso::find($curs_id);
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $posiblesOpciones = Taller::getPossibleEnumValues();
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        return View('profesor.curso.taller.crear_taller')->with('curso', $curso)->with('opciones', $posiblesOpciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso=Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller',['curs_id'=> $curso->curs_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $opciones = Taller::getPossibleEnumValues();
        $opcionesSeparadasPorComas = implode(",", $opciones);
        // Validamos los campos del formulario.
        Validator::make($request->all(), [
           'nombre_taller' => 'required|max:45',
           'tipo_taller' => 'required|in:'.$opcionesSeparadasPorComas,
           'tiempo_taller' => 'required|date_format:Y-m-d H:i:s',
           'taller_rutaarchivo' => 'required'
        ])->validate();
        //obtenemos el campo file definido en el formulario
        $file = $request->file('taller_rutaarchivo');
        //obtenemos el nombre del archivo
        $nombreArchivo = $file->getClientOriginalName();
        // Almaceno en el dicso talleres el archivo cargado por el usuario.
        $path = Storage::disk('talleres')->put('/', $file);
        // Almaceno en bd el nuevo taller.
        $taller = Taller::create([
            'tall_nombre' => $request['nombre_taller'],
            'tall_tipo' => $request['tipo_taller'],
            'tall_tiempo' => $request['tiempo_taller'],
            'tall_rutaarchivo' => asset('storage/talleres/'.$path),
            'tall_nombrearchivo' => $nombreArchivo,
            'curs_id' => $curs_id
        ]);
        Storage::disk('talleres')->makeDirectory($taller->tall_id);
        // Informo al usuario y redireccionamos.
        flash('El taller "'.$request['nombre_taller'].'" ha sido creado con éxito.', 'success');
        return redirect()->route('profesor.curso.ver',['curs_id'=> $curso->curs_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($curs_id, $tall_id)
    {
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
        }
        return View('profesor.curso.taller.ver_taller')
                    ->with('curso', $curso)
                    ->with('taller', $taller);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $posiblesOpciones = Taller::getPossibleEnumValues();
        // Retornamos la vista para editr el taller,
        // y le enviamos el modelo taller y curso para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.taller.editar_taller')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('opciones', $posiblesOpciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $opciones = Taller::getPossibleEnumValues();
        $opcionesSeparadasPorComas = implode(",", $opciones);
        // Validamos los campos del formulario.
        Validator::make($request->all(), [
           'nombre_taller' => 'required|max:45',
           'tipo_taller' => 'required|in:'.$opcionesSeparadasPorComas,
           'tiempo_taller' => 'required|date_format:Y-m-d H:i:s'
        ])->validate();
        //obtenemos el campo file definido en el formulario
        $file = $request->file('taller_rutaarchivo');
        // Si existe y no es nulo $file es porque el usuario seleccionó un archivo en el formulario.
        if(isset($file)){
            //obtenemos el nombre del archivo
            $nombreArchivo = $file->getClientOriginalName();
            // Obtengo más información del archivo de la materia. ver: http://php.net/manual/es/function.pathinfo.php
            $infoArchivo = pathinfo($taller->mate_rutaarchivo);
            $eliminacionArchivo = true;
            // Compruebo que exista el archivo en el disco de talleres.
            if(Storage::disk('talleres')->exists($infoArchivo['basename'])){
                // Si existe el archivo procedo a eliminarlo, retorna true si fue exitoso, de lo contrario retorna false.
                $eliminacionArchivo = Storage::disk('talleres')->delete($infoArchivo['basename']);
            }
            if($eliminacionArchivo){
                // Una vez eliminado el archivo, almaceno el nuevo archivo en el disco talleres
                $path = Storage::disk('talleres')->put('/', $file);
            }else {
                // Si no se pudo eliminar el archivo anterior, informo al usuario y redireccionamos.
                flash('No se pudo eliminar el archivo asociado al taller "'.$taller->mate_nombre.'"', 'danger');
                return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
            }
        }
        // Asignamos el nuevo nombre del taller, nuevo tipo y tiempo.
        $taller->tall_nombre = $request->input('nombre_taller');
        $taller->tall_tipo   = $request->input('tipo_taller');
        $taller->tall_tiempo = $request->input('tiempo_taller');
        // Si existe $path y $nombreArchivo es porque el usuario está cargando un nuevo archivo,
        // almaceno la nueva ruta y nombre del archivo en bd.
        if(isset($path,$nombreArchivo)){
            $taller->tall_rutaarchivo = asset('storage/talleres/'.$path);
            $taller->tall_nombrearchivo = $nombreArchivo;
        }
        // Guardo los cambios en el modelo.
        $taller->save();
        // Informo al usuairo y redireccionamos.
        flash('Taller "'.$taller->tall_nombre.'" editado con éxito.', 'success');
        return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($curs_id = "", $tall_id = "", $preg_id ="")
    {
        // Busco el taller a eliminar.
        $taller = Taller::find($tall_id);
        // Compruebo que exista el registro en la tabla de taller.
        if($taller)
        {
            $taller->delete();
            // Mensaje para el usuario indicando la eliminación exitosa.
            flash('taller "'.$taller->tall_nombre.'" eliminada con éxito.', 'success');
        }else{
            flash('No se pudo eliminar el archivo asociado al taller "'.$taller->taller_nombre.'"', 'danger');
        }
        // Cualquiera que sea el caso, de éxito o error es redirigido a la vista del curso.
        return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
    }

    public function crearTallerAsientosContablesPost(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que el taller no tenga asiganado ya un sub-tipo.
        $tallerAsientoContable = $taller->tallerAsientoContable;
        $tallerNomina = $taller->tallerNomina;
        if(isset($tallerAsientoContable) || isset($tallerNomina)){
            flash('El taller con ID: '.$tall_id.' ya tiene relacionado un sub-tipo. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $taller->tall_id]);
        }
        // Creo el taller de asiento contable en bd y lo relaciono con el taller que sería el padre
        TallerAsientoContable::create([
            'tall_id' => $taller->tall_id
        ]);
        // Informo al usuario y redireccionamos.
        flash('El taller "'.$taller->tall_nombre.'" ha sido marcado con el sub-tipo: "Taller Asientos Contables" con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curso->curs_id,'tall_id' => $taller->tall_id]);
    }

    public function crearTallerNomina($curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que el taller no tenga asiganado ya un sub-tipo.
        $tallerAsientoContable = $taller->tallerAsientoContable;
        $tallerNomina = $taller->tallerNomina;
        if(isset($tallerAsientoContable) || isset($tallerNomina)){
            flash('El taller con ID: '.$tall_id.' ya tiene relacionado un sub-tipo. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $taller->tall_id]);
        }
        return View('profesor.curso.taller.nomina.crear')
                ->with('curso', $curso)
                ->with('taller', $taller);
    }

    public function crearTallerNominaPost(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que el taller no tenga asiganado ya un sub-tipo.
        $tallerAsientoContable = $taller->tallerAsientoContable;
        $tallerNomina = $taller->tallerNomina;
        if(isset($tallerAsientoContable) || isset($tallerNomina)){
            flash('El taller con ID: '.$tall_id.' ya tiene relacionado un sub-tipo. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $taller->tall_id]);
        }
        // Validamos los campos del formulario.
        Validator::make($request->all(),[
            'deduccion_uno'   => 'string|nullable',
            'deduccion_dos'   => 'string|nullable',
            'deduccion_tres'  => 'string|nullable'
        ])->validate();
        // Creo el taller de nómina en bd y lo relaciono con el taller que sería el padre
        TallerNomina::create([
            'tano_deduccionuno'      => $request['deduccion_uno'],
            'tano_deducciondos'      => $request['deduccion_dos'],
            'tano_deducciontres'     => $request['deduccion_tres'],
            'tall_id'                => $taller->tall_id
        ]);
        // Informo al usuario y redireccionamos.
        flash('El taller "'.$taller->tall_nombre.'" ha sido marcado con el sub-tipo: "Taller de Nómina" con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curso->curs_id,'tall_id' => $taller->tall_id]);
    }

    /**
     * [verPreguntasPorTaller description]
     * @param  string $tall_id [description]
     * @return [type]          [description]
     */
    public function verPreguntasPorTaller($curs_id, $tall_id)
    {
        $taller = Taller::find($tall_id);
        $preguntas = $taller->preguntas;
        return Datatables::of($preguntas)
            ->addColumn('opciones', function ($pregunta) {
                $opcionAdicionarRespuesta = "";
                if($pregunta->preg_tipo == 'unica-multiple')
                {
                    $opcionAdicionarRespuesta = '<a href="'.route('profesor.curso.taller.pregunta.respuesta.crear',['curs_id'=>$pregunta->taller->curs_id,'tall_id' =>$pregunta->taller->tall_id,'preg_id'=>$pregunta->preg_id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Añadir respuesta</a>';
                }
                $method_field = method_field('DELETE');
                $csrf_field = csrf_field();
            return
                '<a href="'.route('profesor.curso.taller.pregunta.ver', ['curs_id'=>$pregunta->taller->curs_id,'tall_id' =>$pregunta->taller->tall_id,'preg_id'=>$pregunta->preg_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                '.$opcionAdicionarRespuesta.'
                <a href="'.route('profesor.curso.taller.pregunta.editar', ['curs_id'=>$pregunta->taller->curs_id,'tall_id' => $pregunta->taller->tall_id,'preg_id'=>$pregunta->preg_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <form action="'.route('profesor.curso.taller.pregunta.eliminar', ['curs_id'=>$pregunta->taller->curs_id,'tall_id' => $pregunta->taller->tall_id,'preg_id'=>$pregunta->preg_id]).'" method="POST" class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block">
                    '.$method_field.'
                    '.$csrf_field.'
                    <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                </form>';
            })
            ->editColumn('preg_tipo', '@if($preg_tipo == "unica-multiple") <span class="label label-info">{{ $preg_tipo }}</span> @elseif($preg_tipo == "abierta") <span class="label label-warning">{{ $preg_tipo }}</span> @else <span class="label label-default">{{ $preg_tipo }}</span> @endif')
            ->editColumn('preg_porcentaje','{{ $preg_porcentaje * 100 }}%')
            ->make(true);
    }

    public function verTarifasPorTaller($curs_id, $tall_id)
    {
        $taller = Taller::find($tall_id);
        $tarifas = $taller->tarifas;
        return Datatables::of($tarifas)
            ->addColumn('opciones', function ($tarifa) {
                $method_field = method_field('DELETE');
                $csrf_field = csrf_field();
                return
                    '<a href="'.route('profesor.curso.taller.tarifa.editar', ['curs_id'=>$tarifa->taller->curs_id,'tall_id' => $tarifa->taller->tall_id,'tari_id'=>$tarifa->tari_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <form action="'.route('profesor.curso.taller.tarifa.eliminar', ['curs_id'=>$tarifa->taller->curs_id,'tall_id' => $tarifa->taller->tall_id,'tari_if'=>$tarifa->tari_id]).'" method="POST" class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block">
                        '.$method_field.'
                        '.$csrf_field.'
                        <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                    </form>';
            })->make(true);
    }

    /**
     * Muestra
     * @param  string $tall_id [description]
     * @return [type]          [description]
     */
    public  function verPreguntasPorTallerEstudiante($tall_id)
    {
        $taller = Taller::find($tall_id);
        $preguntas = $taller->preguntas;
        return view('estudiante.curso.taller.respuesta.ver_preguntas')
            ->with('preguntas', $preguntas)
            ->with('taller', $taller)
            ->with('curso', $curso);
    }

    public function solucionarTallerDiagnosticoTeoricoPost(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('estudiante.curso');
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el taller exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller) || $taller->curs_id != $curso->curs_id) {
            flash('El taller con ID: '.$tall_id.' no pertenece al curso seleccionado. Verifique por favor.', 'danger');
            return redirect()->route('estudiante.curso');
        }
        //verificamos que el taller sea un taller de tipo diagnóstico o teórico
        if ( ! ($taller->tall_tipo == "diagnostico" ||  $taller->tall_tipo == "teorico") ) {
            flash('El taller con ID: '.$tall_id.' no es un taller de tipo diagnóstico o teórico. Verifique por favor.', 'danger');
            return redirect()->route('estudiante.curso');
        }
        //verificamos que el taller contenga preguntas
        if ($taller->preguntas->count() == 0) {
            flash('El taller con ID: '.$tall_id.' no posee preguntas. Verifique por favor.', 'danger');
            return $this->redireccionarSegunTipoTaller($taller, $curso);
        }
        $fechaActual = new DateTime();
        $fechaTaller = new DateTime($taller->tall_tiempo);
        if($fechaActual > $fechaTaller){
            flash('El taller ha expirado, no se han podido guardar las respuestas.', 'danger');
            return $this->redireccionarSegunTipoTaller($taller, $curso);
        }
        $preguntas = $taller->preguntas;
        $validaciones = array();
        $errores = array();
        foreach ($preguntas as $pregunta) {
            if ($pregunta->preg_tipo == "unica-multiple"){
                if ($pregunta->tieneRespuestaMultiple() == true){
                    // Pregunta de tipo Checkbox
                    $cantidadRespuestasCorrectas = $pregunta->cantidadRespuestasCorrectas();
                    $respuestasMultiplesUnicas = $pregunta->respuestasMultiplesUnicas;
                    $cantidadRespuestasEnSolicitud = 0;
                    foreach ($respuestasMultiplesUnicas as $respuesta ) {
                        if(array_key_exists('r_p_'.$pregunta->preg_id.'_o_'.$respuesta->remu_id, $request->all())){
                            $cantidadRespuestasEnSolicitud++;
                        }
                    }
                    if($cantidadRespuestasEnSolicitud != $cantidadRespuestasCorrectas){
                        // La cantidad de respuestas seleccionadas en el formulario es distinta de la cantidad de respuestas correctas que tiene la pregunta.
                        // Ej: la pregunta tiene 2 respuestas correctas de 5 en total, el usuario selecciona 3 respuestas, o 4, o 1, o las 5.
                        $errores['r_p_'.$pregunta->preg_id] = "La cantidad de respuetas seleccionadas es distinta de la cantidad de respuestas que debe seleccionar.";
                    }
                }else{
                    // Pregunta de tipo Radio Button
                    if(!array_key_exists('r_p_'.$pregunta->preg_id, $request->all())){
                        $errores['r_p_'.$pregunta->preg_id] = "Debe seleccionar una respuesta para esta pregunta.";
                    }
                }
            }elseif ($pregunta->preg_tipo == "abierta"){
                $validaciones['r_p_'.$pregunta->preg_id] = 'required|max:500';
            }elseif ($pregunta->preg_tipo == "archivo"){
                $validaciones['r_p_'.$pregunta->preg_id] = 'required';
            }
        }
        $messages = array(
            'required' => 'El campo es requerido.',
            'max' => 'El campo debe ser menor que :max caracteres.'
        );
        $validator = Validator::make($request->all(), $validaciones,$messages);
        DB::beginTransaction();
        try {
            if ($validator->fails() || !empty($errores))
            {
                // Adiciono a $validator los mensajes de error que se encuentren en $errores
                foreach ($errores as $llave => $valor) {
                    $validator->getMessageBag()->add($llave, $valor);
                }
                $intentoTaller = DB::table('IntentoTaller')->select('inta_cantidad', 'inta_id')->where('usua_id', Auth::user()->usua_id)->where('tall_id', $taller->tall_id)->first();
                // Decremento el valor de inta_cantidad porque al cargar la página de las preguntas, el controlador se encarga de incrementarlo, y si existen errores en el formulario, no debería contar como un intento de guardar las respuestas.
                DB::table('IntentoTaller')->where('inta_id', $intentoTaller->inta_id)->decrement('inta_cantidad');
                DB::commit();
                return Redirect::back()->withErrors($validator)->withInput();
            }
            // En este punto, todas las preguntas tienen respuestas, y no hay errores en el formulario.
            // Se procede a verificar cuales están correctas y cuales no.
            $errores = $this->verificarErroresEnRespuestas($preguntas, $request);
            $intentoTaller = DB::table('IntentoTaller')->select('inta_cantidad', 'inta_id')->where('usua_id', Auth::user()->usua_id)->where('tall_id', $taller->tall_id)->first();
            $intentos = $intentoTaller->inta_cantidad;
            if(!empty($errores)){
                // Si es el primer intento, aún no guardo las respuestas, le comunico que tiene errores y que envie de nuevo.
                if($intentos == 1){
                    foreach ($errores as $llave => $valor) {
                        $validator->getMessageBag()->add($llave, $valor);
                    }
                    flash('Usted tiene respuestas incorrectas, sus respuestas aún no se han guardado, por favor intente corregir las respuestas y enviar la solución del taller nuevamente. Este es su segundo intento de solución, ya no tendrá más intentos disponibles.', 'danger');
                    return Redirect::back()->withErrors($validator)->withInput();
                }
            }
            $this->almacenarRespuestas($preguntas,$request);
            $this->calificarRespuestas($preguntas);
            if($intentos == 1){
                DB::table('IntentoTaller')->where('inta_id', $intentoTaller->inta_id)->increment('inta_cantidad');
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }
        if (!$success) {
            flash('Ha ocurrido un error en el sistema, por favor inténtalo de nuevo.', 'danger');
            return $this->redireccionarSegunTipoTaller($taller, $curso);
        }
        flash('Todas sus respuestas han quedado guardadas.', 'success');
        return $this->redireccionarSegunTipoTaller($taller, $curso);
    }

    private function verificarErroresEnRespuestas($preguntas = array(), $request = null)
    {
        $errores = array();
        foreach ($preguntas as $pregunta) {
            if ($pregunta->preg_tipo == "unica-multiple"){
                if ($pregunta->tieneRespuestaMultiple() == true){
                    // Pregunta de tipo Checkbox
                    $respuestasCorrectas = $pregunta->obtenerRespuestasCorrectas();
                    $cantidadRespuestasCorrectas = 0;
                    $cantidadRespuestasIncorrectas = 0;
                    foreach ($respuestasCorrectas as $rc) {
                        if (array_key_exists('r_p_'.$pregunta->preg_id.'_o_'.$rc->remu_id, $request->all())) {
                            // Existe la respuesta correcta dentro de las respuestas que marcó el estudiante en el formulario.
                            $cantidadRespuestasCorrectas++;
                        }else{
                            $cantidadRespuestasIncorrectas++;
                        }
                    }
                    if($cantidadRespuestasIncorrectas != 0){
                        $errores['r_p_'.$pregunta->preg_id] = "Respuesta incorrecta.";
                    }
                }else{
                    // Pregunta de tipo Radio Button
                    // Capturo la respuesta correcta, obtengo el primer registro, debido a que solo debe haber 1 respuesta correcta, por ser de tipo 'unica'
                    $respuestaCorrecta = $pregunta->obtenerRespuestasCorrectas()->first();
                    // Valido si la respuesta que viene en la solicitud es la marcada por el profesor como correcta.
                    if ($request['r_p_'.$pregunta->preg_id] != $respuestaCorrecta->remu_id ) {
                        $errores['r_p_'.$pregunta->preg_id] = "Respuesta incorrecta.";
                    }
                }
            }
        }
        return $errores;
    }

    private function almacenarRespuestas($preguntas, $request)
    {
        foreach ($preguntas as $pregunta) {
            if ($pregunta->preg_tipo == "unica-multiple"){
                if ($pregunta->tieneRespuestaMultiple() == true){
                    // Pregunta de tipo Checkbox
                    $respuestaAnterior = $pregunta->obtenerRespuestaUsuario();
                    if(isset($respuestaAnterior) && $respuestaAnterior->isEmpty()){
                        $respuestasMultiplesUnicas = $pregunta->respuestasMultiplesUnicas;
                        foreach ($respuestasMultiplesUnicas as $respuesta ) {
                            if($request['r_p_'.$pregunta->preg_id.'_o_'.$respuesta->remu_id]){
                                Respuesta::create([
                                    'usua_id' => Auth::user()->usua_id,
                                    'preg_id' => $pregunta->preg_id,
                                    'remu_id' => $respuesta->remu_id
                                ]);
                            }
                        }
                    }
                }else{
                    // Pregunta de tipo Radio Button
                    $respuestaAnterior = $pregunta->obtenerRespuestaUsuario()->first();
                    if(!isset($respuestaAnterior)){
                        Respuesta::create([
                            'usua_id' => Auth::user()->usua_id,
                            'preg_id' => $pregunta->preg_id,
                            'remu_id' => $request['r_p_'.$pregunta->preg_id]
                        ]);
                    }
                }
            }elseif ($pregunta->preg_tipo == "abierta"){
                $respuestaAnterior = $pregunta->obtenerRespuestaUsuario()->first();
                if(!isset($respuestaAnterior)){
                    Respuesta::create([
                        'usua_id' => Auth::user()->usua_id,
                        'preg_id' => $pregunta->preg_id,
                        'resp_abierta' => $request['r_p_'.$pregunta->preg_id]
                    ]);
                }
            }elseif ($pregunta->preg_tipo == "archivo"){
                $respuestaAnterior = $pregunta->obtenerRespuestaUsuario()->first();
                if(!isset($respuestaAnterior)){
                    //obtenemos el campo file definido en el formulario
                    $file = $request->file('r_p_'.$pregunta->preg_id);
                    //obtenemos el nombre del archivo
                    $nombreArchivo = $file->getClientOriginalName();
                    // Almaceno en el dicso talleres el archivo cargado por el usuario.
                    $path = Storage::disk('talleres')->put('/'.$pregunta->tall_id.'/'.Auth::user()->usua_id, $file);
                    $respuestaArchivo = RespuestaArchivo::create([
                        'rear_rutaarchivo' => asset('storage/talleres/'.$path),
                        'rear_nombre'      => $nombreArchivo
                    ]);
                    Respuesta::create([
                        'usua_id' => Auth::user()->usua_id,
                        'preg_id' => $pregunta->preg_id,
                        'rear_id' => $respuestaArchivo->rear_id
                    ]);
                }
            }
        }
    }

    private function calificarRespuestas($preguntas = array())
    {
        foreach ($preguntas as $pregunta) {
            if ($pregunta->preg_tipo == "unica-multiple"){
                if ($pregunta->tieneRespuestaMultiple() == true){
                    // Pregunta de tipo Checkbox
                    $respuestasCorrectas = $pregunta->obtenerRespuestasCorrectas();
                    $respuestaUsuario = $pregunta->obtenerRespuestaUsuario();
                    $cantidadRespuestasCorrectasUsuario = 0;
                    foreach ($respuestaUsuario as $ru) {
                        if ($ru->respuestaMultipleUnica->remu_correcta == true) {
                            $cantidadRespuestasCorrectasUsuario++;
                        }
                    }
                    $cantidadRespuestasCorrectasPregunta = $pregunta->cantidadRespuestasCorrectas();
                    $calificacion = ($cantidadRespuestasCorrectasUsuario * 5) / $cantidadRespuestasCorrectasPregunta;
                    //dd($cantidadRespuestasCorrectasUsuario,$cantidadRespuestasCorrectasPregunta, $calificacion, round($calificacion * $pregunta->preg_porcentaje, 1));
                    Calificacion::create([
                        'cali_calificacion' => $calificacion,
                        'cali_ponderado'    => round($calificacion * $pregunta->preg_porcentaje, 1),
                        'usua_id'           => Auth::user()->usua_id,
                        'tall_id'           => $pregunta->tall_id,
                        'preg_id'           => $pregunta->preg_id
                    ]);
                }else{
                    // Pregunta de tipo Radio Button
                    $respuestaUsuario = $pregunta->obtenerRespuestaUsuario()->first();
                    // Capturo la respuesta correcta, obtengo el primer registro, debido a que solo debe haber 1 respuesta correcta, por ser de tipo 'unica'
                    $respuestaCorrecta = $pregunta->obtenerRespuestasCorrectas()->first();
                    $calificacion = 0;
                    // Valido si la respuesta que viene en la solicitud es la marcada por el profesor como correcta.
                    if ($respuestaUsuario->remu_id == $respuestaCorrecta->remu_id ) {
                        $calificacion = 5;
                    }
                    Calificacion::create([
                        'cali_calificacion' => $calificacion,
                        'cali_ponderado'    => $calificacion * $pregunta->preg_porcentaje,
                        'usua_id'           => Auth::user()->usua_id,
                        'tall_id'           => $pregunta->tall_id,
                        'preg_id'           => $pregunta->preg_id
                    ]);
                }
            }
        }
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

    public function solucionarTallerAsientoContablePost(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            $respuesta = array('state' => 'error', 'message' => 'El curso con ID: '.$curs_id.' no existe. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el taller exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller) || $taller->curs_id != $curso->curs_id) {
            $respuesta = array('state' => 'error', 'message' => 'El taller con ID: '.$tall_id.' no pertenece al curso seleccionado. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        //verificamos que el taller sea un taller de tipo diagnóstico o teórico
        if ( $taller->tall_tipo != "practico" ) {
            $respuesta = array('state' => 'error', 'message' => 'El taller con ID: '.$tall_id.' no es un taller de tipo práctico. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        $fechaActual = new DateTime();
        $fechaTaller = new DateTime($taller->tall_tiempo);
        if($fechaActual > $fechaTaller){
            $respuesta = array('state' => 'error', 'message' => 'El taller ha expirado, no se han podido guardar las respuestas.');
            echo json_encode($respuesta);
            die;
        }
        $tallerAsientoContable = $taller->tallerAsientoContable;
        $tallerAsientoContableRespuestas = json_decode(json_encode($request->all()));
        $i = 1;
        DB::beginTransaction();
        try {
            $tallerAsientoContable->respuestasTallerAsientosContables()->where('usua_id', Auth::user()->usua_id)->delete();
            foreach ($tallerAsientoContableRespuestas->filas as $fila) {
                $fila = json_decode(json_encode($fila));
                if(isset($fila->codigo, $fila->debito, $fila->credito) && $fila->codigo != "" && $fila->debito != "" && $fila->credito != ""){
                    RespuestaTallerAsientoContable::create([
                        'taac_id' => $tallerAsientoContable->taac_id,
                        'usua_id' => Auth::user()->usua_id,
                        'puc_id' => $fila->codigo,
                        'rtac_valordebito' => $fila->debito,
                        'rtac_valorcredito' => $fila->credito,
                        'rtac_fila' => $i
                    ]);
                    $i++;
                }
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            dd($e->getMessage());
        }
        if (!$success) {
            $respuesta = array('state' => 'error', 'message' => 'Ha ocurrido un error inesperado, por favor inténtelo de nuevo.');
        }else{
            $respuesta = array('state' => 'success', 'message' => 'Se ha guardado su información con éxito, las filas sin código PUC se han omitido.');
        }
        echo json_encode($respuesta);
    }

    public function solucionarTallerNominaPost(Request $request, $curs_id, $tall_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            $respuesta = array('state' => 'error', 'message' => 'El curso con ID: '.$curs_id.' no existe. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el taller exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller) || $taller->curs_id != $curso->curs_id) {
            $respuesta = array('state' => 'error', 'message' => 'El taller con ID: '.$tall_id.' no pertenece al curso seleccionado. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        //verificamos que el taller sea un taller de tipo diagnóstico o teórico
        if ( $taller->tall_tipo != "practico" ) {
            $respuesta = array('state' => 'error', 'message' => 'El taller con ID: '.$tall_id.' no es un taller de tipo práctico. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        $fechaActual = new DateTime();
        $fechaTaller = new DateTime($taller->tall_tiempo);
        if($fechaActual > $fechaTaller){
            $respuesta = array('state' => 'error', 'message' => 'El taller ha expirado, no se han podido guardar las respuestas.');
            echo json_encode($respuesta);
            die;
        }
        $tallerNomina = $taller->tallerNomina;
        if (!isset($tallerNomina)) {
            $respuesta = array('state' => 'error', 'message' => 'El taller de nómina no existe. Verifique por favor.');
            echo json_encode($respuesta);
            die;
        }
        $tallerNominaRespuestas = json_decode($request->filas);
        $i = 1;
        DB::beginTransaction();
        try {
            $respuestaTallerNomina = $tallerNomina->respuestasTallerNomina()->where('usua_id', Auth::user()->usua_id)->get()->first();
            if(!isset($respuestaTallerNomina)){
                $respuestaTallerNomina = RespuestaTallerNomina::create([
                    'tano_id' => $tallerNomina->tano_id,
                    'usua_id' => Auth::user()->usua_id,
                    'rear_id' => null
                ]);
            }
            //obtenemos el campo file definido en el formulario
            $file = $request->file('archivo_taller_nomina');
            $respuestaArchivo = null;
            // Si existe y no es nulo $file es porque el usuario seleccionó un archivo en el formulario.
            if(isset($file,$respuestaTallerNomina)){
                $respuestaArchivo = $respuestaTallerNomina->respuestaArchivo;
                $archivoOk = true;
                if(isset($respuestaArchivo)){
                    $infoArchivo = pathinfo($respuestaArchivo->rear_rutaarchivo);
                    // Compruebo que exista el archivo en el disco de talleres.
                    if(Storage::disk('talleres')->exists($taller->tall_id.'/'.Auth::user()->usua_id.'/'.$infoArchivo['basename'])){
                        // Si existe el archivo procedo a eliminarlo, retorna true si fue exitoso, de lo contrario retorna false.
                        $archivoOk = Storage::disk('talleres')->delete($taller->tall_id.'/'.Auth::user()->usua_id.'/'.$infoArchivo['basename']);
                    }
                }
                if($archivoOk){
                    //obtenemos el nombre del archivo
                    $nombreArchivo = $file->getClientOriginalName();
                    // Almaceno en el dicso talleres el archivo cargado por el usuario.
                    $path = Storage::disk('talleres')->put('/'.$taller->tall_id.'/'.Auth::user()->usua_id, $file);
                    if (!isset($respuestaArchivo)) {
                        $respuestaArchivo = RespuestaArchivo::create([
                            'rear_rutaarchivo' => asset('storage/talleres/'.$path),
                            'rear_nombre'      => $nombreArchivo
                        ]);
                    }else {
                        $respuestaArchivo->rear_rutaarchivo = asset('storage/talleres/'.$path);
                        $respuestaArchivo->rear_nombre = $nombreArchivo;
                        $respuestaArchivo->save();
                    }
                    $respuestaTallerNomina->rear_id = isset($respuestaArchivo->rear_id) ? $respuestaArchivo->rear_id : null;
                    $respuestaTallerNomina->save();
                }else {
                    $respuesta = array('state' => 'error', 'message' => 'Ha ocurrido un error eliminando el archivo anterior. Por favor inténtelo de nuevo.');
                    echo json_encode($respuesta);
                    die();
                }
            }
            if ($respuestaTallerNomina->filasTallerNomina->isNotEmpty()) {
                $respuestaTallerNomina->filasTallerNomina()->delete();
            }
            foreach ($tallerNominaRespuestas as $fila) {
                //$fila = json_decode(json_encode($fila));
                if(isset($fila->td_nombres_y_apellidos, $fila->td_documento) && $fila->td_nombres_y_apellidos != "" && $fila->td_documento != "" ){
                    FilaTallerNomina::create([
                        'retn_id' => $respuestaTallerNomina->retn_id,
                        'fitn_nombresyapellidos' => $fila->td_nombres_y_apellidos,
                        'fitn_documento' => $fila->td_documento,
                        'fitn_diastrabajados' => $fila->td_dias_trabajados,
                        'fitn_salario' => $fila->td_salario,
                        'fitn_salariobasico' => $fila->td_salario_basico,
                        'fitn_horasextrasyrecargos' => $fila->td_horas_extras_y_recargos,
                        'fitn_comisiones' => $fila->td_comisiones,
                        'fitn_bonificaciones' => $fila->td_bonificaciones,
                        'fitn_totaldevengado' => $fila->td_total_devengado,
                        'fitn_auxdetransporte' => $fila->td_aux_de_transporte,
                        'fitn_totaldevengadoconauxiliodetransporte' => $fila->td_total_devengado_con_auxilio_de_transporte,
                        'fitn_salud' => $fila->td_salud,
                        'fitn_pension' => $fila->td_pension,
                        'fitn_deduccionuno' => isset($fila->td_deduccionuno) ? $fila->td_deduccionuno : null,
                        'fitn_deducciondos' => isset($fila->td_deducciondos) ? $fila->td_deducciondos : null,
                        'fitn_deducciontres' => isset($fila->td_deducciontres) ? $fila->td_deducciontres : null,
                        'fitn_totaldeducciones' => $fila->td_total_deducciones,
                        'fitn_netoapagar' => $fila->td_neto_a_pagar,
                        'fitn_horaextradiurnacantidad' => $fila->td_hora_extra_diurna_cantidad,
                        'fitn_horaextradiurnavalor' => $fila->td_hora_extra_diurna_valor,
                        'fitn_horaextranocturnacantidad' => $fila->td_hora_extra_nocturna_cantidad,
                        'fitn_horaextranocturnavalor' => $fila->td_hora_extra_nocturna_valor,
                        'fitn_recargonocturnocantidad' => $fila->td_recargo_nocturno_cantidad,
                        'fitn_recargonocturnovalor' => $fila->td_recargo_nocturno_valor,
                        'fitn_horafestivadiurnacantidad' => $fila->td_hora_festiva_diurna_cantidad,
                        'fitn_horafestivadiurnavalor' => $fila->td_hora_festiva_diurna_valor,
                        'fitn_horafestivanocturnacantidad' => $fila->td_hora_festiva_nocturna_cantidad,
                        'fitn_horafestivanocturnavalor' => $fila->td_hora_festiva_nocturna_valor,
                        'fitn_horaextrafestivadiurnacantidad' => $fila->td_hora_extra_festiva_diurna_cantidad,
                        'fitn_horaextrafestivadiurnavalor' => $fila->td_hora_extra_festiva_diurna_valor,
                        'fitn_horaextrafestivanocturnacantidad' => $fila->td_hora_extra_festiva_nocturna_cantidad,
                        'fitn_horaextrafestivanocturnavalor' => $fila->td_hora_extra_festiva_nocturna_valor,
                        'fitn_valortotaldehorasextras' => $fila->td_valor_total_de_horas_extras,
                        'fitn_fila' => $i
                    ]);
                    $i++;
                }
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            dd($e->getMessage());
        }
        if (!$success) {
            $respuesta = array('state' => 'error', 'message' => 'Ha ocurrido un error inesperado, por favor inténtelo de nuevo.');
        }else{

            $respuesta = array('state' => 'success', 'message' => 'Se ha guardado su información con éxito, las filas sin nombres y apellidos ni documento se han omitido', 'archivo' => $respuestaArchivo);
        }
        echo json_encode($respuesta);
    }
}
