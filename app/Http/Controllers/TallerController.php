<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taller;
use App\TallerAsientoContable;
use App\TallerNomina;
use App\Curso;
use App\Pregunta;
use App\Tarifa;
use App\DataTables\TallerDataTables;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Auth;
use Redirect;
use Storage;

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
        Taller::create([
            'tall_nombre' => $request['nombre_taller'],
            'tall_tipo' => $request['tipo_taller'],
            'tall_tiempo' => $request['tiempo_taller'],
            'tall_rutaarchivo' => asset('storage/talleres/'.$path),
            'tall_nombrearchivo' => $nombreArchivo,
            'curs_id' => $curs_id
        ]);
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
        $tallerAsientoContable = $taller->tallerAsientoContable;
        return View('profesor.curso.taller.ver_taller')
                    ->with('taller', $taller)
                    ->with('tallerAsientoContable', $tallerAsientoContable);
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
            // Compruebo que exista el archivo en el disco de materias.
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

    public function crearTallerAsientosContables($curs_id, $tall_id)
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
        return View('profesor.curso.taller.asientocontable.crear')
                ->with('curso', $curso)
                ->with('taller', $taller);
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
        // Validamos los campos del formulario.
        Validator::make($request->all(),[
            'cantidad_filas_tabla' => 'required|integer'
        ])->validate();
        // Creo el taller de asiento contable en bd y lo relaciono con el taller que sería el padre
        TallerAsientoContable::create([
            'taac_cantidadfilas' => $request['cantidad_filas_tabla'],
            'tall_id'            => $taller->tall_id
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
            'cantidad_filas_tabla' => 'required|integer',
            'deduccion_uno'   => '',
            'deduccion_dos'          => '',
            'deduccion_tres'          => ''
        ])->validate();
        // Creo el taller de nómina en bd y lo relaciono con el taller que sería el padre
        TallerNomina::create([
            'tano_cantidadfilas'     => $request['cantidad_filas_tabla'],
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
                <form action="'.route('profesor.curso.taller.pregunta.eliminar', ['curs_id'=>$pregunta->taller->curs_id,'tall_id' => $pregunta->taller->tall_id,'preg_id'=>$pregunta->preg_id]).'" method="POST" class="visible-lg-inline-block">
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
                    <form action="'.route('profesor.curso.taller.tarifa.eliminar', ['curs_id'=>$tarifa->taller->curs_id,'tall_id' => $tarifa->taller->tall_id,'tari_if'=>$tarifa->tari_id]).'" method="POST" class="visible-lg-inline-block">
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

    public function solucionarTallerDiagnosticoPost(Request $request, $curs_id, $tall_id)
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
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('estudiante.curso.ver.talleres', ['curs_id' => $curs_id]);
        }
        //verificamos que el taller sea un taller de tipo diagnostico
        if ($taller->tall_tipo != "diagnostico") {
            flash('El taller con ID: '.$tall_id.' no es un taller de tipo diagnostico. Verifique por favor.', 'danger');
            return redirect()->route('estudiante.curso.ver.talleres',['curs_id'=>$curso->curs_id]);
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
        if ($validator->fails() || !empty($errores))
        {
            // Adiciono a $validator los mensajes de error que se encuentren en $errores
            foreach ($errores as $llave => $valor) {
                $validator->getMessageBag()->add($llave, $valor);
            }
            $intentoTaller = DB::table('IntentoTaller')->select('inta_cantidad', 'inta_id')->where('usua_id', Auth::user()->usua_id)->where('tall_id', $taller->tall_id)->first();
            // Decremento el valor de inta_cantidad porque al cargar la página de las preguntas, el controlador se encarga de incrementarlo, y si existen errores en el formulario, no debería contar como un intento de guardar las respuestas.
            DB::table('IntentoTaller')->where('inta_id', $intentoTaller->inta_id)->decrement('inta_cantidad');
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // En este punto, todas las preguntas tienen respuestas, y no hay errores en el formulario.
        // Se procede a verificar cuales están correctas y cuales no.
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

                }else{
                    // Pregunta de tipo Radio Button
                    // Capturo la respuesta correcta, obtengo el primer registro, debido a que solo debe haber 1 respuesta correcta, por ser de tipo 'unica'
                    $respuestaCorrecta = $pregunta->obtenerRespuestasCorrectas()->first();
                    // Valido si la respuesta que viene en la solicitud es la marcada por el profesor como correcta.
                    if ($request['r_p_'.$pregunta->preg_id] == $respuestaCorrecta->remu_id ) {

                    }
                    if (array_key_exists('r_p_'.$pregunta->preg_id.'_o_'.$rc->remu_id, $request->all())) {
                        if(!array_key_exists('r_p_'.$pregunta->preg_id, $request->all())){
                            $errores['r_p_'.$pregunta->preg_id] = "Debe seleccionar una respuesta para esta pregunta.";
                        }
                    }
                }
            }
        }
    }

}
