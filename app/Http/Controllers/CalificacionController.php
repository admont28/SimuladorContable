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
     * metodo para cargar la vista de las calificaciones de un usuario.
     */
    public function mostrarCalificacionesUsuario($curs_id, $tall_id,$usua_id)
    {
        $curso = Curso::find($curs_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver',['curs_id' => $taller->tall_id]);
        }
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id]);
        }
        return view('profesor.curso.taller.pregunta.calificacion.ver_calificacion_pregunta')
            ->with('curso', $curso)
            ->with('taller', $taller)
            ->with('usuario', $usuario);
    }

    /**
     * metodo para traer las preguntas que han respondido un usuario.
     */
    public function mostrarCalificacionesUsuarioAjax($curs_id, $tall_id,$usua_id)
    {
        $taller = Taller::find($tall_id);
        $usuario =User::find($usua_id);
        $respuestas= $usuario->respuestasTallerPorEstudiante($tall_id);
        return Datatables::of($respuestas)
                        ->addColumn('opciones', function ($respuestas) use ($taller, $usuario) {
                            $botonCalificar = "";
                            if(!isset($respuestas->cali_calificacion)){
                                $resp_id = Respuesta::where('preg_id',$respuestas->preg_id)->where('usua_id', $usuario->id)->get()->first();
                                $botonCalificar = '<a href="'.route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante.calificar.pregunta',['curs_id'=>$taller->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id,'preg_id'=>$respuestas->preg_id,'resp_id'=>$resp_id ]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Calificar</a>';
                            }
                            return $botonCalificar;
                        })
                        ->editColumn('cali_calificacion', '@if(isset($cali_calificacion)) {{ $cali_calificacion }} @else <span class="label label-danger">SIN CALIFICACIÓN</span> @endif')
                        ->editColumn('preg_tipo', '@if($preg_tipo == "unica-multiple") <span class="label label-info">{{ $preg_tipo }}</span> @elseif($preg_tipo == "abierta") <span class="label label-warning">{{ $preg_tipo }}</span> @else <span class="label label-default">{{ $preg_tipo }}</span> @endif')
                        ->editColumn('preg_porcentaje','{{ $preg_porcentaje * 100 }}%')
                        ->editColumn('cali_ponderado', '@if(isset($cali_ponderado)) {{ $cali_ponderado }} @else <span class="label label-danger">SIN PONDERADO</span> @endif')
                        ->make(true);
    }

    /**
     * metodo para cargar la vista de las calificaciones de un usuario.
     */
    public function calificarRespuestaUsuario($curs_id, $tall_id,$usua_id,$preg_id, $resp_id)
    {
        $curso = Curso::find($curs_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver',['curs_id' => $taller->tall_id]);
        }
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id]);
        }
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id]);
        }
        $respuesta = Respuesta::find($resp_id);
        if (!isset($respuesta)) {
            flash('la respuesta con ID: '.$resp_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id]);
        }
        return view('profesor.curso.taller.pregunta.calificacion.hacer_calificacion_estudiante')
            ->with('curso', $curso)
            ->with('taller', $taller)
            ->with('usuario', $usuario)
            ->with('pregunta', $pregunta)
            ->with('respuesta', $respuesta);
    }

    /**
     * metodo para cargar la vista de las calificaciones de un usuario.
     */
    public function calificarPreguntaUsuarioPost(Request $request, $curs_id, $tall_id,$usua_id, $preg_id, $resp_id)
    {
        $curso = Curso::find($curs_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        $taller = Taller::find($tall_id);
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        if (!isset($taller)) {
            flash('El taller con ID: '.$tall_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver',['curs_id' => $taller->tall_id]);
        }
        $usuario = User::find($usua_id);
        if (!isset($usuario)) {
            flash('El usuario con ID: '.$usua_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id]);
        }
        $pregunta = Pregunta::find($preg_id);
        if (!isset($pregunta)) {
            flash('la pregunta con ID: '.$preg_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id]);
        }
        $respuesta = Respuesta::find($resp_id);
        if (!isset($respuesta)) {
            flash('la respuesta con ID: '.$resp_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id]);
        }
        Validator::make($request->all(), [
           'calificacion_pregunta' => 'required|max:5'
        ])->validate();
        $calificacion = Calificacion::create([
            'usua_id'=>$usuario->id,
            'tall_id'=>$taller->tall_id,
            'preg_id'=>$pregunta->preg_id,
            'cali_calificacion'=> $request['calificacion_pregunta'],
            'cali_ponderado'=>$request['calificacion_pregunta'] * $pregunta->preg_porcentaje
        ]);
        flash('La calificación se ha creado con éxito.','success' );
        return redirect()->route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id,'usua_id'=>$usuario->id]);
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
