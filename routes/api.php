<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\Api\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function(){
	$return = ['msg' => 'Minha primeira resposta de API'];
	$msg = json_encode($return);
	$response = new Response($msg);
	$response->header('Content-Type', 'application/json');

	return $response;
});


Route::namespace('App\\Http\\Controllers\\Api\\')->group(function(){
	// Products	
	Route::prefix('products')->group(function() {
		Route::get('/', 'ProductController@index');
		Route::get('/{id}', 'ProductController@show');
		Route::post('/', 'ProductController@save')->middleware('auth.basic');
		Route::put('/', 'ProductController@update');
		Route::patch('/', 'ProductController@update');
		Route::delete('/{id}', 'ProductController@delete');		
	});
	Route::resource('/users', 'UserController');

});

