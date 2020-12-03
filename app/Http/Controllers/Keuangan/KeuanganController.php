<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Pengumuman;
use App\Priority;
use File;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Keuangan;
use App\User;
use App\labaRugi;
use App\TenantMentor;
use Spatie\QueryBuilder\{QueryBuilder, AllowedFilter};

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //FUNCTION INKUBATOR
    public function indexInkubatorKas(Request $request)
    {
        // DATA TABLE ARUS KAS
        // Menampilkan Data Arus Kas Kedalam Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
            if (request()->has('filter')) {
                $masuk     = QueryBuilder::for(Keuangan::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                $keluar     = QueryBuilder::for(Keuangan::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                $arusMasuk[] = $masuk->totalMasuk;
                $arusKeluar[] = $keluar->totalKeluar;
            $totalKas[] = $masuk->totalMasuk - $keluar->totalKeluar;
            }else{
                $masuk     = QueryBuilder::for(Keuangan::class)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                $keluar     = QueryBuilder::for(Keuangan::class)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                $arusMasuk[] = $masuk->totalMasuk;
                $arusKeluar[] = $keluar->totalKeluar;
            $totalKas[] = $masuk->totalMasuk - $keluar->totalKeluar;
            }
        }

        // Menampilkan Data Arus Kas Keuangan
        if (request()->has('filter')) {
        $keuangan = QueryBuilder::for(Keuangan::class)
            ->allowedFilters([
                AllowedFilter::exact('tenant', 'tenant_id'),
                AllowedFilter::scope('bulan', 'dateBulan'),
                AllowedFilter::scope('tahun', 'dateTahun'),
            ])
            ->paginate();
        $pendapatan = QueryBuilder::for(Keuangan::class)
            ->allowedFilters([
                AllowedFilter::exact('tenant', 'tenant_id'),
                AllowedFilter::scope('bulan', 'dateBulan'),
                AllowedFilter::scope('tahun', 'dateTahun'),
            ])
            ->get();
        }else{
            $keuangan = QueryBuilder::for(Keuangan::class)
                ->whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', date('Y'))
                ->paginate();
            $pendapatan = QueryBuilder::for(Keuangan::class)
                ->whereYear('tanggal', date('Y'))
                ->get();
        }
        // Menampilkan Tenant
        $tenant = DB::table('tenant')->get();

        // Menghitung Total Arus Kas Pada Bagian Table
        $total_masuk = 0;
        $total_keluar = 0;

        foreach ($keuangan as $row) {
            if ($row->jenis == '1')
                $total_masuk = $total_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $total_keluar = $total_keluar + $row->jumlah;
        }

        $total = $total_masuk - $total_keluar;
        
        // Menghitung Total Arus Kas pada Bagian Atas
        $kas_masuk = 0;
        $kas_keluar = 0;

        foreach ($pendapatan as $row) {
            if ($row->jenis == '1')
                $kas_masuk = $kas_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $kas_keluar = $kas_keluar + $row->jumlah;
        }

        $saldo_kas = $kas_masuk - $kas_keluar;
        
        return view('keuangan.dashboard.arus_kas', compact('keuangan','tenant','categories', 'arusMasuk','arusKeluar','total', 'total_masuk', 'total_keluar', 'saldo_kas', 'kas_masuk', 'kas_keluar','totalKas'));
    }

    public function indexInkubatorLaba()
    {
        // DATA TABLE LABA RUGI
        // Menampilkan Data Laba Rugi Kedalam Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
            if (request()->has('filter')) {
                $penghasilan     = QueryBuilder::for(labaRugi::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalPenghasilan"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                $beban           = QueryBuilder::for(labaRugi::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalBeban"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                $labaMasuk[] = $penghasilan->totalPenghasilan;
                $labaKeluar[] = $beban->totalBeban;
            $totalLabaBersih[] = $penghasilan->totalPenghasilan - $beban->totalBeban;
            }else{
                $penghasilan     = QueryBuilder::for(labaRugi::class)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalPenghasilan"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                $beban           = QueryBuilder::for(labaRugi::class)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalBeban"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                $labaMasuk[] = $penghasilan->totalPenghasilan;
                $labaKeluar[] = $beban->totalBeban;
            $totalLabaBersih[] = $penghasilan->totalPenghasilan - $beban->totalBeban;
            }
        }

        // Menampilkan Data Laba Rugi Keuangan
        if (request()->has('filter')) {
            $labaRugi = QueryBuilder::for(labaRugi::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->paginate();
            $labaBersih = QueryBuilder::for(labaRugi::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->get();
        }else{
            $labaRugi = QueryBuilder::for(labaRugi::class)
                ->whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', date('Y'))
                ->paginate();
            $labaBersih = QueryBuilder::for(labaRugi::class)
                ->whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', date('m'))
                ->get();
        }        
        // Menampilkan Tenant
        $tenant = DB::table('tenant')->get();

        // Menghitung Total Pada Laba Rugi Bagian Table
        $masuk_labaRugi = 0;
        $keluar_labaRugi = 0;

        foreach ($labaRugi as $row) {
            if ($row->jenis == '1')
                $masuk_labaRugi = $masuk_labaRugi + $row->jumlah;

            elseif ($row->jenis == '0')
                $keluar_labaRugi = $keluar_labaRugi + $row->jumlah;
        }

        $totalLaba = $masuk_labaRugi - $keluar_labaRugi;
        
        // Menghitung Total pada Laba Rugi Bagian Atas
        $laba_masuk = 0;
        $laba_keluar = 0;

        foreach ($labaBersih as $row) {
            if ($row->jenis == '1')
                $laba_masuk = $laba_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $laba_keluar = $laba_keluar + $row->jumlah;
        }

        $laba_bersih = $laba_masuk - $laba_keluar;
        
        return view('keuangan.dashboard.laba_rugi', compact('labaRugi','tenant','totalLaba','masuk_labaRugi','keluar_labaRugi', 'laba_bersih', 'laba_masuk' , 'laba_keluar', 'categories', 'labaMasuk', 'labaKeluar','labaBersih','totalLabaBersih' ));
    }

    //FUNCTION MENTOR
    public function indexMentorKas()
    {
        // DATA TABLE ARUS KAS
        // Menampilkan Data Arus Kas Keuangan Pada Bagian Table
        $tenant = TenantMentor::where('user_id', auth()->user()->id)->get('tenant_id');
        if (request()->has('filter')) {
            $keuangan = QueryBuilder::for(Keuangan::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->whereIn('tenant_id', $tenant)
                ->paginate();
        } else {
            $keuangan = QueryBuilder::for(Keuangan::class)
                ->whereIn('tenant_id', $tenant)
                ->whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', date('Y'))
                ->paginate();
        }
        // Menampilkan Data Arus Kas Keuangan Pada Bagian Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
            if (request()->has('filter')) {
            // Menampilkan Data Keuangan Pada Bagian Grafik Masuk
                $masuk = QueryBuilder::for(Keuangan::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                    $arusMasuk[] = $masuk->totalMasuk;

                // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
                $keluar = QueryBuilder::for(Keuangan::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                    $arusKeluar[] = $keluar->totalKeluar;
                $totalKas[] = $masuk->totalMasuk - $keluar->totalKeluar;
            } else{
                $masuk = QueryBuilder::for(Keuangan::class)
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                    $arusMasuk[] = $masuk->totalMasuk;

                // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
                $keluar = QueryBuilder::for(Keuangan::class)
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                    $arusKeluar[] = $keluar->totalKeluar;
                $totalKas[] = $masuk->totalMasuk - $keluar->totalKeluar;
            }
        }

        // Menampilkan Data Arus Kas Keuangan        
        if (request()->has('filter')) {
            $pendapatan = QueryBuilder::for(Keuangan::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->whereIn('tenant_id', $tenant)
                ->get();
        } else{
            $pendapatan = QueryBuilder::for(Keuangan::class)
                ->whereIn('tenant_id', $tenant)
                ->whereYear('tanggal', date('Y'))
                ->get();
        }
        // Menampilkan Data Tenant
        $tenant = DB::table('tenant_mentor')
            ->join('users', 'tenant_mentor.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_mentor.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_mentor.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->get();
            
        // Menghitung Total Arus Kas Pada Bagian Table
        $total_masuk = 0;
        $total_keluar = 0;

        foreach ($keuangan as $row) {
            if ($row->jenis == '1')
                $total_masuk = $total_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $total_keluar = $total_keluar + $row->jumlah;
        }

        $total = $total_masuk - $total_keluar;

        // Menghitung Total Arus Kas pada Bagian Atas
        $kas_masuk = 0;
        $kas_keluar = 0;

        foreach ($pendapatan as $row) {
            if ($row->jenis == '1')
                $kas_masuk = $kas_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $kas_keluar = $kas_keluar + $row->jumlah;
        }

        $saldo_kas = $kas_masuk - $kas_keluar;
        
        return view('keuangan.dashboard.arus_kas', compact('keuangan','tenant','saldo_kas','kas_masuk','kas_keluar','arusMasuk','arusKeluar','categories', 'total', 'total_masuk', 'total_keluar','totalKas'));
    }

    public function indexMentorLaba()
    {
        // DATA TABLE LABA RUGI
        // Menampilkan Data Laba Rugi Keuangan Pada Bagian Table
        $tenant = TenantMentor::where('user_id', auth()->user()->id)->get('tenant_id');
        if (request()->has('filter')) {
            $labaRugi = QueryBuilder::for(LabaRugi::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->whereIn('tenant_id', $tenant)
                ->paginate();
        } else{
            $labaRugi = QueryBuilder::for(LabaRugi::class)
                ->whereIn('tenant_id', $tenant)
                ->whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', date('Y'))
                ->paginate();
        }
        // Menampilkan Data Laba Rugi Keuangan Pada Bagian Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
            if (request()->has('filter')) {
                // Menampilkan Data Keuangan Pada Bagian Grafik Masuk
                $penghasilan = QueryBuilder::for(LabaRugi::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalPenghasilan"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                    $labaMasuk[] = $penghasilan->totalPenghasilan;

                // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
                $beban = QueryBuilder::for(LabaRugi::class)
                    ->allowedFilters([
                        AllowedFilter::exact('tenant', 'tenant_id'),
                        AllowedFilter::scope('bulan', 'dateBulan'),
                        AllowedFilter::scope('tahun', 'dateTahun'),
                    ])
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalBeban"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->first();
                    $labaKeluar[] = $beban->totalBeban;
                $totalLabaBersih[] = $penghasilan->totalPenghasilan - $beban->totalBeban;
            } else{
                $penghasilan = QueryBuilder::for(LabaRugi::class)
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalPenghasilan"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                    $labaMasuk[] = $penghasilan->totalPenghasilan;

                // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
                $beban = QueryBuilder::for(LabaRugi::class)
                    ->whereIn('tenant_id', $tenant)
                    ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalBeban"))
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', date('Y'))
                    ->first();
                    $labaKeluar[] = $beban->totalBeban;
                $totalLabaBersih[] = $penghasilan->totalPenghasilan - $beban->totalBeban;
            }
        }
        
        // Menampilkan Data Laba Rugi Keuangan
        if (request()->has('filter')) {
            $labaBersih = QueryBuilder::for(LabaRugi::class)
                ->allowedFilters([
                    AllowedFilter::exact('tenant', 'tenant_id'),
                    AllowedFilter::scope('bulan', 'dateBulan'),
                    AllowedFilter::scope('tahun', 'dateTahun'),
                ])
                ->whereIn('tenant_id', $tenant)
                ->get();
        } else{
            $labaBersih = QueryBuilder::for(LabaRugi::class)
                ->whereIn('tenant_id', $tenant)
                ->whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', date('Y'))
                ->get();
        }
        // Menampilkan Data Tenant
        $tenant = DB::table('tenant_mentor')
            ->join('users', 'tenant_mentor.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_mentor.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_mentor.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->get();

        // Menghitung Total Laba Rugi Pada Bagian Table
        $masuk_labaRugi = 0;
        $keluar_labaRugi = 0;

        foreach ($labaRugi as $row) {
            if ($row->jenis == '1')
                $masuk_labaRugi = $masuk_labaRugi + $row->jumlah;

            elseif ($row->jenis == '0')
                $keluar_labaRugi = $keluar_labaRugi + $row->jumlah;
        }
        
        $totalLaba = $masuk_labaRugi - $keluar_labaRugi;

        // Menghitung Total Laba Rugi pada Bagian Atas
        $laba_masuk = 0;
        $laba_keluar = 0;

        foreach ($labaBersih as $row) {
            if ($row->jenis == '1')
                $laba_masuk = $laba_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $laba_keluar = $laba_keluar + $row->jumlah;
        }

        $laba_bersih = $laba_masuk - $laba_keluar;
        
        return view('keuangan.dashboard.laba_rugi', compact('labaRugi','tenant','totalLaba','masuk_labaRugi','keluar_labaRugi', 'laba_bersih', 'laba_masuk' , 'laba_keluar', 'categories', 'labaMasuk', 'labaKeluar','totalLabaBersih' ));
    }

    //FUNCTION TENANT
    public function indexTenant()
    {
        $label = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        // DATA TABLE ARUS KAS
        $users = DB::table('users')->get();
        // Menampilkan Data Tenant
        $tenant = DB::table('tenant_user')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_user.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_user.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->get();
        // Menampilkan Data Arus Kas Keuangan Pada Bagian Table
        $keuangan = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select('users.id', 'tenant_user.user_id', 'arus_kas.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', date('m'))
            ->get();

        // Menampilkan Data Arus Kas Keuangan Pada Bagian Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
        
        // Menampilkan Data Keuangan Pada Bagian Grafik Masuk
        $masuk = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $arusMasuk[] = $masuk->totalMasuk;

        // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
        $keluar = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $arusKeluar[] = $keluar->totalKeluar;
        
                // Menampilkan Data Laba Rugi pada bagian Grafik 
        $penghasilan = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            // ->select('users.id', 'tenant_mentor.user_id', 'arus_kas.*')
            ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalPenghasilan"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $labaMasuk[] = $penghasilan->totalPenghasilan;
                
            // Menampilkan Data Laba Rugi Pada Bagian Grafik 
        $beban = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            // ->select('users.id', 'tenant_mentor.user_id', 'arus_kas.*')
            ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalBeban"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $labaKeluar[] = $beban->totalBeban;
            
            // Menampilkan total Laba Rugi di Grafik
            $totalLabaBersih[] = $penghasilan->totalPenghasilan - $beban->totalBeban;
        }
        
        $pendapatan = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_user.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_user.user_id', 'arus_kas.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])->get();

        // Relasi antara Tenant dengan User
        $user = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        // Menghitung Totalan Arus Kas Pada Bagian Table
        $total_masuk = 0;
        $total_keluar = 0;

        foreach ($keuangan as $row) {
            if ($row->jenis == '1')
                $total_masuk = $total_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $total_keluar = $total_keluar + $row->jumlah;
        }

        $total = $total_masuk - $total_keluar;

        // Menghitung totalan pada bagian atas
        $kas_masuk = 0;
        $kas_keluar = 0;

        foreach ($pendapatan as $row) {
            if ($row->jenis == '1')
                $kas_masuk = $kas_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $kas_keluar = $kas_keluar + $row->jumlah;
        }

        $saldo_kas = $kas_masuk - $kas_keluar;

        // DATA TABLE LABA RUGI
        // Menampilkan Data Laba Rugi Keuangan Pada Bagian Table
        $labaRugi = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select('users.id', 'tenant_user.user_id', 'laba_rugi.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', date('m'))
            ->get();

        $labaBersih = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_user.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_user.user_id', 'laba_rugi.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])->get();
            
        // Relasi antara Tenant dengan User
        $userId = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        // Menghitung Totalan Laba Rugi Pada Bagian Table
        $masuk_labaRugi = 0;
        $keluar_labaRugi = 0;

        foreach ($labaRugi as $row) {
            if ($row->jenis == '1')
                $masuk_labaRugi = $masuk_labaRugi + $row->jumlah;

            elseif ($row->jenis == '0')
                $keluar_labaRugi = $keluar_labaRugi + $row->jumlah;
        }

        $totalLaba = $masuk_labaRugi - $keluar_labaRugi;

        // Menghitung Total pada Bagian Atas
        $laba_masuk = 0;
        $laba_keluar = 0;

        foreach ($labaBersih as $row) {
            if ($row->jenis == '1')
                $laba_masuk = $laba_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $laba_keluar = $laba_keluar + $row->jumlah;
        }

        $laba_bersih = $laba_masuk - $laba_keluar;

        return view('keuangan.index', compact('keuangan','arusMasuk','arusKeluar','categories', 'pendapatan', 'kas_masuk', 'kas_keluar', 'saldo_kas', 'total','total_masuk','total_keluar','user', 'labaRugi','totalLaba','masuk_labaRugi','keluar_labaRugi','label','userId','tenant', 'labaMasuk', 'labaKeluar', 'labaBersih', 'laba_masuk', 'laba_keluar', 'laba_bersih', 'totalLabaBersih'));
    }

    //FUNCTION CRUD Arus Kas
    public function storeArus(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'file' => 'required|file|mimes:png,jpeg,jpg',
            'tanggal' => 'required',
        ]);
        $file = $request->file;
        $filename = time() . Str::slug($request->get('keterangan')) . '.' . $file->getClientOriginalExtension();
        DB::table('arus_kas')->insert([
            'tenant_id' => $request->tenant_id,
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'foto' => $filename,
            'tanggal' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $tujuan_upload = 'img/keuangan';
        $file->move($tujuan_upload, $filename);

        return redirect('/tenant/detail-tenant')->with('success', 'Menambahkan Data Arus Kas');
    }
    public function editArus($id)
    {
        $user = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        $k = DB::table('arus_kas')->where('id', $id)->first();
        $tenant = DB::table('tenant')->get();
        $arus = DB::table('arus_kas')->get();
        $users = DB::table('users')->get();
        $keuangan = keuangan::find($id);

        return view('keuangan.arusEdit', compact('k', 'keuangan', 'users', 'tenant', 'arus', 'user'));
    }

    public function updateArus($id, Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|file|mimes:png,jpeg,jpg,pdf',
        ]);
        $keuangan = Keuangan::find($id);
        $filename = $keuangan->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . Str::slug($request->get('keterangan')) . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'img/keuangan';
            $file->move($tujuan_upload, $filename);
            File::delete('img/keuangan/' . $keuangan->foto);
        }
        $keuangan->update([
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'foto' => $filename,
            'tanggal' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/tenant/detail-tenant')->with(['update' => 'Edit Data Arus Kas']);
    }

    public function hapusArus($id)
    {

        $file = DB::table('arus_kas')->where('id', $id)->first();
        File::delete('img/keuangan/' . $file->foto);
        DB::table('arus_kas')->where('id', $id)->delete();

        return redirect('/tenant/detail-tenant')->with('delete', 'Menghapus Data Arus Kas');
    }

    //FUNCTION CRUD Laba Rugi
    public function storeLaba(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'file' => 'required|file|mimes:png,jpeg,jpg',
            'tanggal' => 'required',
        ]);
        $file = $request->file;
        $filename = time() . Str::slug($request->get('keterangan')) . '.' . $file->getClientOriginalExtension();
        DB::table('laba_rugi')->insert([
            'tenant_id' => $request->tenant_id,
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'foto' => $filename,
            'tanggal' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $tujuan_upload = 'img/keuangan';
        $file->move($tujuan_upload, $filename);

        return redirect('/tenant/detail-tenant')->with('successLaba', 'Menambahkan Data Laba Rugi');
    }

    public function editLaba($id)
    {
        $userId = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        $b = DB::table('laba_rugi')->where('id', $id)->first();
        $users = DB::table('users')->get();
        $keuangan = keuangan::find($id);

        return view('keuangan.labaEdit', compact('b', 'keuangan', 'users', 'userId'));
    }

    public function updateLaba($id, Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|file|mimes:png,jpeg,jpg,pdf',
        ]);
        $labaRugi = LabaRugi::find($id);
        $filename = $labaRugi->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . Str::slug($request->get('keterangan')) . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'img/keuangan';
            $file->move($tujuan_upload, $filename);
            File::delete('img/keuangan/' . $labaRugi->foto);
        }
        $labaRugi->update([
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'foto' => $filename,
            'tanggal' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/tenant/detail-tenant')->with(['update' => 'Edit Data Laba Rugi']);
    }

    public function hapusLaba($id)
    {

        $file = DB::table('laba_rugi')->where('id', $id)->first();
        File::delete('img/keuangan/' . $file->foto);
        DB::table('laba_rugi')->where('id', $id)->delete();

        return redirect('/tenant/detail-tenant')->with('delete', 'Menghapus Laba Rugi');
    }
}
