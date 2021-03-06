<?php

use Illuminate\Database\Console\Migrations\RollbackCommand;
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

Route::get('/', function () {
    return view('welcome');
});

// ---------------------Front-End------------------------------------------------------------------
Route::get('/main', function () {
    return view('main');
});
Route::get('/main', 'HomeController@index_frontend');
Route::get('/building/{id}', 'HomeController@building_index');
Route::get('/building/deital/{building_id}/{level_id}', 'HomeController@building_detail');
// ------------------------------------------------------------------------------------------------

Auth::routes();

Route::get('/home', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin');
});

// Route::get('/notify', function () {
//     return view('notify');
// });
Route::resource('notify', 'NotifyController');

Route::get('/modelnotify', function () {
    // $post = App\notify::where('performance','<=',2);
    // return $post;
    // $post = App\notify::where('performance',2)->first();
    // return $post;
    // return view('modelnotify');
    // return App\notify::all();
    // $post = App\notify::where('id', 1)
    // ->orderBy('id')
    // ->all();
    $post = App\notify::where('performance','<',3);
    return $post;
});

Route::get('/levelon/{id}', 'StatusairController@poweron');
Route::get('/leveloff/{id}', 'StatusairController@poweroff');

Route::get('/getpdf', 'PDFController@getPDF');

Route::get('/home', 'StatusairController@chartstatus');
Route::get('/ajax_get_data_room_detail/{id}', 'StatusairController@room_detail');

Route::resource('user', 'UsersController');
Route::resource('adminuser', 'UsersController');

Route::resource('level', 'LevelController');
Route::resource('adminlevel', 'LevelController');

Route::resource('status', 'StatusairController');
Route::resource('adminstatus', 'StatusairController');

Route::resource('buildings', 'BuildingController');
Route::resource('adminbuilding', 'BuildingController');
