<?php

CAMBIO QUE NO SE DEBERÍA ENVIAR

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use App\Curso;
use App\Materia;
use App\Taller;
use App\DataTables\CursoDataTables;
use App\DataTables\MateriaDataTables;
use Validator;
use Yajra\Datatables\Datatables;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CursoDataTables $dataTable)
    {
        return $dataTable->render('profesor.curso.index');
    }

    /**
     * [indexEstudiante description]
     * @return [type] [description]
     */
    public function indexEstudiante(CursoDataTables $dataTable)
    {

        return $dataTable->render('estudiante.curso.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('profesor.curso.crear_curso');
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
           'nombre_curso' => 'required',
           'introduccion_curso' => 'required'
        ]);
        //dd($request->all());
        $curso=Curso::create([
            'curs_nombre' => $request['nombre_curso'],
            'curs_introduccion'=> $request['introduccion_curso']
          ]);
          flash('Curso "'.$curso->curs_nombre.'" creado con éxito.', 'success');
        return redirect()->route('profesor.curso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $curso = Curso::find($id);
        return View('profesor.curso.ver_curso')->with('curso', $curso);

        //return $dataTable->render('profesor.curso.ver_curso', compact('curso', $curso));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);
        return View('profesor.curso.editar_curso')->with('curso', $curso);
        //return $curso->curs_introduccion;
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
            'nombre_curso' => 'required|max:100',
            'introduccion_curso' => 'required|max:500',
        ])->validate();
        $curso = Curso::find($id);
        $curso->curs_nombre = $request->input('nombre_curso');
        $curso->curs_introduccion = $request->input('introduccion_curso');
        $curso->save();
        flash('Curso "'.$curso->curs_nombre.'" editado con éxito.', 'success');
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
        Curso::destroy($id);
        flash('Curso "'.$curso->curs_nombre.'" eliminado con éxito.', 'success');
        return redirect()->route('profesor.curso');
    }

    /*public function ver_temas_por_curso($curs_id = "")
    {
        $curso = Curso::find($curs_id);
        return View('profesor.curso.tema.ver_tema')->with('curso', $curso);
    }*/

    public function verMateriasPorCursoAjax($curs_id = "")
    {
        $materias = Materia::where('curs_id', $curs_id)->get();
        return Datatables::of($materias)
                        ->addColumn('opciones', function ($materia) {
                            $method_field = method_field('DELETE');
                            $csrf_field = csrf_field();
                            return
                            '<a href="'.route('profesor.curso.materia.editar', ['curs_id' => $materia->curs_id, 'mate_id' => $materia->mate_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                            <form action="'.route('profesor.curso.materia.eliminar', ['curs_id' => $materia->curs_id, 'mate_id' => $materia->mate_id]).'" method="POST" class="visible-lg-inline-block">
                                '.$method_field.'
                                '.$csrf_field.'
                                <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                            </form>';
                        })
                        ->editColumn('mate_rutaarchivo', '<a href="{{$mate_rutaarchivo}}">{{$mate_nombrearchivo}}</a>')
                        ->make(true);
    }

    /**
     * Funcion que permite consultar los talleres que tiene un curso
     * @param  string $curs_id [description]
     * @return [type]          [description]
     */
    public function verTalleresPorCursoAjax($curs_id = "")
   {
      $talleres = Taller::where('curs_id', $curs_id)->get();
       return Datatables::of($talleres)
                        ->addColumn('opciones', function ($taller) {
                            $method_field = method_field('DELETE');
                            $csrf_field = csrf_field();
                            return
                                '<a href="'.route('profesor.curso.taller.ver', ['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                                <a href="'.route('profesor.curso.taller.editar', ['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                <form action="'.route('profesor.curso.taller.eliminar', ['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id]).'" method="POST" class="visible-lg-inline-block">
                                    '.$method_field.'
                                    '.$csrf_field.'
                                    <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>';
                       })
                       ->editColumn('tall_rutaarchivo', '<a href="{{$tall_rutaarchivo}}">{{$tall_nombrearchivo}}</a>')
                       ->make(true);
   }

   public function verCursosEstudiantesAjax()
   {
              return Datatables::of()
           ->addColumn('opciones', function ($curso) {
               return
               '<a href="'.route('estudiante.curso.ver').'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>';
               //<a href="'.route('profesor.curso.tema.ver', ['curs_id' => $curso->curs_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-zoom-out"></i> Ver temas</a>';
           })
           ->make(true);
   }

}
