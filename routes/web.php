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

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
	Route::get('/', 'Admin\HomeController@index')->name('admin.home');
	Route::get('/inkubator', 'Inkubator\InkubatorController@index')->name('admin.inkubator');
	Route::get('/inkubator/{view}', 'Inkubator\InkubatorController@tampil')->name('admin.inkubator.view');
	Route::get('/tenant', 'Tenant\TenantController@index')->name('admin.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('admin.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('admin.tenant-detail');
	Route::get('/chat', 'Chat\ChatController@index')->name('admin.chat');
});

Route::group(['prefix' => 'inkubator', 'middleware' => ['role:inkubator']], function () {
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

	// ! route event inkubator
	Route::get('/event', 'Event\EventController@index')->name('inkubator.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('inkubator.event-calendar');
	Route::get('/event/create', 'Event\EventController@create')->name('inkubator.event.create');
	Route::post('/event/store', 'Event\EventController@store')->name('inkubator.event.store');
	Route::get('/event/{event:slug}', 'Event\EventController@show');
	Route::get('/event/{event:slug}/edit', 'Event\EventController@edit')->name('inkubator.event.edit');
	Route::patch('/event/{event:slug}/edit', 'Event\EventController@update');
	Route::get('/event/{event:slug}/delete', 'Event\EventController@destroy');
	Route::get('search', 'Event\EventController@search')->name('search.event');
	Route::get('/event/createmodal', 'Event\EventController@createmodal')->name('inkubator.event.modal');


	Route::get('/pengumuman', 'Pengumuman\PengumumanController@index')->name('inkubator.pengumuman');
	Route::get('/berita', 'Berita\BeritaController@index')->name('inkubator.berita');
	Route::get('/chat', 'Chat\ChatController@index')->name('inkubator.chat');
	Route::get('/pesan', 'Pesan\PesanController@index')->name('inkubator.pesan');
	Route::get('/profile', 'Profile\ProfileUserController@index')->name('inkubator.profile');
});

Route::group(['prefix' => 'mentor', 'middleware' => ['role:mentor']], function () {
	Route::get('/', 'Mentor\HomeController@index')->name('mentor.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('mentor.chat');

	// ! route event mentor
	Route::get('/event', 'Event\EventController@indexMentor')->name('mentor.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('mentor.event-calendar');
	Route::get('/event/{event:slug}', 'Event\EventController@show');
	Route::get('search', 'Event\EventController@search')->name('search.event');
});

Route::group(['prefix' => 'tenant', 'middleware' => ['role:tenant']], function () {
	Route::get('/', 'Tenant\HomeController@index')->name('tenant.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('tenant.chat');

	// ! route event tenant
	Route::get('/event', 'Event\EventController@indexTenant')->name('tenant.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('tenant.event-calendar');
	Route::get('/event/{event:slug}', 'Event\EventController@show');
	Route::get('search', 'Event\EventController@search')->name('search.event');
});

Route::group(['prefix' => 'user', 'middleware' => ['role:user']], function () {
	Route::get('/', 'User\HomeController@index')->name('user.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('user.chat');
});