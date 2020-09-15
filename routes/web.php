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

Route::get('/', 'Front\IndexController@index');
Route::get('/single', 'Front\IndexController@single')->name('single');

Auth::routes();

Route::group(['prefix'=>'admin','middleware' => ['role:admin']], function () {
    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
	Route::get('/inkubator', 'Inkubator\InkubatorController@index')->name('admin.inkubator');
	Route::get('/inkubator/{view}', 'Inkubator\InkubatorController@tampil')->name('admin.inkubator.view');
	Route::get('/tenant', 'Tenant\TenantController@index')->name('admin.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('admin.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('admin.tenant-detail');
	Route::get('/chat', 'Chat\ChatController@index')->name('admin.chat');
	
});

Route::group(['prefix'=>'inkubator','middleware' => ['role:inkubator']], function () {
    Route::get('/', 'Inkubator\HomeController@index')->name('inkubator.home');
    Route::get('/tenant', 'Tenant\TenantController@index')->name('inkubator.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('inkubator.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('inkubator.tenant-detail');
	
	Route::get('/mentor', 'Mentor\MentorController@index')->name('inkubator.mentor');
	Route::get('/produk', 'Produk\ProdukController@index')->name('inkubator.produk');
	Route::get('/aktifitas', 'Produk\ProdukController@index')->name('inkubator.aktifitas');
	Route::get('/keuangan', 'Produk\ProdukController@index')->name('inkubator.keuangan');
	Route::get('/pencapaian', 'Produk\ProdukController@index')->name('inkubator.pencapaian');
	Route::get('/laporan', 'Produk\ProdukController@index')->name('inkubator.laporan');
	Route::get('/surat', 'Persuratan\PersuratanController@index')->name('inkubator.surat');
	Route::get('/buatsurat', 'Persuratan\PersuratanController@create')->name('inkubator.buatsurat');
	Route::post('/kirimsurat', 'Persuratan\PersuratanController@store');
	Route::get('/surat/{surat}', 'Persuratan\PersuratanController@show');
	Route::get('/surat/delete/{surat}', 'Persuratan\PersuratanController@destroy');
	Route::get('/surat/edit/{surat}', 'Persuratan\PersuratanController@edit');
	Route::patch('/surat/{surat}', 'Persuratan\PersuratanController@update');
	//Route::get('/event', 'Produk\ProdukController@index')->name('inkubator.event');
	//Route::get('/berita', 'Produk\ProdukController@index')->name('inkubator.berita');
	//Route::get('/pengumuman', 'Produk\ProdukController@index')->name('inkubator.pengumuman');
	Route::get('/event', 'Event\EventController@index')->name('inkubator.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('inkubator.event-calendar');
    Route::get('/pengumuman', 'Pengumuman\PengumumanController@index')->name('inkubator.pengumuman');
    Route::get('/berita', 'Berita\BeritaController@index')->name('inkubator.berita');
    Route::get('/chat', 'Chat\ChatController@index')->name('inkubator.chat');
    Route::get('/pesan', 'Pesan\PesanController@index')->name('inkubator.pesan');
	Route::get('/profile', 'Profile\ProfileUserController@index')->name('inkubator.profile');
});

Route::group(['prefix'=>'mentor','middleware' => ['role:mentor']], function () {
    Route::get('/', 'Mentor\HomeController@index')->name('mentor.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('mentor.chat');
	Route::get('/inbox', 'Persuratan\DisposisiController@index')->name('mentor.inbox');
});

Route::group(['prefix'=>'tenant','middleware' => ['role:tenant']], function () {
    Route::get('/', 'Tenant\HomeController@index')->name('tenant.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('tenant.chat');
	Route::get('/suratmasuk', 'Inbox\InboxController@indexmasuk');
	Route::get('/suratkeluar', 'Inbox\InboxController@indexkeluar');
	Route::get('/buatsurat', 'Inbox\InboxController@create');
	Route::post('/kirimsurat', 'Inbox\InboxController@store');
	Route::get('/suratmasuk/{surat}', 'Inbox\InboxController@show');
	Route::get('/suratkeluar/{surat}', 'Inbox\InboxController@show');
	Route::get('/suratmasuk/delete/{surat}', 'Inbox\InboxController@destroy');
	Route::get('/suratmasuk/edit/{surat}', 'Inbox\InboxController@edit');
	Route::patch('/suratmasuk/{surat}', 'Inbox\InboxController@update');
});

Route::group(['prefix'=>'user','middleware' => ['role:user']], function () {
    Route::get('/', 'User\HomeController@index')->name('user.home');
    Route::get('/chat', 'Chat\ChatController@index')->name('user.chat');
});