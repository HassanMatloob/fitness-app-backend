<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('demo/users', UserController::class);

    $router->resource('categories', CategoryController::class);

    $router->resource('exercises', ExerciseController::class);

    $router->resource('exercise-videos', ExerciseVideosController::class);

});
