<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Curso;
use App\Puc;
use Validator;

class PucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id)
    {
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        return View('profesor.curso.puc.crear_puc')->with('curso', $curso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id)
    {
        // Se establece a 3 minutos (180 segundos) la ejecución máxima del script.
        ini_set('max_execution_time', 180);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $file = $request->file('archivo_puc');
        // Validamos los campos del formulario.
        Validator::make(
            [
                'file'      => $file,
                'extension' => strtolower($file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required|mimetypes:text/plain',
                'extension'      => 'required|in:csv',
            ]
        )->validate();
        // Eliminamos todos los pucs relacionados con el curso actual, para ser reemplazados.
        $pucsDeleted = $curso->pucs()->delete();
        Excel::load($file->getRealPath(), function($pucs) use($curso)
        {
            foreach($pucs->get() as $puc)
            {
                Puc::create([
                    'puc_codigo' => $puc->codigo,
                    'puc_nombre' => $puc->nombre,
                    'curs_id'    => $curso->curs_id
                ]);
            }
        });
        // Informo al usuario y redireccionamos.
        flash('El archivo PUC "'.$file->getClientOriginalName().'" ha sido importado con éxito.','success');
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
        //
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
    public function destroy($curs_id)
    {
        //
    }
}
