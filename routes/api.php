<?php
use App\Http\Controllers\Nomenclature\UploadController;
use App\Http\Controllers\Nomenclature\FilesController;
use App\Http\Controllers\Dispatch\DispatchController;
use App\Http\Controllers\Clients\ClientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([ 'prefix' => 'clients'], function () {
    Route::get('', [ClientsController::class, 'getClients']);
    Route::post('', [ClientsController::class, 'createClients']);
    Route::get('/count', [ClientsController::class, 'getCountClients']);

});
Route::group([ 'prefix' => 'dispatch'], function () {
    Route::post('', [DispatchController::class, 'create']);
    Route::get('', [DispatchController::class, 'statistic']);
});

