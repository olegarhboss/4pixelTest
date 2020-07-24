<?php

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

// Локализированные маршруты
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect'
    ]], function () {
        // Маршруты авторизации
        Auth::routes();

        // Маршруты защищенные аутентификацией
        Route::middleware(['auth'])->group(function () {
            
            // Точка входа в приложение
            Route::get('/', 'ShowDashboard')->name('dashboard');
            
            // Управление разделом Отделы (App\Models\Departament)
            Route::resource('departaments', 'DepartamentController')->except('show');

            // Управление разделом Пользователи (App\User)
            Route::resource('users', 'UserController')->except('show');
        });
});
