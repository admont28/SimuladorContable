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
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        return View('profesor.curso.taller.crear_taller')->with('curso', $curso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id ="")
    {
        $curso=Curso::find($curs_id);

        if (!isset($curso)) {

            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller',['curs_id'=> $curso->curs_id]);
        }
        $this->validate($request, [
           'nombre_taller' => 'required',
           'tipo_taller' => 'required',
           'tiempo_taller'=>'required',
           'taller_rutaarchivo'=>'required',
         ]);

        $taller=Taller::create([
            'tall_nombre'=> $request['nombre_taller'],
            'tall_tipo'=> $request['tipo_taller'],
            'tall_tiempo'=> $request['tiempo_taller'],
            'tall_rutaarchivo'=>$request['taller_rutaarchivo'],
            'curs_id'=>$curs_id
          ]);
        flash('Taller "'.$taller->tall_nombre.'" creado con éxito.', 'success');

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
        // Retornamos la vista para editr el taller,
        // y le enviamos el modelo taller y curso para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.taller.editar_taller')->with('taller', $taller)->with('curso', $curso);
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
        Validator::make($request->all(), [
            'nombre_taller' => 'required',
            'tipo_taller' => 'required',
            'tiempo_taller'=>'required'

        ])->validate();
        $taller = Taller::find($id);
        $taller->tall_nombre = $request->input('nombre_taller');
        $taller->tall_tipo = $request->input('tipo_taller');
        $taller->tall_tiempo = $request->input('tiempo_taller');
        $taller->save();
        flash('Curso "'.$curso->curs_nombre.'" editado con éxito.', 'success');
        return redirect()->route('profesor.curso');
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
                '<a href="'.route('profesor.curso.taller.ver', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.curso.taller.editar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.curso.taller.eliminar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            })->make(true);
    }
}
