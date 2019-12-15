<?php


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

Route::get('/kelurahan/index', 'adminController@kelurahanIndex')
       ->name('kelurahanIndex');

Route::get('/instasi/index', 'adminController@instansiIndex')
       ->name('instansiIndex');

Route::get('/unitKerja/index', 'adminController@unitKerjaIndex')
       ->name('unitKerjaIndex');

Route::get('/pangkat/index', 'adminController@pangkatIndex')
       ->name('pangkatIndex');

//batas middleware auth