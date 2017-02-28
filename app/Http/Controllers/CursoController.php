<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabeceras = [
            'ID',
            'Nombre',
            'Opciones'
        ];
        $cursos = Curso::all();
        $nombres_atributos = [
            'curs_id',
            'curs_nombre'
        ];
        $opciones = array();
        foreach ($cursos as $curso) {
            $icono_ver = "<a href='".route('profesor.curso.ver', ['id' => $curso->curs_id])."'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a>";
            $icono_editar = "<a href='".route('profesor.curso.editar', ['id' => $curso->curs_id])."''><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
            $icono_eliminar = "<a href='".route('profesor.curso.eliminar', ['id' => $curso->curs_id])."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>";
            $opcion = new \stdClass();
            $opcion->id = $curso->curs_id;
            $opcion->valores = $icono_ver.$icono_editar.$icono_eliminar;
            $opciones[] = $opcion;
        }
        return view('profesor.curso.index')
                ->with('cabeceras',$cabeceras)
                ->with('cursos',$cursos)
                ->with('nombres_atributos', $nombres_atributos)
                ->with('opciones', $opciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        return $id;
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
