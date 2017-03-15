<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Materia;
use App\Curso;
use App\DataTables\MateriaDataTables;
use Yajra\Datatables\Datatables;
use Validator;
use Storage;
use File;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MateriaDataTables $dataTable)
    {
        return $dataTable->render('profesor.materia.index');
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
        return View('profesor.curso.materia.crear_materia')->with('curso', $curso);
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
           'mate_nombre' => 'required|max:100',
           'mate_tema' => 'required|max:1000',
           'mate_rutaarchivo' => 'required'
        ])->validate();

        //obtenemos el campo file definido en el formulario
        $file = $request->file('mate_rutaarchivo');

        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();

        $path = Storage::disk('materias')->put('/', $file);

        Materia::create([
            'mate_nombre' => $request['mate_nombre'],
            'mate_tema'   => $request['mate_tema'],
            'mate_rutaarchivo' => asset('storage/materias/'.$path),
            'mate_nombrearchivo' => $nombre,
            'curs_id'=> $curs_id
        ]);

        flash('La materia "'.$request['mate_nombre'].'" ha sido creado con éxito.','success');
        return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($curs_id, $mate_id)
    {
        $materia = Materia::find($id);
        return View('profesor.materia.ver_materia')->with('materia', $materia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $mate_id)
    {
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $materia = Materia::find($mate_id);
        if (!isset($materia)) {
            flash('La materia con ID: '.$mate_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        return View('profesor.curso.materia.editar_materia')->with('materia', $materia)->with('curso', $curso);
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
           'mate_nombre' => 'required|max:100',
           'mate_tema'   => 'required|max:1000',
           'mate_rutaarchivo' => 'required'
        ])->validate();

        $materia = Materia::find($id);
        $materia->mate_nombre = $request->input('mate_nombre');
        $materia->mate_tema   = $request->input('mate_tema');
        $materia->mate_rutaarchivo = $request->input('mate_rutaarchivo');
        $materia->save();
        flash('Materia "'.$materia->mate_nombre.'" editada con éxito.', 'success');
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
        $materia = Materia::find($id);
        Materia::destroy($id);
        flash('Materia "'.$materia->mate_nombre.'" eliminada con éxito.', 'success');
        return redirect()->route('profesor.curso');
    }
}
