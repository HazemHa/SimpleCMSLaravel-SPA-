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


Route::prefix('api/')->group(function () {
    Route::post('/checkToken', 'UsersController@checkToken');
    Route::post('/singin', 'UsersController@singin');
    Route::post('/singup', 'UsersController@singup');
    Route::post('/logout', 'UsersController@logout');
    Route::post('/profile', 'UsersController@profile');
    Route::post('/storePost','PostsController@store');
    //  Route::get('profile/{id}', 'UsersController@profile');
});
Route::get('test/test/{id}', function ($id) {
    return bcrypt("123123");
});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

/*
Route::get('/admin', function () {
    return view('welcome');
});
*/

// return single page for all requests.....
/*
Route::get('', 'SPAController@Index')
*/
Auth::routes();
