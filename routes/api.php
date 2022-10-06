<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsersApiController;
use App\Http\Controllers\Api\AlbumsApiController;
use App\Http\Controllers\Api\PhotosApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
    RESTful Api - HTTP metode za tablicu "Users"
    GET /api/users           - dohvaća sve korisnike
    GET /api/users/{id}      - dohvaća pojedinog korisnika po njegovom ID-u
    POST /api/users          - kreira novog korisnika
    PUT /api/users/{id}      - ažurira postojeđeg korisnika putem njegova ID-a
    DELETE /api/users/{id}   - briše korisnika putem njegova ID-a
    Sve podatke dostavlja u json formatu
*/
Route::get('/users', [UsersApiController::class, 'index']);
Route::get('/users/{user}', [UsersApiController::class, 'getSingleUser']);
Route::post('/users', [UsersApiController::class, 'store']);
Route::put('/users/{user}', [UsersApiController::class, 'update']);
Route::delete('/users/{user}', [UsersApiController::class, 'destroy']);


/*
    RESTful Api - HTTP metode za tablicu "Albums"
    GET /api/albums               - dohvaća sve albume
    GET /api/albums/{id}          - dohvaća pojedini album po njegovom ID-u
    POST /api/albums              - kreira novi album
    PUT /api/albums/{id}          - ažurira postojeći album putem njegovog ID-a
    DELETE /api/albums/{id}       - briše album putem njegovog ID-a
    Sve podatke dostavlja u json formatu
*/
Route::get('/albums', [AlbumsApiController::class, 'index']);
Route::get('/albums/{album}', [AlbumsApiController::class, 'getSingleAlbum']);
Route::post('/albums', [AlbumsApiController::class, 'store']);
Route::put('/albums/{album}', [AlbumsApiController::class, 'update']);
Route::delete('/albums/{album}', [AlbumsApiController::class, 'destroy']);

/*
    RESTful Api - HTTP metode za tablicu "Photos"
    GET /api/songs           - dohvaća sve pjesme
    GET /api/songs/{id}      - dohvaća pojedinu pjesmu po ID-u
    POST /api/songs          - kreira novu pjesmu
    PUT /api/songs/{id}      - ažurira postojeću pjesmu putem ID-a
    DELETE /api/songs/{id}   - briše pjesmu putem ID-a
    Sve podatke dostavlja u json formatu
*/
Route::get('/songs', [PhotosApiController::class, 'index']);
Route::get('/songs/{song}', [PhotosApiController::class, 'getSingleSong']);
Route::post('/songs', [PhotosApiController::class, 'store']);
Route::put('/songs/{song}', [PhotosApiController::class, 'update']);
Route::delete('/songs/{song}', [PhotosApiController::class, 'destroy']);