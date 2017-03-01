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

    Route::get('/taller/crear',['as'=>'profesor.creartaller', function(){
    return view('profesor.taller.crear_taller');
    }]);

    Route::get('/taller/vertalleres',['as'=>'profesor.vertalleres', function(){
    return view('profesor.taller.ver_taller');
    }]);

    Route::get('/curso/inicio', 'CursoController@index')->name('profesor.curso');
    Route::get('/curso/crear', 'CursoController@create')->name('profesor.crearcurso');
    Route::post('/curso/crear', 'CursoController@store')->name('profesor.crearcurso.post');
    Route::get('/curso/ver/{id?}', 'CursoController@show')->name('profesor.curso.ver');
    Route::get('/curso/editar/{id?}', 'CursoController@edit')->name('profesor.curso.editar');
    Route::put('/curso/update/{id?}', 'CursoController@update')->name('profesor.curso.editar.Put');
    Route::get('/curso/eliminar/{id?}', 'CursoController@destroy')->name('profesor.curso.eliminar');




    Route::get('/temas/crear',['as'=>'profesor.creartema', function(){
    return view('profesor.tema.crear_tema');
    }]);

    Route::get('/temas/inicio',['as'=>'profesor.tema', function(){
    return view('profesor.tema.index');
    }]);

    Route::get('/temas/ver',['as'=>'profesor.vertemas', function(){
    return view('profesor.tema.ver_tema');
    }]);

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
