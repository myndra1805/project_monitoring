<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectLeaderController;
use App\Http\Controllers\ProjectMonitoringController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PagesController::class, 'index']);

Route::prefix('/project-monitoring')->group(function(){
    Route::get('/', [PagesController::class, 'project']);
    Route::get('/read', [ProjectMonitoringController::class, 'read']);
    Route::get('/create', [ProjectMonitoringController::class, 'showCreate']);
    Route::get('/update/{id}', [ProjectMonitoringController::class, 'showUpdate']);
    Route::post('/create', [ProjectMonitoringController::class, 'create']);
    Route::put('/update', [ProjectMonitoringController::class, 'update']);
    Route::delete('/delete', [ProjectMonitoringController::class, 'delete']);
});

Route::prefix('/project-leader')->group(function(){
    Route::get('/', [PagesController::class, 'project_leader']);
    Route::get('/read', [ProjectLeaderController::class, 'read']);
    Route::get('/update/{id}', [ProjectLeaderController::class, 'showUpdate']);
    Route::get('/create', [ProjectLeaderController::class, 'showcCreate']);
    Route::post('/create', [ProjectLeaderController::class, 'create']);
    Route::put('/update', [ProjectLeaderController::class, 'update']);
    Route::delete('/delete', [ProjectLeaderController::class, 'delete']);
});
