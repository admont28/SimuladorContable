<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Pregunta;
use App\Curso;
use App\Taller;
use App\DataTables\PreguntaDataTables;
use Yajra\Datatables\Datatables;
use Validator;

class PreguntaController extends Controller
{


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
    public function store(Request $request, $curs_id, $tall_id)
    {

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
          return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregunta = Pregunta::find($id);
        return view('profesor.curso.taller.pregunta.ver_pregunta')->with('pregunta', $pregunta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $tall_id, $preg_id)
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
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo tall_tipo de tipo enum.
        $posiblesOpciones = Pregunta::getPossibleEnumValues();
        // Retornamos la vista para editr la pregunta,
        // y le enviamos el modelo pregunta y taller  para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.taller.pregunta.editar_pregunta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta)
                    ->with('opciones', $posiblesOpciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curs_id, $tall_id, $preg_id)
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
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Obtengo las opciones disponbiles en bd en el campo preg_tipo de tipo enum.
        $opciones = Pregunta::getPossibleEnumValues();
        $opcionesSeparadasPorComas = implode(",", $opciones);
        // Para mirar el regex: http://www.regexpal.com/
        Validator::make($request->all(), [
            'texto_pregunta' => 'required|max:500|min:5',
            'tipo_pregunta' => 'required|in:'.$opcionesSeparadasPorComas,
            'porcentaje_pregunta'=>'required|regex:/^[0-9]([,\.][0-9])?$/'
        ])->validate();

        $pregunta->preg_texto = $request->input('texto_pregunta');
        $pregunta->preg_tipo = $request->input('tipo_pregunta');
        $pregunta->preg_porcentaje = $request->input('porcentaje_pregunta');
        $pregunta->save();

        flash('La pregunta "'.substr($pregunta->preg_texto, 0, 80).'..." editada con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id, 'tall_id'=> $tall_id]);
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
