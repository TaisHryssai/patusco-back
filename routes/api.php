<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeAnimalController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Auth\AuthController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    ['prefix' => '/api', 'as' => 'api'],
    function () {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

        Route::controller(RoleController::class)->group(function () {
            Route::get('roles', 'index')->name('roles.index');
        });

        Route::controller(TypeAnimalController::class)->group(function () {
            Route::get('type_animals', 'index')->name('type_animals.index');
            Route::get('type_animals/{animal_id}', 'show')->name('type_animals.show');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index')->name('users.index');
            Route::get('users/listClients', 'listClients')->name('users.listClients');
            Route::get('users/listReceptionist', 'listReceptionist')->name('users.listReceptionist');
            Route::get('users/listDoctor', 'listDoctor')->name('users.listDoctor');
            Route::post('users/register', 'register')->name('users.register');
            Route::get('users/{user_id}', 'show')->name('users.show');
            Route::put('users/{user_id}/update', 'update')->name('users.update');
            Route::delete('users/{user_id}', 'destroy')->name('users.destroy');
            Route::get('users/{user_id}/animals', 'listAnimals')->name('users.listAnimals');
        });

        Route::controller(AnimalController::class)->group(function () {
            Route::get('animals', 'index')->name('animals.index');
            Route::post('animals/register', 'register')->name('animals.register');
            Route::get('animals/{animal_id}', 'show')->name('animals.show');
            Route::put('animals/{animal_id}/update', 'update')->name('animals.update');
            Route::delete('animals/{animal_id}', 'destroy')->name('animals.destroy');
        });

        Route::controller(AgendaController::class)->group(function () {
            Route::get('agenda/{role_id}', 'index')->name('agenda.index');
            Route::post('agenda/register', 'register')->name('agenda.register');
            Route::get('agenda/{agenda_id}', 'show')->name('agenda.show');
            Route::put('agenda/{agenda_id}/update', 'update')->name('agenda.update');
            Route::delete('agenda/{agenda_id}', 'destroy')->name('agenda.destroy');
        });
    }
);