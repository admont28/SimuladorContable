<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Taller;
use App\Pregunta;
use Validator;

class CalificacionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($usua_id, $tall_id, $preg_id, $curs_id)
    {
            $usuario = User::find($usua_id);
            if (!isset($usuario)) {
                flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
                return redirect()->route('profesor.curso');
            }
            $taller = Taller::find($tall_id);
            if (!isset($taller)) {
                flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
                return redirect()->route('profesor.curso');
            }
            $pregunta = Pregunta::find($preg_id);
            if (!isset($pregunta)) {
                flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
                return redirect()->route('profesor.curso');
            }
            $curso = Curso::find($curs_id);
            if (!isset($curso)) {
                flash('el curso  con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
                return redirect()->route('profesor.curso');
            }

            return view('profesor.curso.taller.pregunta.calificacion.ver_calificacion')
                ->with('usuario', $usuario)
                ->with('tall-id', $taller->tall_id)
                ->with('pregunta', $pregunta)
                ->with('curs_id', $curso->curs_id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
    public function destroy($id)
    {
        //
    }
}
