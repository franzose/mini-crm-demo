<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

// Аутентификация
Route::group(['prefix' => 'auth'], function() {

    // Страница входа
    Route::get('login', [
        'as'    => 'auth.login.form',
        'uses'  => 'Crm\AuthController@getLogin'
    ]);

    // Вход
    Route::post('login', [
        'as'    => 'auth.login.do',
        'uses'  => 'Crm\AuthController@postLogin'
    ]);

    // Выход
    Route::get('logout', [
        'as'    => 'auth.logout.do',
        'uses'  => 'Crm\AuthController@logout'
    ]);
});

// Роуты для CRM
Route::group(['prefix' => 'crm', 'middleware' => ['auth', 'crm.primary-nav']], function() {

    $crm_resource = function($resource) {
        $prefix = 'crm.' . $resource;

        return [
            'index'   => $prefix . '.index',
            'create'  => $prefix . '.create',
            'store'   => $prefix . '.store',
            'show'    => $prefix . '.show',
            'edit'    => $prefix . '.edit',
            'update'  => $prefix . '.update',
            'destroy' => $prefix . '.destroy'
        ];
    };

    // События
    Route::resource('customer-event', 'Crm\CustomerEventsController', [
        'names' => $crm_resource('customer-event'),
        'except' => ['show']
    ]);

    // Фильтр событий
    Route::get('customer-event/filter', [
        'as'    => 'crm.customer-event.filter',
        'uses'  => 'Crm\CustomerEventsController@filter'
    ]);

    // Статусы переговоров
    Route::resource('customer-status', 'Crm\CustomerStatusesController', [
        'names' => $crm_resource('customer-status')
    ]);

    // Типы событий
    Route::resource('customer-event-type', 'Crm\CustomerEventTypesController', [
        'names' => $crm_resource('customer-event-type')
    ]);

    // Профиль залогиненного пользователя
    Route::group(['prefix' => 'profile'], function() {

        // Редактирование профиля
        Route::get('edit', [
            'as'    => 'crm.profile.edit',
            'uses'  => 'Crm\ProfileController@edit'
        ]);

        // Обновление профиля
        Route::put('/', [
            'as'    => 'crm.profile.update',
            'uses'  => 'Crm\ProfileController@update'
        ]);
    });

    // Редактирование пользователей (только для админов)
    Route::resource('user', 'Crm\UsersController', [
        'names' => $crm_resource('user')
    ]);

    // Роли пользователей
    Route::resource('role', 'Crm\RolesController', [
        'names' => $crm_resource('role')
    ]);

    // Заказчики
    Route::resource('customer', 'Crm\CustomersController', [
        'names' => $crm_resource('customer')
    ]);

    // Категории предприятий
    Route::resource('customer-category', 'Crm\CustomerCategoriesController', [
        'names' => $crm_resource('customer-category')
    ]);
});
