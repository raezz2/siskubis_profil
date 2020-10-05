<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/single/{slug}', 'Front\IndexController@single')->name('single');
Route::get('/pengumuman', 'Front\PengumumanController@index')->name('pengumuman');
Route::get('/pengumuman/{slug}', 'Front\PengumumanController@show');

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


Route::group(['prefix'=>'inkubator','middleware' => ['role:inkubator']], function () {
    Route::get('/', 'Inkubator\HomeController@index')->name('inkubator.home');
    Route::get('/tenant', 'Tenant\TenantController@index')->name('inkubator.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('inkubator.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('inkubator.tenant-detail');

	Route::get('/mentor', 'Mentor\MentorController@index')->name('inkubator.mentor');
	Route::get('/produk', 'Produk\ProdukController@index')->name('inkubator.produk');
	Route::get('/produk/{kategori}', 'Produk\ProdukController@kategori')->name('inkubator.produk-kategori');
	Route::get('/produk/{kategori}/{id}', 'Produk\ProdukController@detail')->name('inkubator.produk-detail');

	Route::get('/aktifitas', 'Aktifitas\AktifitasController@index')->name('inkubator.aktifitas');
	Route::get('/keuangan', 'Keuangan\KeuanganController@index')->name('inkubator.keuangan');
	Route::get('/pencapaian', 'Pencapaian\PencapaianController@index')->name('inkubator.pencapaian');
	Route::get('/laporan', 'Laporan\LaporanController@index')->name('inkubator.laporan');
    Route::get('/chat', 'Chat\ChatController@index')->name('inkubator.chat');
    Route::get('/pesan', 'Pesan\PesanController@index')->name('inkubator.pesan');
	Route::get('/profile', 'Profile\ProfileUserController@index')->name('inkubator.profile-auth');
	Route::get('/profile/{id}', 'Profile\ProfileUserController@index')->name('inkubator.profile-detail');

	//route surat inkubator
	Route::get('/surat', 'Persuratan\PersuratanController@index')->name('inkubator.surat');
	Route::get('/buatsurat', 'Persuratan\PersuratanController@create')->name('inkubator.buatsurat');
	Route::get('/buatsuratkeluar', 'Persuratan\PersuratanController@createkeluar')->name('inkubator.buatsuratkeluar');
	Route::post('/kirimsurat', 'Persuratan\PersuratanController@store');
	Route::post('/kirimsuratkeluar', 'Persuratan\PersuratanController@storekeluar');
	Route::get('/surat/{surat}', 'Persuratan\PersuratanController@show');
	Route::get('/surat/{surat}/delete', 'Persuratan\PersuratanController@destroy');
	Route::get('/surat/edit/{surat}', 'Persuratan\PersuratanController@edit');
	Route::patch('/surat/{surat}', 'Persuratan\PersuratanController@update');
	Route::get('/disposisi/{surat}' , 'Persuratan\PersuratanController@disposisi');
	Route::patch('/disposisi/{surat}' , 'Persuratan\PersuratanController@disposisiupdate');

	// ! route event inkubator
	Route::get('/event', 'Event\EventController@index')->name('inkubator.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('inkubator.event-calendar');
	Route::get('/event/create', 'Event\EventController@create')->name('inkubator.event.create');
	Route::post('/event/store', 'Event\EventController@store')->name('inkubator.event.store');
	Route::get('/event/{event:slug}', 'Event\EventController@show');
	Route::get('/event/{event:slug}/edit', 'Event\EventController@edit')->name('inkubator.event.edit');
	Route::patch('/event/{event:slug}/edit', 'Event\EventController@update');
	Route::get('/event/{event:slug}/delete', 'Event\EventController@destroy');
	Route::get('/event/createmodal', 'Event\EventController@createmodal')->name('inkubator.event.modal');

	// route pengumuman inkubator
	Route::get('/pengumuman', 'Pengumuman\PengumumanController@index')->name('inkubator.pengumuman');
	Route::get('/pengumuman/nontenant', 'Pengumuman\PengumumanController@tenant')->name('inkubator.non-tenant');
	Route::get('/pengumuman/search', 'Pengumuman\PengumumanController@search');
	Route::get('/pengumuman/tambah', 'Pengumuman\PengumumanController@tambah')->name('inkubator.tambah');
	Route::post('/pengumuman/store', 'Pengumuman\PengumumanController@store')->name('inkubator.store');
	Route::get('/pengumuman/{slug}', 'Pengumuman\PengumumanController@show');
	Route::get('/pengumuman/edit/{id}', 'Pengumuman\PengumumanController@edit')->name('inkubator.edit-id');;
	Route::put('/pengumuman/update/{id}', 'Pengumuman\PengumumanController@update')->name('inkubator.update-id');;
	Route::get('/pengumuman/hapus/{id}', 'Pengumuman\PengumumanController@hapus');
	Route::get('/kategori', 'Pengumuman\KategoriController@index')->name('inkubator.kategori');
	Route::get('/kategori/{id}', 'Pengumuman\KategoriController@kategori')->name('inkubator.kategori-id');
	Route::get('/pengumuman/status/{id}', 'Pengumuman\PengumumanController@status');

    Route::get('/berita', 'Berita\BeritaController@index')->name('inkubator.berita');
    //Alvi Adnan Vazshola
    Route::get('/berita/create', 'Berita\BeritaController@create')->name('inkubator.formBerita');
    Route::post('/berita/store', 'Berita\BeritaController@store')->name('inkubator.storeBerita');
    Route::get('/berita/destroy/{berita}', 'Berita\BeritaController@destroy')->name('inkubator.destroyBerita');
    Route::get('berita/edit/{id}','Berita\BeritaController@edit')->name('inkubator.editBerita');
    Route::put('berita/update/{id}','Berita\BeritaController@update')->name('inkubator.updateBerita');
    Route::get('/berita/{slug}', 'Berita\BeritaController@show')->name('inkubator.showBerita');
    Route::post('/berita/komentar','Berita\BeritaController@komentar')->name('inkubator.komentarBerita');
    //End
    Route::get('/berita/kategori', 'Berita\KategoriController@kategori')->name('inkubator.kategori');


	//komentar
	//Route::get('/{slug}', 'Berita\BeritaKomentarController@show');
	Route::post('/berita/comment', 'Berita\BeritaKomentarController@comment')->name('inkubator.berita.comment');
	Route::get('/berita/destroy/{id}', 'Berita\BeritaKomentarController@destroy')->name('inkubator.berita.destroy');


    /*========================================================== Kategori ===================================================================*/
    // Route::resource('kategori', 'Berita\KategoriController')->except(['create', 'show']);

    //Route::get('/berita/kategori', 'Berita\KategoriController@index')->name('inkubator.kategori.index');

    Route::get('/berita/kategori/create', 'Berita\KategoriController@create')->name('inkubator.kategori.create');
    Route::post('/berita/kategori/create','Berita\KategoriController@store');

    Route::get('/berita/kategori/{kategori}/edit', 'Berita\KategoriController@edit')->name('inkubator.kategori.edit');

    Route::patch('/berita/kategori/{kategori}/edit', 'Berita\KategoriController@update')->name('inkubator.kategori.update');
    Route::get('/berita/kategori/{kategori}/delete', 'Berita\KategoriController@destroy')->name('inkubator.kategori.destroy');

    //Search
    Route::get('cariberita','Berita\BeritaController@search')->name('cariberita');
});



Route::group(['prefix'=>'mentor','middleware' => ['role:mentor']], function () {
	Route::get('/', 'Mentor\HomeController@index')->name('mentor.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('mentor.chat');

	//route surat mentor
	Route::get('/suratmasuk', 'Persuratan\DisposisiController@mentorsuratmasuk');
	Route::get('/suratkeluar', 'Persuratan\DisposisiController@mentorsuratkeluar');
	Route::get('/buatsurat', 'Persuratan\PersuratanController@create');
	Route::get('/buatsuratkeluar', 'Persuratan\DisposisiController@createkeluar');
	Route::post('/kirimsurat', 'Persuratan\DisposisiController@mentorstore');
	Route::post('/kirimsuratkeluar', 'Persuratan\DisposisiController@mentorstorekeluar');
	Route::get('/suratmasuk/{surat}', 'Persuratan\PersuratanController@detail');
	Route::get('/surat/{disposisi}/hapus', 'Persuratan\DisposisiController@destroy');
	Route::get('/surat/{surat}/delete', 'Persuratan\PersuratanController@destroy');
	Route::get('/surat/edit/{surat}', 'Persuratan\DisposisiController@edit');
	Route::patch('/surat/{surat}', 'Persuratan\DisposisiController@mentorupdate');

	// ! route event mentor
	Route::get('/event', 'Event\EventController@indexMentor')->name('mentor.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendarMentor')->name('mentor.event-calendar');
	Route::get('/event/{event:slug}', 'Event\EventController@show');

	// route pengumuman mentor
	Route::get('/pengumuman', 'Mentor\MentorController@pengumuman')->name('mentor.pengumuman');
	Route::get('/pengumuman/nontenant', 'Mentor\MentorController@tenant')->name('mentor.non-tenant');
	Route::get('/pengumuman/search', 'Mentor\MentorController@search');
	Route::get('/pengumuman/{slug}', 'Mentor\MentorController@show');
});

Route::group(['prefix'=>'tenant','middleware' => ['role:tenant']], function () {
	Route::get('/', 'Tenant\HomeController@index')->name('tenant.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('tenant.chat');
	// route surat tenant
	Route::get('/suratmasuk', 'Persuratan\DisposisiController@tenantsuratmasuk');
	Route::get('/suratkeluar', 'Persuratan\DisposisiController@tenantsuratkeluar');
	Route::get('/buatsurat', 'Persuratan\DisposisiController@create');
	Route::get('/buatsuratkeluar', 'Persuratan\DisposisiController@createkeluar');
	Route::post('/kirimsurat', 'Persuratan\DisposisiController@tenantstore');
	Route::post('/kirimsuratkeluar', 'Persuratan\DisposisiController@tenantstorekeluar');
	Route::get('/suratmasuk/{surat}', 'Persuratan\PersuratanController@detail');
	Route::get('/surat/{disposisi}/hapus', 'Persuratan\DisposisiController@destroy');
	Route::get('/surat/{surat}/delete', 'Persuratan\PersuratanController@destroy');
	Route::get('/surat/edit/{surat}', 'Persuratan\DisposisiController@edit');
	Route::patch('/surat/{surat}', 'Persuratan\DisposisiController@tenantupdate');
	Route::get('/pesan', 'Pesan\PesanController@index')->name('inkubator.pesan');
	Route::get('/profile', 'Profile\ProfileUserController@index')->name('inkubator.profile');
	// ! route event tenant
	Route::get('/event', 'Event\EventController@indexTenant')->name('tenant.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendarTenant')->name('tenant.event-calendar');
	Route::get('/event/{event:slug}', 'Event\EventController@show');
	// route pengumuman tenant
	Route::get('/pengumuman', 'Tenant\TenantController@pengumuman')->name('tenant.pengumuman');
	Route::get('/pengumuman/nontenant', 'Tenant\TenantController@tenant')->name('tenant.non-tenant');
	Route::get('/pengumuman/search', 'Tenant\TenantController@search');
	Route::get('/pengumuman/{slug}', 'Tenant\TenantController@show');

});

Route::group(['prefix'=>'user','middleware' => ['role:user']], function () {
    Route::get('/', 'User\HomeController@index')->name('user.home');
    Route::get('/chat', 'Chat\ChatController@index')->name('user.chat');
	//route surat
	Route::get('/suratmasuk', 'Persuratan\DisposisiController@usersuratmasuk');
	Route::get('/suratkeluar', 'Persuratan\DisposisiController@usersuratkeluar');
	Route::get('/surat/{disposisi}/hapus', 'Persuratan\DisposisiController@destroy');
	//route pengumuman
	Route::get('/pengumuman', 'User\UserController@pengumuman');
	Route::get('/pengumuman/{slug}', 'User\UserController@show');
});
