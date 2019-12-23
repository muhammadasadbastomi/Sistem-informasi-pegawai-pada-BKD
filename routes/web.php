<?php


Route::namespace('API')->prefix('api')->name('API.')->group(function(){
       Route::prefix('user')->name('user.')->group(function(){
              Route::get('', 'UserController@get')->name('get');
              Route::get('{uuid}', 'UserController@find')->name('find');
              Route::post('', 'UserController@create')->name('create');
              Route::put('{uuid}', 'UserController@update')->name('update');
              Route::delete('{uuid}', 'UserController@delete')->name('delete');
              });
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
       Route::prefix('golongan')->name('golongan.')->group(function(){
              Route::get('', 'GolonganController@get')->name('get');
              Route::get('{uuid}', 'GolonganController@find')->name('find');
              Route::post('', 'GolonganController@create')->name('create');
              Route::put('{uuid}', 'GolonganController@update')->name('update');
              Route::delete('{uuid}', 'GolonganController@delete')->name('delete');
              });
       Route::prefix('jabatan')->name('jabatan.')->group(function(){
              Route::get('', 'JabatanController@get')->name('get');
              Route::get('{uuid}', 'JabatanController@find')->name('find');
              Route::post('', 'JabatanController@create')->name('create');
              Route::put('{uuid}', 'JabatanController@update')->name('update');
              Route::delete('{uuid}', 'JabatanController@delete')->name('delete');
              });
       Route::prefix('diklat')->name('diklat.')->group(function(){
              Route::get('', 'DiklatController@get')->name('get');
              Route::get('{uuid}', 'DiklatController@find')->name('find');
              Route::post('', 'DiklatController@create')->name('create');
              Route::put('{uuid}', 'DiklatController@update')->name('update');
              Route::delete('{uuid}', 'DiklatController@delete')->name('delete');
              });
       Route::prefix('pendidikan')->name('pendidikan.')->group(function(){
              Route::get('', 'PendidikanController@get')->name('get');
              Route::get('{uuid}', 'PendidikanController@find')->name('find');
              Route::post('', 'PendidikanController@create')->name('create');
              Route::put('{uuid}', 'PendidikanController@update')->name('update');
              Route::delete('{uuid}', 'PendidikanController@delete')->name('delete');
              });
       Route::prefix('karyawan')->name('karyawan.')->group(function(){
              Route::get('', 'KaryawanController@get')->name('get');
              Route::get('{uuid}', 'KaryawanController@find')->name('find');
              Route::post('', 'KaryawanController@create')->name('create');
              Route::post('update/{uuid}', 'KaryawanController@update')->name('update');
              Route::delete('{uuid}', 'KaryawanController@delete')->name('delete');
              });
       Route::prefix('berita')->name('berita.')->group(function(){
              Route::get('', 'BeritaController@get')->name('get');
              Route::get('{uuid}', 'BeritaController@find')->name('find');
              Route::post('', 'BeritaController@create')->name('create');
              Route::put('{uuid}', 'BeritaController@update')->name('update');
              Route::delete('{uuid}', 'BeritaController@delete')->name('delete');
              });
});

Route::get('/', function () {
    return view('depan');
});
Route::get('/berita/depan', 'adminController@beritaDepan')
       ->name('beritaDepan');
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
Route::get('/kelurahan/cetak', 'adminController@kelurahanCetak')
       ->name('kelurahanCetak');

Route::get('/instasi/index', 'adminController@instansiIndex')
       ->name('instansiIndex');
Route::get('/instasi/cetak', 'adminController@instansiCetak')
       ->name('instansiCetak');
Route::get('/instasi/filter', 'adminController@instansiFilter')
       ->name('instansiFilter');
Route::post('/instasi/filter', 'adminController@instansiFilterCetak')
       ->name('instansiFilterCetak');

Route::get('/unitKerja/index', 'adminController@unitKerjaIndex')
       ->name('unitKerjaIndex');
Route::get('/unitKerja/cetak', 'adminController@unitKerjaCetak')
       ->name('unitKerjaCetak');
Route::get('/unitKerja/filter', 'adminController@filterUnitData')
       ->name('filterUnitData');
Route::post('/unitKerja/filter', 'adminController@filterUnitDataCetak')
       ->name('filterUnitDataCetak');

Route::get('/pangkat/index', 'adminController@pangkatIndex')
       ->name('pangkatIndex');
Route::get('/pangkat/cetak', 'adminController@pangkatCetak')
       ->name('pangkatCetak');

Route::get('/jabatan/index', 'adminController@jabatanIndex')
       ->name('jabatanIndex');
Route::get('/jabatan/cetak', 'adminController@jabatanCetak')
       ->name('jabatanCetak');

Route::get('/diklat/index', 'adminController@diklatIndex')
       ->name('diklatIndex');
Route::get('/diklat/cetak', 'adminController@diklatCetak')
       ->name('diklatCetak');

Route::get('/pendidikan/index', 'adminController@pendidikanIndex')
       ->name('pendidikanIndex');
Route::get('/pendidikan/cetak', 'adminController@pendidikanCetak')
       ->name('pendidikanCetak');

Route::get('/pegawai/index', 'adminController@pegawaiIndex')
       ->name('pegawaiIndex');
Route::get('/pegawai/detail/{uuid}', 'adminController@pegawaiDetail')
       ->name('pegawaiDetail');
Route::get('/pegawai/cetak', 'adminController@pegawaiCetak')
       ->name('pegawaiCetak');

Route::get('/berita/index', 'adminController@beritaIndex')
       ->name('beritaIndex');
Route::get('/berita/cetak', 'adminController@beritaCetak')
       ->name('beritaCetak');

Route::get('/admin/index', 'adminController@adminIndex')
       ->name('adminIndex');
Route::get('/admin/cetak', 'adminController@adminCetak')
       ->name('adminCetak');
//batas middleware auth