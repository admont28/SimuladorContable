<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Tema;
use App\Curso;
use App\DataTables\TemaDataTables;
use Yajra\Datatables\Datatables;
use Validator;

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
    public function create($curs_id = "")
    {
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        return View('profesor.curso.tema.crear_tema')->with('curso', $curso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id)
    {
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }

        Validator::make($request->all(), [
           'tema_titulo' => 'required|max:100',
           'tema_rutaarchivo' => 'required'
        ])->validate();

        Tema::create([
            'tema_titulo' => $request['tema_titulo'],
            'curs_id'=> $curs_id,
            'tema_rutaarchivo' => $request['tema_rutaarchivo']
        ]);

        flash('El tema "'.$request['tema_titulo'].'" ha sido creado con éxito.','success');
        return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
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
        return View('profesor.tema.ver_tema')->with('temas', $tema);
    }

    public function listarTemasPorCurso($id)
    {
        dd(\DB::table('tema')->where('curs_id', $id)->get());


        return View('profesor.tema.ver_tema')
                    ->with('tema', $tema);




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
