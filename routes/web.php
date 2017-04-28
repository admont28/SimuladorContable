<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Rutas generales.
 */
Route::get('/',function () {
    return redirect()->route('general.inicio');
});

Route::get('/inicio',[ 'as' => 'general.inicio', function(){
    return view('inicio');
}]);

Route::get('/informacion',['as' => 'general.informacion', function () {
    return view('informacion');
}]);

Route::resource('usuario','UsuariosController');

/*
Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();

    $url = $public_path.'/storage/materias/'.$archivo;

    dd($url);
    //dd(asset('storage/materias/'.$archivo));
    //$url = asset('storage/materias/'.$archivo);
    //dd(Storage::disk('materias')->exists($archivo));
    //verificamos si el archivo existe y lo retornamos
    if (Storage::disk('materias')->exists($archivo))
    {
       return response()->download($url,'descarga.xlsx');
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);

})->where('archivo', '.*');*/

/*
 * Rutas para el rol de estudiante.
 */
Route::group(['prefix' => 'estudiante', 'middleware' => ['auth','estudiante'] ], function(){

    Route::get('/',function () {
        return redirect()->route('estudiante.index');
    });

    Route::get('/inicio',['as' => 'estudiante.index', function () {
        return view('estudiante.index');
    }]);

    Route::get('/temasatratar',['as'=>'estudiante.temas', function(){
        return view('estudiante.temas');
    }]);

    /*
    |--------------------------------------------------------------------------
    | Rutas para los cursos
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/inicio', 'CursoController@indexEstudiante')->name('estudiante.curso');
    Route::get('/curso/inicio/ajax', 'CursoController@verCursosEstudiantesAjax')->name('estudiante.curso.verajax');
    Route::get('/curso/{curs_id}/introduccion', 'CursoController@verCursoEstudiante')->name('estudiante.curso.ver.introduccion');
    /*
    |--------------------------------------------------------------------------
    | Rutas para las materias
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/materias', 'CursoController@verMateriasPorCursoEstudiante')->name('estudiante.curso.ver.materias');
    /*
    |--------------------------------------------------------------------------
    | Rutas para los talleres
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/talleres-diagnosticos', 'CursoController@verTalleresDiagnosticoPorCursoEstudiante')->name('estudiante.curso.ver.talleresdiagnostico');
    Route::post('/curso/{curs_id}/taller/{tall_id}/enviar-respuestas', 'TallerController@solucionarTallerDiagnosticoTeoricoPost')->name('estudiante.curso.taller.solucionar.post');
    Route::get('/curso/{curs_id}/talleres-teoricos', 'CursoController@verTalleresTeoricosPorCursoEstudiante')->name('estudiante.curso.ver.talleresteorico');
    Route::get('/curso/{curs_id}/talleres-practicos', 'CursoController@verTalleresPracticosPorCursoEstudiante')->name('estudiante.curso.ver.tallerespractico');
    /*
    |--------------------------------------------------------------------------
    | Rutas para las preguntas
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/taller/{tall_id}/preguntas', 'PreguntaController@verPreguntasPorTaller')->name('estudiante.curso.ver.talleres.ver.preguntas');
    /*
    |--------------------------------------------------------------------------
    | Rutas para los PUC
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/puc/ajax', 'CursoController@verPucPorCursoAjax')->name('estudiante.curso.puc.verajax');
    /*
    |--------------------------------------------------------------------------
    | Rutas para las tarifas
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/taller/{tall_id}/tarifa/ajax', 'TallerController@verTarifasPorTaller')->name('estudiante.curso.taller.tarifa.verajax');

    /* Ver las materias con DataTables, este responde un objeto Datatables */
    Route::get('/curso/{curs_id}/materias/ajax', 'CursoController@verMateriasPorCursoAjaxEstudiante')->name('estudiante.curso.materia.verajax');
});

/*
 * Rutas para el rol de profesor.
 */
Route::group(['prefix' => 'profesor', 'middleware' => ['auth','profesor']], function(){

    Route::get('/',function () {
        return redirect()->route('profesor.index');
    });

    Route::get('/inicio',['as' => 'profesor.index', function () {
        return view('profesor.index');
    }]);

    /*
    |--------------------------------------------------------------------------
    | Rutas para los talleres
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/talleres/ajax', 'CursoController@verTalleresPorCursoAjax')->name('profesor.curso.taller.verajax');
    Route::get('/curso/{curs_id}/taller/inicio', 'TallerController@index')->name('profesor.curso.taller');
    Route::get('/curso/{curs_id}/taller/crear', 'TallerController@create')->name('profesor.curso.taller.crear');
    Route::post('/curso/{curs_id}/taller/crear', 'TallerController@store')->name('profesor.curso.taller.crear.post');
    Route::get('/curso/{curs_id}/taller/ver/{tall_id}', 'TallerController@show')->name('profesor.curso.taller.ver');
    Route::get('/curso/{curs_id}/taller/editar/{tall_id}', 'TallerController@edit')->name('profesor.curso.taller.editar');
    Route::put('/curso/{curs_id}/taller/editar/{tall_id}', 'TallerController@update')->name('profesor.curso.taller.editar.put');
    Route::delete('/curso/{curs_id}/taller/eliminar/{tall_id}', 'TallerController@destroy')->name('profesor.curso.taller.eliminar');
    /*
    |--------------------------------------------------------------------------
    | Rutas para los talleres de asientos contables
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/taller/{tall_id}/crear-taller-asientos-contables', 'TallerController@crearTallerAsientosContables')->name('profesor.curso.taller.crear.tallerasientocontable');
    Route::post('/curso/{curs_id}/taller/{tall_id}/crear-taller-asientos-contables-post', 'TallerController@crearTallerAsientosContablesPost')->name('profesor.curso.taller.crear.tallerasientocontable.post');

    /*
    |--------------------------------------------------------------------------
    | Rutas para los talleres de nomina
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/taller/{tall_id}/crear-taller-nomina', 'TallerController@crearTallerNomina')->name('profesor.curso.taller.crear.tallernomina');
    Route::post('/curso/{curs_id}/taller/{tall_id}/crear-taller-nomina-post', 'TallerController@crearTallerNominaPost')->name('profesor.curso.taller.crear.tallernomina.post');

    /*
    |--------------------------------------------------------------------------
    | Rutas para las preguntas
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/taller/{tall_id}/preguntas/ajax', 'TallerController@verPreguntasPorTaller')->name('profesor.curso.taller.pregunta.verajax');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/inicio', 'PreguntaController@index')->name('profesor.curso.taller.pregunta');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/crear', 'PreguntaController@create')->name('profesor.curso.taller.pregunta.crear');
    Route::post('/curso/{curs_id}/taller/{tall_id}/pregunta/crear', 'PreguntaController@store')->name('profesor.curso.taller.pregunta.crear.post');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/ver/{preg_id}', 'PreguntaController@show')->name('profesor.curso.taller.pregunta.ver');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/editar/{preg_id}', 'PreguntaController@edit')->name('profesor.curso.taller.pregunta.editar');
    Route::put('/curso/{curs_id}/taller/{tall_id}/pregunta/editar/{preg_id}', 'PreguntaController@update')->name('profesor.curso.taller.pregunta.editar.put');
    Route::delete('/curso/{curs_id}/taller/{tall_id}/pregunta/eliminar/{preg_id}', 'PreguntaController@destroy')->name('profesor.curso.taller.pregunta.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para las respuestas
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/ajax', 'PreguntaController@verRespuestasPorPregunta')->name('profesor.curso.taller.pregunta.respuesta.verajax');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/inicio', 'RespuestaController@index')->name('profesor.curso.taller.pregunta.respuesta');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/crear', 'RespuestaController@crearRespuestaMultipleUnica')->name('profesor.curso.taller.pregunta.respuesta.crear');
    Route::post('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/crear', 'RespuestaController@guardarRespuestaMultipleUnica')->name('profesor.curso.taller.pregunta.respuesta.crear.post');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/ver/{remu_id}', 'RespuestaController@show')->name('profesor.curso.taller.pregunta.respuesta.ver');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/editar/{remu_id}', 'RespuestaController@editarRespuestaMultipleUnica')->name('profesor.curso.taller.pregunta.respuesta.editar');
    Route::put('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/editar/{remu_id}', 'RespuestaController@actualizarRespuestaMultipleUnica')->name('profesor.curso.taller.pregunta.respuesta.editar.put');
    Route::delete('/curso/{curs_id}/taller/{tall_id}/pregunta/{preg_id}/respuesta/eliminar/{remu_id}', 'RespuestaController@eliminarRespuestaMultipleUnica')->name('profesor.curso.taller.pregunta.respuesta.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para las tarifas
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/taller/{tall_id}/tarifa/ajax', 'TallerController@verTarifasPorTaller')->name('profesor.curso.taller.tarifa.verajax');
    Route::get('/curso/{curs_id}/taller/{tall_id}/tarifa/crear', 'TarifaController@create')->name('profesor.curso.taller.tarifa.crear');
    Route::post('/curso/{curs_id}/taller/{tall_id}/tarifa/crear', 'TarifaController@store')->name('profesor.curso.taller.tarifa.crear.post');
    Route::get('/curso/{curs_id}/taller/{tall_id}/tarifa/editar/{tari_id}', 'TarifaController@edit')->name('profesor.curso.taller.tarifa.editar');
    Route::put('/curso/{curs_id}/taller/{tall_id}/tarifa/editar/{tari_id}', 'TarifaController@update')->name('profesor.curso.taller.tarifa.editar.put');
    Route::delete('/curso/{curs_id}/taller/{tall_id}/tarifa/eliminar/{tari_id}', 'TarifaController@destroy')->name('profesor.curso.taller.tarifa.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para los cursos
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/inicio', 'CursoController@index')->name('profesor.curso');
    Route::get('/curso/crear', 'CursoController@create')->name('profesor.curso.crear');
    Route::post('/curso/crear', 'CursoController@store')->name('profesor.curso.crear.post');
    Route::get('/curso/ver/{curs_id}', 'CursoController@show')->name('profesor.curso.ver');
    Route::get('/curso/editar/{curs_id}', 'CursoController@edit')->name('profesor.curso.editar');
    Route::put('/curso/editar/{curs_id}', 'CursoController@update')->name('profesor.curso.put');
    Route::delete('/curso/eliminar/{curs_id}', 'CursoController@destroy')->name('profesor.curso.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para los PUC
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/puc/ajax', 'CursoController@verPucPorCursoAjax')->name('profesor.curso.puc.verajax');
    Route::get('/curso/{curs_id}/puc/crear', 'PucController@create')->name('profesor.curso.puc.crear');
    Route::post('/curso/{curs_id}/puc/crear', 'PucController@store')->name('profesor.curso.puc.crear.post');
    Route::get('/curso/{curs_id}/puc-comercial/crear','PucController@asociarPucComercial')->name('profesor.curso.puc.comercial.crear');
    /*
    |--------------------------------------------------------------------------
    | Rutas para las materias
    |--------------------------------------------------------------------------
    */

    /* Ver las materias con DataTables, este responde un objeto Datatables */
    Route::get('/curso/{curs_id}/materias/ajax', 'CursoController@verMateriasPorCursoAjax')->name('profesor.curso.materia.verajax');
    /* Crear una materia, método get para ver el formulario y método post para guardar la nueva materia */
    Route::get('/curso/{curs_id}/materias/crear', 'MateriaController@create')->name('profesor.curso.materia.crear');
    Route::post('/curso/{curs_id}/materias/crear', 'MateriaController@store')->name('profesor.curso.materia.crear.post');
    /* Editar una materia, método get para vel el formulario y método put para guardar la edición de la materia */
    Route::get('/curso/{curs_id}/materias/editar/{mate_id}', 'MateriaController@edit')->name('profesor.curso.materia.editar');
    Route::put('/curso/{curs_id}/materias/editar/{mate_id}', 'MateriaController@update')->name('profesor.curso.materia.editar.put');
    /* Eliminar una materia en específico de un curso */
    Route::delete('/curso/{curs_id}/materias/eliminar/{mate_id}', 'MateriaController@destroy')->name('profesor.curso.materia.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para las calificaciones
    |--------------------------------------------------------------------------
    */
    Route::get('/curso/{curs_id}/taller/{tall_id}/usuarios/calificaciones', 'CalificacionController@mostrarUsuariosTaller')->name('profesor.curso.taller.pregunta.respuesta.calificacion');
    Route::get('/curso/{curs_id}/taller/{tall_id}/usuario/{usua_id}/calificaciones', 'CalificacionController@')->name('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante');


});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index');


// ruta para asignar el valor del Lenguaje
Route::group(['middleware' => ['web']], function () {

//Route::get('/lang/{lang}', function () {
//    return view('front.index');
//});

Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
]);

});
?>
