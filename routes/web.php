<?php


/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Str; // import library Str
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Laravel\Lumen\Http\Request as HttpRequest;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses'=> 'AuthController@register']);
    $router->post('/login', ['uses'=> 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses' => 'MahasiswaController@getAllMahasiswa']);
    $router->group(['middleware' => 'jwt.auth'], function () use ($router) {
        $router->get('/profile', ['uses' => 'MahasiswaController@getUser']);
        $router->post('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@addMatkulMhs']);
        $router->put('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@delMatkulMhs']);
    });
    $router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaById']);
});

$router->group(['prefix' => 'prodi'], function () use ($router) {
    $router->get('/', ['uses' => 'ProdiController@getAllProdi']);
});

$router->group(['prefix' => 'matakuliah'], function () use ($router) {
    $router->get('/', ['uses' => 'MatkulController@getAllMatkul']);
});

$router->get('/home', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@index']);