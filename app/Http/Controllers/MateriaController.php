<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Curso;
use Validator;
use Storage;

/**
 * Clase que manejará las acciones para una materia.
 */
class MateriaController extends Controller
{

    /**
     * Mostrar el formulario para adicionar una nueva materia.
     *
     * @param  int  $curs_id    Id del curso al que se le adicionará la materia.
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id = "")
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Retornamos la vista con el formulario para adicionar una nueva materia.
        return View('profesor.curso.materia.crear_materia')->with('curso', $curso);
    }

    /**
     * Almacenar en bd una nueva materia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $curs_id    Id del curso al que se le adicionará la materia.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Validamos los campos del formulario.
        Validator::make($request->all(), [
           'mate_nombre' => 'required|max:100',
           'mate_tema' => 'required|max:1000',
           'mate_rutaarchivo' => 'required'
        ])->validate();
        //obtenemos el campo file definido en el formulario
        $file = $request->file('mate_rutaarchivo');
        //obtenemos el nombre del archivo
        $nombreArchivo = $file->getClientOriginalName();
        // Almaceno en el dicso materias el archivo cargado por el usuario.
        $path = Storage::disk('materias')->put('/', $file);
        // Almaceno en bd la nueva materia.
        Materia::create([
            'mate_nombre' => $request['mate_nombre'],
            'mate_tema'   => $request['mate_tema'],
            'mate_rutaarchivo' => asset('storage/materias/'.$path),
            'mate_nombrearchivo' => $nombreArchivo,
            'curs_id'=> $curs_id
        ]);
        // Informo al usuario y redireccionamos.
        flash('La materia "'.$request['mate_nombre'].'" ha sido creada con éxito.','success');
        return redirect()->route('profesor.curso.ver', ['curs_id' => $curs_id]);
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($curs_id, $mate_id)
    {
        $materia = Materia::find($id);
        return View('profesor.materia.ver_materia')->with('materia', $materia);
    }*/

    /**
     * Mostrar el formulario para editar una materia.
     *
     * @param  int  $curs_id    Id del curso al que pertenece la materia a editar.
     * @param  int  $mate_id    Id de la materia a editar
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $mate_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista la materia en bd, si no es así, informamos al usuario y redireccionamos.
        $materia = Materia::find($mate_id);
        if (!isset($materia)) {
            flash('La materia con ID: '.$mate_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
        }
        // Retornamos la vista para editr la materia,
        // y le enviamos el modelo materia y curso para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.materia.editar_materia')->with('materia', $materia)->with('curso', $curso);
    }

    /**
     * Función que permite actualizar una materia en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $curs_id    Id del curso al que pertenece la materia a editar.
     * @param  int  $mate_id    Id de la materia a editar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curs_id, $mate_id)
    {
        // Verificamos que el curso exista en bd, si no es así informamos al usuario y redireccionamos.
        $curso = Curso::find($curs_id);
        if (!isset($curso)) {
            flash('El curso con ID: '.$curs_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso');
        }
        // Verificamos que exista la materia en bd, si no es así, informamos al usuario y redireccionamos.
        $materia = Materia::find($mate_id);
        if (!isset($curso)) {
            flash('La materia con ID: '.$mate_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
        }
        // Validar solo 2 campos del formulario.
        Validator::make($request->all(), [
           'mate_nombre' => 'required|max:100',
           'mate_tema'   => 'required|max:1000'
        ])->validate();
        //obtenemos el campo file definido en el formulario
        $file = $request->file('mate_rutaarchivo');
        // Si existe y no es nulo $file es porque el usuario seleccionó un archivo en el formulario.
        if(isset($file)){
            //obtenemos el nombre del archivo
            $nombreArchivo = $file->getClientOriginalName();
            // Obtengo más información del archivo de la materia. ver: http://php.net/manual/es/function.pathinfo.php
            $infoArchivo = pathinfo($materia->mate_rutaarchivo);
            // Compruebo que exista el archivo en el disco de materias.
            if(Storage::disk('materias')->exists($infoArchivo['basename'])){
                // Si existe el archivo procedo a eliminarlo, retorna true si fue exitoso, de lo contrario retorna false.
                $eliminacionArchivo = Storage::disk('materias')->delete($infoArchivo['basename']);
                if($eliminacionArchivo){
                    // Una vez eliminado el archivo, almaceno el nuevo archivo en el disco materias
                    $path = Storage::disk('materias')->put('/', $file);
                }else {
                    // Si no se pudo eliminar el archivo anterior, informo al usuario y redireccionamos.
                    flash('No se pudo eliminar el archivo asociado a la materia "'.$materia->mate_nombre.'"', 'danger');
                    return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
                }
            }
        }
        // Asignamos el nuevo nombre de la materia y el nuevo tema.
        $materia->mate_nombre = $request->input('mate_nombre');
        $materia->mate_tema   = $request->input('mate_tema');
        // Si existe $path y $nombreArchivo es porque el usuario está cargando un nuevo archivo,
        // almaceno la nueva ruta y nombre del archivo en bd.
        if(isset($path,$nombreArchivo)){
            $materia->mate_rutaarchivo = asset('storage/materias/'.$path);
            $materia->mate_nombrearchivo = $nombreArchivo;
        }
        // Guardo los cambios en el modelo.
        $materia->save();
        // Informo al usuairo y redireccionamos.
        flash('Materia "'.$materia->mate_nombre.'" editada con éxito.', 'success');
        return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
    }

    /**
     * Función que permite eliminar una Materia incluyendo su archivo asociado si existe en el sistema de archivos.
     *
     * @param  string $curs_id id del curso al que pertenece la materia a eliminar.
     * @param  string $mate_id id de la materia a eliminar.
     * @return \Illuminate\Http\Response se realiza una redirección incluyendo un mensaje de éxito o error.
     */
    public function destroy($curs_id = "", $mate_id = "")
    {
        // Busco la materia a eliminar.
        $materia = Materia::find($mate_id);
        // Obtengo más información del archivo de la materia. ver: http://php.net/manual/es/function.pathinfo.php
        $infoArchivo = pathinfo($materia->mate_rutaarchivo);
        // Bandera que indicará si se eliminó o no el archivo.
        $eliminacionArchivo = true;
        // Compruebo que exista el archivo en el disco de materias.
        if(Storage::disk('materias')->exists($infoArchivo['basename'])){
            // Si existe el archivo procedo a eliminarlo, retorna true si fue exitoso, de lo contrario retorna false.
            $eliminacionArchivo = Storage::disk('materias')->delete($infoArchivo['basename']);
        }
        // Si no se pudo eliminar el archivo por cualquier motivo, le informo al usuario.
        if($eliminacionArchivo == false){
            flash('No se pudo eliminar el archivo asociado a la materia "'.$materia->mate_nombre.'"', 'danger');
        }else{
            // Si se eliminó el archivo o no existía en el disco procedo a eliminar la materia.
            $materia->delete();
            // Mensaje para el usuario indicando la eliminación exitosa.
            flash('Materia "'.$materia->mate_nombre.'" eliminada con éxito.', 'success');
        }
        // Cualquiera que sea el caso, de éxito o error es redirigido a la vista del curso.
        return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
    }
}
