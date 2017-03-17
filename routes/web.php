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
    Route::get('/curso/{curs_id}/taller/ver/{id?}', 'TallerController@show')->name('profesor.curso.taller.ver');
    Route::get('/curso/{curs_id}/taller/editar/{id?}', 'TallerController@edit')->name('profesor.curso.taller.editar');
    Route::put('/curso/curs_id/taller/editar/{id?}', 'TallerController@update')->name('profesor.curso.taller.editar.put');
    Route::delete('/curso/{curs_id}/taller/eliminar/{id?}', 'TallerController@destroy')->name('profesor.curso.taller.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para las preguntas
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/inicio', 'PreguntasController@index')->name('profesor.curso.taller.pregunta');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/crear', 'PreguntasController@create')->name('profesor.curso.taller.pregunta.crear');
    Route::post('/curso/{curs_id}/taller/{tall_id}/pregunta/crear', 'PreguntasController@store')->name('profesor.curso.taller.crearpregunta.post');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/ver/{id?}', 'PreguntasController@show')->name('profesor.curso.taller.pregunta.ver');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/editar/{id?}', 'PreguntasController@edit')->name('profesor.curso.taller.pregunta.editar');
    Route::put('/curso/{curs_id}/taller/{tall_id}/pregunta/editar/{id?}', 'PreguntasController@update')->name('profesor.curso.taller.pregunta.put');
    Route::get('/curso/{curs_id}/taller/{tall_id}/pregunta/eliminar/{id?}', 'PreguntasController@destroy')->name('profesor.curso.taller.pregunta.eliminar');

    /*
    |--------------------------------------------------------------------------
    | Rutas para los cursos
    |--------------------------------------------------------------------------
    */

    Route::get('/curso/inicio', 'CursoController@index')->name('profesor.curso');
    Route::get('/curso/crear', 'CursoController@create')->name('profesor.crearcurso');
    Route::post('/curso/crear', 'CursoController@store')->name('profesor.crearcurso.post');
    Route::get('/curso/ver/{id}', 'CursoController@show')->name('profesor.curso.ver');
    Route::get('/curso/editar/{id}', 'CursoController@edit')->name('profesor.curso.editar');
    Route::put('/curso/editar/{id}', 'CursoController@update')->name('profesor.curso.put');
    Route::get('/curso/eliminar/{id}', 'CursoController@destroy')->name('profesor.curso.eliminar');

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
    /* Ver una materia en específico de un curso.
     * Esta ruta no es necesaria, debido a que en el datatable de la materia,
     * se puede ver toda la información de la materia, no hay necesidad de una nueva página.
     *
     * Route::get('/curso/{curs_id}/materias/ver/{mate_id}', 'MateriaController@show')->name('profesor.curso.materia.ver');
     */
    /* Editar una materia en específico de un curso */
    Route::get('/curso/{curs_id}/materias/editar/{mate_id}', 'MateriaController@edit')->name('profesor.curso.materia.editar');
    Route::put('/curso/{curs_id}/materias/editar/{mate_id}', 'MateriaController@update')->name('profesor.curso.materia.editar.put');
    /* Eliminar una materia en específico de un curso */
    Route::delete('/curso/{curs_id}/materias/eliminar/{mate_id}', 'MateriaController@destroy')->name('profesor.curso.materia.eliminar');
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
