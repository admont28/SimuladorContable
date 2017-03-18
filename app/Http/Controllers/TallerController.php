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
        //->with('taller',$taller );
    }

    /**
     * Función que permite consultar los registros de la tabla Taller y colocarlo en el DataTables
     * @return [type] [description]
     */
    public function getBasicData()
   {
       $taller = Taller::select('tall_id','tall_nombre','tall_tipo','tall_tiempo','curs_id')->get();
       return Datatables::of($taller)
       ->addColumn('opciones', function ($taller) {
           return
           '<a href="'.route('profesor.curso.taller.ver', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
           <a href="'.route('profesor.curso.taller.editar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
           <a href="'.route('profesor.curso.taller.eliminar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
       })->make();
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id = "")
    {
        //$curso = Curso::find($curs_id);
        //if (!isset($curso)) {
    //        flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
    //        return redirect()->route('profesor.curso');
    //    }
        return View('profesor.curso.taller.crear_taller');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id="")
    {
        $curso=Curso::find($curs_id);
        //if (!isset($curso)) {
        //    flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
        //    return redirect()->route('profesor.taller');
        //}

        $this->validate($request, [
           'nombre_taller' => 'required',
           'tipo_taller' => 'required',
           'tiempo_taller'=>'required',
           'curs_id'=>'required'

        ]);

        $taller=Taller::create([
            'tall_nombre'=> $request['nombre_taller'],
            'tall_tipo'=> $request['tipo_taller'],
            'tall_tiempo'=> $request['tiempo_taller'],
            'tall_rutaarchivo'=>$request['taller_rutaarchivo'],
            'curs_id'=>$request['curso_taller']
          ]);

        flash('Taller "'.$taller->tall_nombre.'" creado con éxito.', 'success');
        return redirect()->route('profesor.curso.taller');
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
    public function edit($id)
    {
        $taller = Taller::find($id);
        return View('profesor.curso.taller.editar_taller')->with('taller', $taller);
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
    public function destroy($id)
    {
        Taller::destroy($id);
        flash('Curso "'.$taller->tall_nombre.'" eliminado con éxito.', 'success');
        return redirect()->route('profesor.curso.taller');
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
