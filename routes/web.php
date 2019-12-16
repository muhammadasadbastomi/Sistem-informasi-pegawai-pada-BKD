<?php


Route::namespace('API')->prefix('api')->name('API.')->group(function(){
       Route::prefix('kecamatan')->name('kecamatan.')->group(function(){
              Route::get('', 'KecamatanController@get')->name('get');
              Route::get('{uuid}', 'KecamatanController@find')->name('find');
              Route::post('', 'KecamatanController@create')->name('create');
              Route::put('{uuid}', 'KecamatanController@update')->name('update');
              Route::delete('{uuid}', 'KecamatanController@delete')->name('delete');
              });
       Route::prefix('kelurahan')->name('kelurahan.')->group(function(){
              Route::get('', 'KelurahanController@get')->name('get');
              Route::get('{uuid}', 'KelurahanController@find')->name('find');
              Route::post('', 'KelurahanController@create')->name('create');
              Route::put('{uuid}', 'KelurahanController@update')->name('update');
              Route::delete('{uuid}', 'KelurahanController@delete')->name('delete');
              });
       Route::prefix('instansi')->name('instansi.')->group(function(){
              Route::get('', 'InstansiController@get')->name('get');
              Route::get('{uuid}', 'InstansiController@find')->name('find');
              Route::post('', 'InstansiController@create')->name('create');
              Route::put('{uuid}', 'InstansiController@update')->name('update');
              Route::delete('{uuid}', 'InstansiController@delete')->name('delete');
              });
       Route::prefix('unit')->name('unit.')->group(function(){
              Route::get('', 'UnitController@get')->name('get');
              Route::get('{uuid}', 'UnitController@find')->name('find');
              Route::post('', 'UnitController@create')->name('create');
              Route::put('{uuid}', 'UnitController@update')->name('update');
              Route::delete('{uuid}', 'UnitController@delete')->name('delete');
              });
});

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//middleware auth
Route::get('/admin/index', 'adminController@index')
       ->name('adminIndex');

Route::get('/kecamatan/index', 'adminController@kecamatanIndex')
       ->name('kecamatanIndex');
Route::get('/kecamatan/cetak', 'adminController@kecamatanCetak')
       ->name('kecamatanCetak');

Route::get('/kelurahan/index', 'adminController@kelurahanIndex')
       ->name('kelurahanIndex');

Route::get('/instasi/index', 'adminController@instansiIndex')
       ->name('instansiIndex');

Route::get('/unitKerja/index', 'adminController@unitKerjaIndex')
       ->name('unitKerjaIndex');

Route::get('/pangkat/index', 'adminController@pangkatIndex')
       ->name('pangkatIndex');

//batas middleware auth