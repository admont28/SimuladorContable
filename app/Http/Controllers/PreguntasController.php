<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Pregunta;
use App\Taller;
use App\DataTables\PreguntaDataTables;
use Yajra\Datatables\Datatables;
use Validator;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PreguntaDataTables $dataTable )
    {
        return $dataTable->render('profesor.curso.taller.pregunta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tall_id)
    {
        $taller = Taller::find($tall_id);
        return View('profesor.curso.taller.pregunta.crear_pregunta')->with('taller',$taller);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tall_id)
    {
        dd($tall_id);
        $taller=Taller::find($tall_id);
        $this->validate($request, [
           'texto_pregunta' => 'required',
           'tipo_pregunta' => 'required',
           'porcentaje_pregunta'=>'required',
        ]);

        $pregunta=Pregunta::create([
            'preg_texto'=> $request['texto_pregunta'],
            'preg_tipo'=> $request['tipo_pregunta'],
            'preg_porcentaje'=> $request['porcentaje_pregunta'],
            'tall_id'=>$tall_id
          ]);

          flash('Pregunta "'.$pregunta->preg_texto.'" creado con éxito.', 'success');
          return redirect()->route('profesor.taller');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
