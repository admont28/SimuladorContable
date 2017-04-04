<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Taller;
use App\Tarifa;
use Validator;

class TarifaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curs_id, $tall_id)
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
            return redirect()->route('profesor.curso.ver', ['id' => $curs_id]);
        }
        return View('profesor.curso.taller.tarifa.crear_tarifa')
                ->with('curso', $curso)
                ->with('taller', $taller);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curs_id, $tall_id)
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
        // Validamos los campos del formulario.
        Validator::make($request->all(), [
           'nombre_tarifa' => 'required|max:100',
           'valor_tarifa' => 'required|max:30'
        ])->validate();
        // Creamos la tarifa y la almacenamos en bd
        Tarifa::create([
            'tari_nombre' => $request['nombre_tarifa'],
            'tari_valor'  => $request['valor_tarifa'],
            'tall_id'     => $tall_id
        ]);
        // Informo al usuario y redireccionamos.
        flash('La tarifa "'.$request['nombre_tarifa'].'" ha sido creada con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver',['curs_id'=> $curso->curs_id, 'tall_id' => $taller->tall_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($curs_id, $tall_id, $tari_id)
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
        // Verificamos que exista la tarifa en bd, si no es así, informamos al usuario y redireccionamos.
        $tarifa = Tarifa::find($tari_id);
        if (!isset($tarifa)) {
            flash('La tarifa con ID: '.$tari_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Retornamos la vista para editr la tarifa,
        // y le enviamos el modelo curso y taller para que cargue la información almacenada en bd
        // en los campos del formulario.
        return View('profesor.curso.taller.tarifa.editar_tarifa')
                    ->with('curso', $curso)
                    ->with('taller', $taller)
                    ->with('tarifa', $tarifa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curs_id, $tall_id, $tari_id)
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
        // Verificamos que exista la tarifa en bd, si no es así, informamos al usuario y redireccionamos.
        $tarifa = Tarifa::find($tari_id);
        if (!isset($tarifa)) {
            flash('La tarifa con ID: '.$tari_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        // Validamos los campos del formulario.
        Validator::make($request->all(), [
           'nombre_tarifa' => 'required|max:100',
           'valor_tarifa' => 'required|max:30'
        ])->validate();
        $tarifa->tari_nombre = $request['nombre_tarifa'];
        $tarifa->tari_valor  = $request['valor_tarifa'];
        $tarifa->save();
        flash('Tarifa: "'.$request['nombre_tarifa'].'" editada con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($curs_id, $tall_id, $tari_id)
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
        // Verificamos que exista la tarifa en bd, si no es así, informamos al usuario y redireccionamos.
        $tarifa = Tarifa::find($tari_id);
        if (!isset($tarifa)) {
            flash('La tarifa con ID: '.$tari_id.' no existe. Verifique por favor.', 'danger');
            return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
        }
        $tarifa->delete();
        flash('Tarifa: "'.$tarifa->tari_nombre.'" eliminada con éxito.', 'success');
        return redirect()->route('profesor.curso.taller.ver', ['curs_id' => $curs_id, 'tall_id' => $tall_id]);
    }
}
