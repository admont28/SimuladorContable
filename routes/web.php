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

    Route::get('/taller/inicio', 'TallerController@index')->name('profesor.taller');
    Route::get('/taller/crear', 'TallerController@create')->name('profesor.creartaller');
    Route::post('/taller/crear', 'TallerController@store')->name('profesor.creartaller.post');
    Route::get('/taller/ver/{id?}', 'TallerController@show')->name('profesor.taller.ver');
    Route::get('/taller/editar/{id?}', 'TallerController@edit')->name('profesor.taller.editar');
    Route::put('/taller/editar/{id?}', 'TallerController@update')->name('profesor.taller.put');
    Route::get('/taller/eliminar/{id?}', 'TallerController@destroy')->name('profesor.taller.eliminar');

    Route::get('/pregunta/inicio', 'PreguntasController@index')->name('profesor.pregunta');
    Route::get('/pregunta/crear', 'PreguntasController@create')->name('profesor.crearpregunta');
    Route::post('/pregunta/crear', 'PreguntasController@store')->name('profesor.crearpregunta.post');
    Route::get('/pregunta/ver/{id?}', 'PreguntasController@show')->name('profesor.pregunta.ver');
    Route::get('/pregunta/editar/{id?}', 'PreguntasController@edit')->name('profesor.pregunta.editar');
    Route::put('/pregunta/editar/{id?}', 'PreguntasController@update')->name('profesor.pregunta.put');
    Route::get('/pregunta/eliminar/{id?}', 'PreguntasController@destroy')->name('profesor.pregunta.eliminar');



    Route::get('/curso/inicio', 'CursoController@index')->name('profesor.curso');
    Route::get('/curso/crear', 'CursoController@create')->name('profesor.crearcurso');
    Route::post('/curso/crear', 'CursoController@store')->name('profesor.crearcurso.post');
    Route::get('/curso/ver/{id?}', 'CursoController@show')->name('profesor.curso.ver');
    Route::get('/curso/editar/{id?}', 'CursoController@edit')->name('profesor.curso.editar');
    Route::put('/curso/editar/{id?}', 'CursoController@update')->name('profesor.curso.put');
    Route::get('/curso/eliminar/{id?}', 'CursoController@destroy')->name('profesor.curso.eliminar');
    // Route::get('/curso/temas/{curs_id}', 'CursoController@ver_temas_por_curso')->name('profesor.curso.tema.ver');
    Route::get('/curso/temas/ajax/{curs_id}', 'CursoController@ver_temas_por_curso_ajax')->name('profesor.curso.tema.verajax');

    Route::get('/curso/temas/crear/{curs_id}', 'TemaController@create')->name('profesor.curso.tema.crear');
    Route::post('/curso/temas/crear/{curs_id}', 'TemaController@store')->name('profesor.curso.tema.crear.post');


    Route::get('/tema/inicio', 'TemaController@index')->name('profesor.tema');
    Route::get('/tema/crear', 'TemaController@create')->name('profesor.creartema');

    Route::get('/tema/ver/{id?}', 'TemaController@show')->name('profesor.tema.ver');

    Route::get('/tema/editar/{id?}', 'TemaController@edit')->name('profesor.tema.editar');
    Route::put('/tema/editar/{id?}', 'TemaController@update')->name('profesor.tema.put');
    Route::get('/tema/eliminar/{id?}', 'TemaController@destroy')->name('profesor.tema.eliminar');


    /*Route::get('/temas/crear',['as'=>'profesor.creartema', function(){
        return view('profesor.tema.crear_tema');
    }]);

    Route::get('/temas/inicio',['as'=>'profesor.tema', function(){
        return view('profesor.tema.index');
    }]);

    Route::get('/temas/ver',['as'=>'profesor.vertemas', function(){
        return view('profesor.tema.ver_tema');
    }]);*/

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
