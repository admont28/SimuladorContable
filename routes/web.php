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
Route::get('/',['as' => 'front.index', function () {
    return redirect()->route('estudiante.index');
}]);

Route::get('/inicio', function(){
    return view('inicio');
});

Route::resource('usuario','UsuariosController');

/*
 * Rutas para el rol de estudiante.
 */
Route::group(['prefix' => 'estudiante', 'middleware' => ['auth','estudiante'] ], function(){

    Route::get('/',[function () {
        return redirect()->route('estudiante.index');
    }]);

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

    Route::get('/',[function () {
        return redirect()->route('profesor.index');
    }]);

    Route::get('/inicio',['as' => 'profesor.index', function () {
        return view('profesor.index');
    }]);

    Route::get('/temasatratar',['as'=>'profesor.temas', function(){
        return view('profesor.temas');
    }]);

    Route::get('/taller/inicio',['as'=>'profesor.taller', function(){
        return view('profesor.taller.taller');
    }]);

    Route::get('/taller/crear',['as'=>'profesor.creartaller', function(){
    return view('profesor.taller.crear_taller');
    }]);

    Route::get('/taller/vertalleres',['as'=>'profesor.vertalleres', function(){
    return view('profesor.taller.ver_taller');
    }]);

    Route::get('/informacion',['as' => 'profesor.informacion', function () {
        return view('profesor.informacion');
    }]);

    Route::get('/inicio',['as' => 'profesor.index', function () {
        return view('profesor.index');
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
