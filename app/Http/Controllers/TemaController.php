<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Tema;
use App\Curso;
use App\DataTables\TemaDataTables;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TemaDataTables $dataTable)
    {
        return $dataTable->render('profesor.tema.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('profesor.tema.crear_tema');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'curs_id' => 'required',
           'titulo_tema' => 'required',
           'curso' => 'required'
        ]);

        //dd($request);
        Tema::create([
            'tema_titulo' => $request['titulo_tema'],
            'curs_id'=> $request['curso'],
            'tema_rutaarchivo' => $request['tema_rutaarchivo']
        ]);
        return redirect()->route('profesor.tema');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tema = Tema::find($id);
        return View('profesor.tema.ver_tema')->with('tema', $tema);
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
