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

/**
 * only auth users
 */
Route::group(['middleware' => ['auth', 'active_user']], function () {
    Route::get('/', 'BrowseIdeasController@index')->name('main');
    Route::get('/priority-board', 'BrowseIdeasController@priorityBoard')->name('priority-board');
    Route::get('/add-idea', 'IndexController@addIdea')->name('add-idea');
    Route::post('/add-idea', 'IndexController@createIdea');
    Route::get('/success', 'IndexController@success')->name('add-idea-success');
    Route::get('/review-idea/{id}', 'ReviewIdeaController@index')->where('id', '[0-9]+')->name('review-idea');
    Route::get('/about', 'AboutController@index')->name('about');

    Route::group([
        'as' => 'profile.',
        'prefix' => 'profile'
    ], function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::post('/update', 'ProfileController@update')->name('update');
        Route::post('/change-pass', 'ProfileController@changePass')->name('change-pass');
    });


    //superadmin or admin
    Route::group(['middleware' => ['role:admin|superadmin']], function() {
        Route::post('/pin-priority/{id}', 'ReviewIdeaController@pinToPriority')->where('id', '[0-9]+')->name('pin-priority');
        Route::get('/unpin-priority/{id}', 'ReviewIdeaController@unpinToPriority')->where('id', '[0-9]+')->name('unpin-priority');
        Route::post('/change-priority-reason/{id}', 'ReviewIdeaController@changePriorityReason')->where('id', '[0-9]+')->name('change-priority-reason');
        Route::post('/change-status/{id}', 'EditIdeaController@changeStatus')->where('id', '[0-9]+')->name('change-status');
    });

    //superadmin
    Route::group(['middleware' => ['role:superadmin']], function() {
        Route::get('/edit-idea/{id}', 'EditIdeaController@edit')->where('id', '[0-9]+')->name('edit-idea');
        Route::post('/edit-idea/{id}', 'EditIdeaController@postEdit')->where('id', '[0-9]+');
        Route::post('/review-idea/{id}', 'ReviewIdeaController@approve')->where('id', '[0-9]+');
        Route::get('/pending-review', 'BrowseIdeasController@pendingReview')->name('pending-review');
        Route::get('/declined', 'BrowseIdeasController@declined')->name('declined');

        Route::group([
            'as' => 'users.',
            'prefix' => 'users'
        ], function () {
            Route::get('/', 'UsersController@index')->name('index');
            Route::get('/create', 'UsersController@create')->name('create');
            Route::post('/create', 'UsersController@saveNew');
            Route::get('/edit/{id}', 'UsersController@edit')->where('id', '[0-9]+')->name('edit');
            Route::post('/update/{id}', 'UsersController@update')->where('id', '[0-9]+')->name('update');
        });

        //categories
        Route::group([
            'as' => 'categories.',
            'prefix' => 'categories'
        ], function () {
            Route::get('/', 'Categories\IndexController@index')->name('index');

            //statuses
            Route::group([
                'as' => 'statuses.',
                'prefix' => 'statuses'
            ], function () {
                Route::get('/', 'Categories\StatusController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\StatusController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\StatusController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\StatusController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\StatusController@create')->name('create');
                Route::post('/create', 'Categories\StatusController@saveNew');
            });

            //core-competency
            Route::group([
                'as' => 'core-competency.',
                'prefix' => 'core-competency'
            ], function () {
                Route::get('/', 'Categories\CoreCompetencyController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\CoreCompetencyController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\CoreCompetencyController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\CoreCompetencyController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\CoreCompetencyController@create')->name('create');
                Route::post('/create', 'Categories\CoreCompetencyController@saveNew');
            });

            //operational-goal
            Route::group([
                'as' => 'operational-goal.',
                'prefix' => 'operational-goal'
            ], function () {
                Route::get('/', 'Categories\OperationalGoalController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\OperationalGoalController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\OperationalGoalController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\OperationalGoalController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\OperationalGoalController@create')->name('create');
                Route::post('/create', 'Categories\OperationalGoalController@saveNew');
            });

            //strategic_objective
            Route::group([
                'as' => 'strategic-objective.',
                'prefix' => 'strategic-objective'
            ], function () {
                Route::get('/', 'Categories\StrategicObjectiveController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\StrategicObjectiveController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\StrategicObjectiveController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\StrategicObjectiveController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\StrategicObjectiveController@create')->name('create');
                Route::post('/create', 'Categories\StrategicObjectiveController@saveNew');
            });

            //type
            Route::group([
                'as' => 'type.',
                'prefix' => 'type'
            ], function () {
                Route::get('/', 'Categories\TypeController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\TypeController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\TypeController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\TypeController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\TypeController@create')->name('create');
                Route::post('/create', 'Categories\TypeController@saveNew');
            });

            //department
            Route::group([
                'as' => 'department.',
                'prefix' => 'department'
            ], function () {
                Route::get('/', 'Categories\DepartmentController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\DepartmentController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\DepartmentController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\DepartmentController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\DepartmentController@create')->name('create');
                Route::post('/create', 'Categories\DepartmentController@saveNew');
            });

            //position
            Route::group([
                'as' => 'position.',
                'prefix' => 'position'
            ], function () {
                Route::get('/', 'Categories\PositionController@index')->name('index');
                Route::get('/edit/{id}', 'Categories\PositionController@edit')->where('id', '[0-9]+')->name('edit');
                Route::post('/edit/{id}', 'Categories\PositionController@update')->where('id', '[0-9]+');
                Route::get('/delete/{id}', 'Categories\PositionController@delete')->where('id', '[0-9]+')->name('delete');
                Route::get('/create', 'Categories\PositionController@create')->name('create');
                Route::post('/create', 'Categories\PositionController@saveNew');
            });
        });
    });
});


/**
 * guest routes
 */
//login routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Registration Routes...
Route::get('invite/{code}', 'Auth\RegisterController@showRegistrationForm')->name('invite');
Route::post('invite/{code}', 'Auth\RegisterController@register');