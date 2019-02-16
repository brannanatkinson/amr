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

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', 'TestController@index');
Route::post('test', 'TestController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'ajax'], function() {
	Route::post('/create_media', 'AjaxController@create_media'); //add new media
    Route::post('/get_urldata', 'AjaxController@get_urldata'); //check a URL and json with title and images
    Route::post('/get_projects', 'AjaxController@get_projects'); //retrieve projects where matches clientID
    Route::post('/create_project', 'AjaxController@create_project'); // add new project
    Route::post('/get_contacts', 'AjaxController@get_contacts'); // add new project
    Route::post('/loginlink', 'AjaxController@loginlink'); // check login link
});


Route::get('/stories', 'StoryController@index')->middleware(['auth'])->name('stories.index');
Route::post('/stories', 'StoryController@store')->name('stories.store')->middleware(['auth', 'role:siteadmin']);
Route::get('/stories/create', 'StoryController@create')->name('stories.create')->middleware(['auth', 'role:siteadmin']);
Route::get('/stories/{story}', 'StoryController@show')->name('stories.show')->middleware(['auth', 'role:siteadmin']);
Route::patch('/stories/{story}', 'StoryController@update')->name('stories.update')->middleware(['auth', 'role:siteadmin']);
Route::get('/stories/{story}/delete', 'StoryController@destroy')->name('stories.destroy')->middleware(['auth', 'role:siteadmin']);
Route::get('/stories/{story}/edit', 'StoryController@edit')->name('stories.edit')->middleware(['auth', 'role:siteadmin']);


Route::get('/projects/', 'ProjectController@index')->name('projects.index');
Route::post('/projects/', 'ProjectController@store')->name('projects.store')->middleware(['auth', 'role:siteadmin']);
Route::get('/projects/create', 'ProjectController@create')->name('projects.create')->middleware(['auth', 'role:siteadmin']);
Route::get('/projects/{project}', 'ProjectController@show')->name('projects.show')->middleware(['auth']);
Route::patch('/projects/{project}', 'ProjectController@update')->name('projects.update')->middleware(['auth', 'role:siteadmin']);
Route::delete('/projects/{project}', 'ProjectController@destroy')->name('projects.destroy')->middleware(['auth', 'role:siteadmin']);
Route::get('/projects/{project}/edit', 'ProjectController@edit')->name('projects.edit')->middleware(['auth', 'role:siteadmin']);

Route::get('/users', 'UserController@index')->middleware(['auth', 'role:siteadmin'])->name('user.index');
Route::get('/users/new', 'UserController@create')->middleware(['auth', 'role:siteadmin']);
Route::post('/users', 'UserController@store')->middleware(['auth', 'role:siteadmin']);
Route::get('/users/{id}/edit', 'UserController@edit')->middleware(['auth', 'role:siteadmin']);
Route::patch('/users/{id}', 'UserController@update')->name('user.update')->middleware(['auth', 'role:siteadmin']);
Route::get('/users/{id}/delete', 'UserController@destroy')->middleware(['auth', 'role:siteadmin']);

Route::get('/clients/', 'ClientController@index')->middleware(['auth', 'role:siteadmin']);
Route::post('/clients/', 'ClientController@store')->name('clients.store')->middleware(['auth', 'role:siteadmin']);
Route::get('/clients/create', 'ClientController@create')->name('clients.create')->middleware(['auth', 'role:siteadmin']);
Route::get('/clients/{client}', 'ClientController@show')->name('clients.show')->middleware(['auth', 'role:siteadmin']);
Route::patch('/clients/{client}', 'ClientController@update')->name('clients.update')->middleware(['auth', 'role:siteadmin']);
Route::delete('/clients/{client}', 'ClientController@destroy')->name('clients.destroy')->middleware(['auth', 'role:siteadmin']);
Route::get('/clients/{client}/edit', 'ClientController@edit')->name('clients.edit')->middleware(['auth', 'role:siteadmin']);

Route::get('/contacts/', 'ContactController@index')->middleware(['auth', 'role:siteadmin']);
Route::post('/contacts/', 'ContactController@store')->name('clients.store')->middleware(['auth', 'role:siteadmin']);
Route::get('/contacts/create', 'ContactController@create')->name('clients.create')->middleware(['auth', 'role:siteadmin']);
Route::get('/contacts/{contact}', 'ContactController@show')->name('clients.show')->middleware(['auth', 'role:siteadmin']);
Route::patch('/contacts/{contact}', 'ContactController@update')->name('clients.update')->middleware(['auth', 'role:siteadmin']);
Route::delete('/contacts/{contact}', 'ContactController@destroy')->name('clients.destroy')->middleware(['auth', 'role:siteadmin']);
Route::get('/contacts/{contact}/edit', 'ContactController@edit')->name('clients.edit')->middleware(['auth', 'role:siteadmin']);

Route::get('/admin/', function () {
    return view('admin.index');
})->middleware(['role:siteadmin', 'auth']);

// Clients admin routes
Route::group(['prefix' => 'admin/', 'middleware' => ['role:siteadmin', 'auth']], function() {
     Route::get('clients', 'ClientController@adminindex')->name('admin_clients_main');
     Route::get('clients/new', 'ClientController@admincreate');
     Route::post('clients', 'ClientController@adminstore');
     Route::get('clients/{id}/edit', 'ClientController@adminedit');
     Route::patch('clients/{id}', 'ClientController@adminupdate');
});

// Clients user routes
Route::group(['prefix' => 'admin/', 'middleware' => ['role:siteadmin', 'auth']], function() {
     Route::get('users', 'UserController@index')->name('admin_users_main');
     Route::get('users/new', 'UserController@create');
     Route::post('users', 'UserController@store');
     Route::get('users/{id}/edit', 'UserController@edit');
     Route::patch('users/{id}', 'UserController@update');
});

// Login Link Signin
Route::get('/signin', 'SigninController@index');
Route::post('/signin', 'SigninController@confirm');
Route::get('/signin/{id}', 'SigninController@verify')->name('signin.verify');

Route::get('/media', 'MediaController@index');
// Route::post('/stories', 'StoryController@store')->name('stories.store')->middleware(['auth', 'role:siteadmin']);
// Route::get('/stories/create', 'StoryController@create')->name('stories.create')->middleware(['auth', 'role:siteadmin']);
// Route::get('/stories/{story}', 'StoryController@show')->name('stories.show')->middleware(['auth', 'role:siteadmin']);
// Route::patch('/stories/{story}', 'StoryController@update')->name('stories.update')->middleware(['auth', 'role:siteadmin']);
// Route::delete('/stories/{story}', 'StoryController@destroy')->name('stories.destroy')->middleware(['auth', 'role:siteadmin']);
// Route::get('/stories/{story}/edit', 'StoryController@edit')->name('stories.edit')->middleware(['auth', 'role:siteadmin']);

Route::resource('reporters', 'ReporterController');

Route::get('update/metadata', 'AdminController@index');

Route::get('admin/updateheadlines', 'UpdateController@updateHeadlines')->middleware(['auth', 'role:siteadmin']);




