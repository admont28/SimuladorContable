<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Taller;
use App\Curso;
use App\Pregunta;
use App\DataTables\TallerDataTables;
use Yajra\Datatables\Datatables;
use Validator;
use Storage;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TallerDataTables $dataTable)
    {
        return $dataTable->render('profesor.curso.taller.index');
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
    public function store(Request $request, $curs_id = "")
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
           'tiempo_taller' => 'required|date',
           //'tiempo_taller' => 'required|date_format:YYYY-MM-DD HH:mm:ss',
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
    public function show($id)
    {
        $taller = Taller::find($id);
        return View('profesor.curso.taller.ver_taller')->with('taller', $taller);
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
                    ->with('taller', $taller)
                    ->with('curso', $curso)
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
           'tiempo_taller' => 'required|date'
           //'tiempo_taller' => 'required|date_format:YYYY-MM-DD HH:mm:ss'
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
    /**
     * [verPreguntasPorTaller description]
     * @param  string $tall_id [description]
     * @return [type]          [description]
     */
    public  function verPreguntasPorTaller($tall_id = "")
    {
        $pregunta = Pregunta::where('tall_id', $tall_id)->get();
        return Datatables::of($pregunta)
            ->addColumn('opciones', function ($taller) {
            return
                '<a href="'.route('profesor.curso.taller.ver', ['tall_id' => $taller->tall_id, 'curs_id'=>$taller->curs_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.curso.taller.editar', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.curso.taller.eliminar', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            })->make(true);
    }
}
