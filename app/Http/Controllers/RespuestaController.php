<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
use App\RespuestaMultipleUnica;
use App\Curso;
use App\Taller;
use App\User;
use Yajra\Datatables\Datatables;
use Validator;

class RespuestaController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearRespuestaMultipleUnica($curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        return View('profesor.curso.taller.pregunta.respuesta.crear_respuesta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta);
    }

    public function responderPreguntaMultipleUnica($curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso.ver.talleresdiagnostico', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso.ver.talleresdiagnostico', ['curs_id' => $curs_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('estudiante.curso.ver.talleresdiagnostico', ['curs_id' => $curs_id]);
        }
        return View('estudiante.curso.taller.pregunta.ver_preguntas')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarRespuestaMultipleUnica(Request $request, $curs_id, $tall_id, $preg_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        Validator::make($request->all(), [
            'texto_respuesta' => 'required|max:200',
            'correcta_respuesta' => ''
        ])->validate();
        // Almaceno en bd la nueva respuesta
        RespuestaMultipleUnica::create([
            'remu_texto'=> $request['texto_respuesta'],
            'remu_correcta'=> isset($request['correcta_respuesta']) ? '1' : '0',
            'preg_id'=>$preg_id
        ]);
        flash('Respuesta "'.$request['texto_respuesta'].'" creada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.pregunta.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id, 'preg_id' => $preg_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarRespuestaMultipleUnica($curs_id, $tall_id, $preg_id, $remu_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        // Verificamos que exista la respuesta multiple unica en bd, si no es así, informamos al usuario y redireccionamos.
        $respuestaMultipleUnica = RespuestaMultipleUnica::find($remu_id);
        if (!isset($respuestaMultipleUnica)) {
            flash('La respuesta con ID: '.$remu_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        return View('profesor.curso.taller.pregunta.respuesta.editar_respuesta')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('pregunta', $pregunta)
                    ->with('respuesta', $respuestaMultipleUnica);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarRespuestaMultipleUnica(Request $request, $curs_id, $tall_id, $preg_id, $remu_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        Validator::make($request->all(), [
            'texto_respuesta' => 'required|max:200',
            'correcta_respuesta' => ''
        ])->validate();
        // Verificamos que exista la respuesta multiple unica en bd, si no es así, informamos al usuario y redireccionamos.
        $respuestaMultipleUnica = RespuestaMultipleUnica::find($remu_id);
        if (!isset($respuestaMultipleUnica)) {
            flash('La respuesta con ID: '.$remu_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        $respuestaMultipleUnica->remu_texto = $request['texto_respuesta'];
        $respuestaMultipleUnica->remu_correcta = isset($request['correcta_respuesta']) ? '1' : '0';
        $respuestaMultipleUnica->save();
        flash('Respuesta "'.$respuestaMultipleUnica->remu_texto.'" editada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.pregunta.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id, 'preg_id' => $preg_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarRespuestaMultipleUnica($curs_id, $tall_id, $preg_id, $remu_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista la pregunta en bd, si no es así, informamos al usuario y redireccionamos.
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('La pregunta con ID: '.$preg_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Verificamos que la pregunta sea de tipo unica-multiple para poder añadirle respuestas, si no es así, informamos y redireccionamos.
        if($pregunta->preg_tipo != 'unica-multiple'){
            flash('La pregunta con ID: '.$preg_id.' no es una pregunta de tipo: unica-multiple. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        // Verificamos que exista la respuesta multiple unica en bd, si no es así, informamos al usuario y redireccionamos.
        $respuestaMultipleUnica = RespuestaMultipleUnica::find($remu_id);
        if (!isset($respuestaMultipleUnica)) {
            flash('La respuesta con ID: '.$remu_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.pregunta.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id, 'preg_id' => $pregunta->preg_id]);
        }
        $respuestaMultipleUnica->delete();
        flash('Respuesta "'.$respuestaMultipleUnica->remu_texto.'" ha sido eliminada con éxito.')->success();
        return redirect()->route('profesor.curso.taller.pregunta.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id, 'preg_id' => $preg_id]);
    }

    public function mostrarRespuestaTallerPractico($curs_id, $tall_id, $usua_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista el taller en bd, si no es así, informamos al usuario y redireccionamos.
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        // Verificamos que exista el usuario en bd, si no es así, informamos al usuario y redireccionamos.
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.')->error();
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        $tallerAsientoContable = $taller->tallerAsientoContable;
        $tallerNomina          = $taller->tallerNomina;
        $tallerKardex          = $taller->tallerKardex;
        $tallerNiif            = $taller->tallerNiif;
        // Verificamos el tipo de taller practico para mostrar la respuesta de ese taller.
        if(isset($tallerAsientoContable)){
            $respuestasTallerAsientosContables = $tallerAsientoContable->respuestasTallerAsientosContables()->where('usua_id', $usuario->id)->orderBy('rtac_numerotabla','asc')->get();
            return View('profesor.curso.taller.asientocontable.respuesta')
                        ->with('curso', $curso)
                        ->with('taller', $taller)
                        ->with('tallerAsientoContable', $tallerAsientoContable)
                        ->with('usuario', $usuario)
                        ->with('respuestasTallerAsientosContables', $respuestasTallerAsientosContables);
        }elseif (isset($tallerNomina)) {
            $respuestaTallerNomina = $tallerNomina->respuestasTallerNomina->where('usua_id', $usuario->id)->first();
            return View('profesor.curso.taller.nomina.respuesta')
                        ->with('curso', $curso)
                        ->with('taller', $taller)
                        ->with('tallerNomina', $tallerNomina)
                        ->with('usuario', $usuario)
                        ->with('respuestaTallerNomina', $respuestaTallerNomina);
        }elseif (isset($tallerKardex)) {
            $respuestaTallerKardex = $tallerKardex->respuestasTallerKardex->where('usua_id', $usuario->id)->first();
            return View('profesor.curso.taller.kardex.respuesta')
                        ->with('curso', $curso)
                        ->with('taller', $taller)
                        ->with('tallerKardex', $tallerKardex)
                        ->with('usuario', $usuario)
                        ->with('respuestaTallerKardex', $respuestaTallerKardex);
        }elseif (isset($tallerNiif)) {
            $respuestaTallerNiif = $tallerNiif->respuestasTallerNiif->where('usua_id', $usuario->id)->first();
            return View('profesor.curso.taller.niif.respuesta')
                        ->with('curso', $curso)
                        ->with('taller', $taller)
                        ->with('tallerNiif', $tallerNiif)
                        ->with('usuario', $usuario)
                        ->with('respuestaTallerNiif', $respuestaTallerNiif);
        }
        flash('El taller con ID: '.$tall_id.' no es un taller práctico. Verifique por favor.')->error();
        return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $taller->tall_id]);
    }
    
}
