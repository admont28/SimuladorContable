<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Curso;
use App\Taller;
use App\Pregunta;
use App\Calificacion;
use App\RespuestaMultipleUnica;
use App\RespuestaAbierta;
use App\Respuesta;
use Validator;
use  Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

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
                    return redirect()->route('login');
                }
                $taller = Taller::find($tall_id);
                if (!isset($taller)) {
                    flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
                    return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
                }
                $pregunta = Pregunta::find($preg_id);
                if (!isset($pregunta)) {
                    flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
                    return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
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
    public function calificarPreguntaAbierta(Request $request, $usua_id, $tall_id, $preg_id, $curs_id)
    {
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('login');
        }
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('el curso  con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $calificacion = 0;
        $cali_ponderado = 0;
        $respuesta = Respuesta::where('usua_id',$usua_id)->where('preg_id', $preg_id);
        $respuestaAbierta = $respuesta->RespuestaAbierta();
        if ($pregunta->preg_tipo == "abierta" && isset($respuestaAbierta) && $respuesta->remu_id == NULL && $respuesta->rear_id == NULL)
        {
            $calificacion = $request['calificacion_pregunta'];
        }
        $cali_ponderado = $calificacion * $pregunta->preg_porcentaje;
        calificacion::create([
            'usua_id'=> $usua_id,
            'tall_id'=> $tall_id,
            'prep_id'=> $preg_id,
            'cali_calificacion'=>$calificacion,
            'cali_ponderado'=>$cali_ponderado
        ]);
        flash('el taller "'.$taller->tall_nombre.'" se calificó con exito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id]);
    }


    public function calificarPreguntaArchivo(Request $request, $usua_id, $tall_id, $preg_id, $curs_id)
    {
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('login');
        }
        $taller = Taller::find($tall_id);
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
        }
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('el curso  con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $calificacion = 0;
        $cali_ponderado = 0;
        $respuesta = Respuesta::where('usua_id',$usua_id)->where('preg_id', $preg_id);
        $RespuestaArchivo = $respuesta->RespuestaArchivo();
        if ($pregunta->preg_tipo == "archivo" && isset($RespuestaArchivo) && $respuesta->remu_id == NULL && $respuesta->reab_id == NULL)
        {
            $calificacion = $request['calificacion_pregunta'];
        }
        $cali_ponderado = $calificacion * $pregunta->preg_porcentaje;
        calificacion::create([
            'usua_id'=> $usua_id,
            'tall_id'=> $tall_id,
            'prep_id'=> $preg_id,
            'cali_calificacion'=>$calificacion,
            'cali_ponderado'=>$cali_ponderado
        ]);
        flash('el taller "'.$taller->tall_nombre.'" se calificó con exito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curs_id,'tall_id'=>$taller->tall_id]);
    }



    /**
     * metodo para mostrar todas las calificaciones de todos los usuarios
     */
    public function mostrarCalificacionesTaller($curs_id,$tall_id)
    {
        $usuarios = User::all();
        $curso = Curso::find($curs_id);
        $taller = Taller::find($tall_id);
        $preguntas = $taller->preguntas();
        $calificaciones = Calificacion::all();
        return view('profesor.curso.taller.pregunta.calificacion.ver_calificacion')
            ->with('calificaciones', $calificaciones)
            ->with('usuarios', $usuarios)
            ->with('curso', $curso)
            ->with('taller', $taller)
            ->with('pregunta', $pregunta);

    }
    /**
     * metodo para traer los usuarios que han respondido un taller
     */
    public function mostrarUsuariosTaller($curs_id, $tall_id)
    {
        $taller = Taller::find($tall_id);
        $usuarios = $taller->usuariosPorTaller();
        //$preguntas = $taller->preguntas;
        //$calificaciones=Calificacion::find($tall_id);
        return Datatables::of($usuarios)
                        ->addColumn('opciones', function ($usuario) {
                            return
                            '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Ver</a>';
                        })
                        ->make(true);

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
