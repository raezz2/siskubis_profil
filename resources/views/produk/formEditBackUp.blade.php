@extends('layouts.app')
@section('css')
    <link href="{{ asset('theme/css/plugins/smart.wizard/smart_wizard.min.css')}}" />
    <link href="{{ asset('theme/plugins/smart.wizard/smart_wizard_theme_arrows.min.css')}}" />
    <link href="{{ asset('theme/css/plugins/smart.wizard/smart_wizard_theme_circles.min.css')}}" />
    <link href="{{ asset('theme/css/plugins/smart.wizard/smart_wizard_theme_dots.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <style type="text/css">
        .dropdown-toggle{
            outline: initial !important;
            background: #f8f9fa;
            border: 1px solid #ced4da;
            color: #47404f;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="container">
            <div class="main-content pt-4 pb-4">
                <form action="{{ route('tenant.updateProduk', $produk->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                    <div class="breadcrumb">
                        <h1>
                            Update Produk <b>{{ $produk->title }}</b>
                        </h1>
                    </div>
                    <div class="separator-breadcrumb border-top"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="smartwizard">
                                <ul>
                                    <li><a href="#detail">Detail Produk<br></a></li>
                                    <li><a href="#bisnis">Bisnis<br></a></li>
                                    <li><a href="#canvas">Canvas<br></a></li>
                                    <li><a href="#ijin">Ijin<br></a></li>
                                    <li><a href="#image">Foto Produk<br></a></li>
                                    <li><a href="#ki">Kekayaan Intelektual<br></a></li>
                                    <li><a href="#riset">Riset<br></a></li>
                                    <li><a href="#sertifikasi">Sertifikasi<br></a></li>
                                    <li><a href="#team">Team<br></a></li>
                                </ul>
                                <div>
                                    <div id="detail">
                                        <h5 class="border-bottom border-gray pb-2">Detail Produk</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="title_produk">Nama Produk :</label>
                                                <input class="form-control" id="title_produk" name="title_produk" type="text_produk" placeholder="Nama lengkap produk anda..." required="required" value="{{ $produk->title }}">
                                                @error('title_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="subtitle_produk">Subtitle :</label>
                                                <input class="form-control" id="subtitle_produk" name="subtitle_produk" type="text" placeholder="Subtitle produk anda..." required="required" value="{{ $produk->subtitle }}">
                                                @error('subtitle_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="harga_pokok_produk">Harga Pokok :</label>
                                                <div class="input-right-icon">
                                                    <input class="form-control" id="harga_pokok_produk" name="harga_pokok_produk" type="text" placeholder="Rp. 100000" required="required" value="{{ $produk->harga_pokok }}">
                                                    <span class="span-right-input-icon">
                                                        <a href="#" data-toggle="tooltip" title="Harga sebelum perhitungan keuntungan">
                                                            <i class="ul-form__icon i-Information"></i>
                                                        </a>
                                                    </span>
                                                    @error('harga_pokok_produk')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="harga_jual_produk">Harga Jual :</label>
                                                <div class="input-right-icon">
                                                    <input class="form-control" id="harga_jual_produk" name="harga_jual_produk" type="text" placeholder="Rp. 100000" required="required" value="{{ $produk->harga_jual }}">
                                                    <span class="span-right-input-icon">
                                                        <a href="#" data-toggle="tooltip" title="Harga setelah perhitungan keuntungan">
                                                            <i class="ul-form__icon i-Information"></i>
                                                        </a>
                                                    </span>
                                                    @error('harga_jual_produk')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="kategori_id_produk">Kategori Produk :</label>
                                                <select class="form-control" name="kategori_id_produk" required="required">
                                                    <option value="1" {{ $produk->kategori_id == 1 ? 'selected':'' }}>Otomotif</option>
                                                    <option value="2" {{ $produk->kategori_id == 2 ? 'selected':'' }}>Kuliner</option>
                                                    <option value="3" {{ $produk->kategori_id == 3 ? 'selected':'' }}>Teknologi</option>
                                                </select>
                                                @error('kategori_id_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tag_produk">Tag :</label>
                                                <div class="tagBox case-sensitive form-control" data-no-duplicate="true" data-pre-tags-separator="," data-no-duplicate-text="Duplicate tags" data-type-zone-class="type-zone" data-case-sensitive="true" data-tag-box-class="tagging" data-no-enter="true">{{ $produk->tag }}</div>
                                                @error('tag')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="location_produk">Lokasi :</label>
                                                <div class="input-right-icon">  
                                                    <input class="form-control" id="location_produk" name="location_produk" type="text" placeholder="Sleman" required="required" value="{{ $produk->location }}">
                                                    <span class="span-right-input-icon">
                                                        <a href="#" data-toggle="tooltip" title="Masukan nama kota">
                                                            <i class="ul-form__icon i-Map-Marker"></i>
                                                        </a>
                                                    </span>
                                                    @error('location_produk')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="address_produk">Alamat :</label>
                                                <div class="input-right-icon">
                                                    <input class="form-control" id="address_produk" name="address_produk" type="text" placeholder="Jalan nusa indah no. 69, Depok" required="required" value="{{ $produk->address }}">
                                                    <span class="span-right-input-icon">
                                                        <a href="#" data-toggle="tooltip" title="Masukan alamat secara lengkap">
                                                            <i class="ul-form__icon i-Information"></i>
                                                        </a>
                                                    </span>
                                                    @error('address_produk')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="contact_produk">Telephone :</label>
                                                <input class="form-control" id="contact" name="contact_produk" type="text" placeholder="0811 1111 1111" required="required" value="{{ $produk->contact }}">
                                                @error('contact_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <h5 class="border-bottom border-gray pb-2 pt-2">Spesifikasi Produk</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tentang_produk">Tentang :</label>
                                                <textarea class="form-control" id="tentang_produk" name="tentang_produk" type="text" placeholder="Produk ini berguna untuk..." required="required">{{ $produk->tentang }}</textarea>
                                                @error('tentang_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="latar_produk">Latar Belakang Produk :</label>
                                                <textarea class="form-control" id="latar_produk" name="latar_produk" type="text" placeholder="Produk ini kami ciptakan agar..." required="required">{{ $produk->latar }}</textarea>
                                                @error('latar_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="keterbaharuan_produk">Keterbaharuan :</label>
                                                <textarea class="form-control" id="keterbaharuan_produk" name="keterbaharuan_produk" type="text" placeholder="Apa yang baru dari produk ini..." required="required">{{ $produk->keterbaharuan }}</textarea>
                                                @error('keterbaharuan_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="spesifikasi_produk">Spesifikasi :</label>
                                                <textarea class="form-control inline" id="spesifikasi_produk" name="spesifikasi_produk" type="text" placeholder="Spesifikasi dari produk ini adalah sebagai berikut..." required="required">{{ $produk->spesifikasi }}</textarea>
                                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">
                                                    Jika lebih dari 1, pisahkan dengan titik koma ( ; )
                                                </small>
                                                @error('spesifikasi_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="manfaat_produk">Manfaat :</label>
                                                <input class="form-control" id="manfaat_produk" name="manfaat_produk" type="text" placeholder="Manfaat dari produk ini adalah sebagai berikut..." required="required" value="{{ $produk->manfaat }}" />
                                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">
                                                    Jika lebih dari 1, pisahkan dengan titik koma ( ; )
                                                </small>
                                                @error('manfaat_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="keunggulan_produk">Keunggulan :</label>
                                                <input class="form-control" id="keunggulan_produk" name="keunggulan_produk" type="text" placeholder="Keunggulan dari produk ini adalah sebagai berikut..." required="required" value="{{ $produk->keunggulan }}" />
                                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">
                                                    Jika lebih dari 1, pisahkan dengan titik koma ( ; )
                                                </small>
                                                @error('keunggulan_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="teknologi_produk">Tekonologi :</label>
                                                <input class="form-control" id="teknologi_produk" name="teknologi_produk" type="text" placeholder="Tekonologi pada produk ini..." required="required" value="{{ $produk->teknologi }}">
                                                @error('teknologi_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pengembangan_produk">Pengembangan :</label>
                                                <input class="form-control" id="pengembangan_produk" name="pengembangan_produk" type="text" placeholder="Pengembangan produk..." required="required" value="{{ $produk->pengembangan }}">
                                                @error('pengembangan_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="proposal_produk">Proposal :</label>
                                                <a href="#" data-toggle="tooltip" title="Tidak usah di isi jika tidak akan mengganti">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="proposal_produk" name="proposal_produk" type="file" value="{{ old('proposal_produk') }}">
                                                        <label class="custom-file-label" for="proposal_produk">{{ $produk->proposal ?? 'Choose file' }}</label>
                                                    </div>
                                                </div>
                                                File yang anda input sebelumnya : 
                                                <a href="{{ asset('file/produk/produk'.'/'.$produk->proposal) }}" class="font-weight-bold">
                                                    {{ $produk->proposal ?? 'tidak ada data' }}
                                                </a>
                                                @error('proposal_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bisnis">
                                        <h5 class="border-bottom border-gray pb-2">Detail Bisnis</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="kompetitor_bisnis">Kompetitor :</label>
                                                <textarea class="form-control" id="kompetitor_bisnis" name="kompetitor_bisnis" type="text" placeholder="Siapa kompetitor anda..." required="required">{{ $produk->produk_bisnis->kompetitor }}</textarea>
                                                @error('kompetitor_bisnis')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="terget_pasar_bisnis">Target Pasar :</label>
                                                <textarea class="form-control" id="target_pasar_bisnis" name="target_pasar_bisnis" type="text" placeholder="Pria usia 40 tahun keatas..." required="required">{{ $produk->produk_bisnis->target_pasar }}</textarea>
                                                @error('target_pasar_bisnis')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="dampak_sosek_bisnis">Dampak Sosial dan Ekonomi :</label>
                                                <a href="#" data-toggle="tooltip" title="Apa saja dampak dari produk anda yang berhubungan dengan Sosial dan Ekonomi sekitar">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <textarea class="form-control" id="dampak_sosek_bisnis" name="dampak_sosek_bisnis" type="text" placeholder="Bagaimana dampaknya" required="required">{{ $produk->produk_bisnis->dampak_sosek }}</textarea>
                                                @error('dampak_sosek_bisnis')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="produksi_harga_bisnis">Produksi Harga :</label>
                                                <textarea class="form-control" id="produksi_harga_bisnis" name="produksi_harga_bisnis" type="text" placeholder="Rp. 100000" required="required">{{ $produk->produk_bisnis->produksi_harga }}</textarea>
                                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">
                                                    Jika lebih dari 1, pisahkan dengan titik koma ( ; )
                                                </small>
                                                @error('produksi_harga_bisnis')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="ul-form__label" for="pemasaran_bisnis">Pemasaran :</label>
                                                <a href="#" data-toggle="tooltip" title="Ceritakan bagaimana anda memasarkan produk">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <textarea class="form-control" id="pemasaran_bisnis" name="pemasaran_bisnis" type="text" placeholder="Bagaimana pemasarannya" required="required">{{ $produk->produk_bisnis->pemasaran }}</textarea>
                                                @error('pemasaran_bisnis')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div id="canvas">
                                        <h5 class="border-bottom border-gray pb-2">Gambaran Canvas Produk</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tanggal_canvas">Tanggal :</label>
                                                <input class="form-control" id="tanggal_canvas" name="tanggal_canvas" type="date"  required="required" value="{{ $produk->produk_canvas->tanggal }}" >
                                                @error('tanggal_canvas')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="kategori_canvas">Kategori Canvas :</label>
                                                <select class="form-control" name="kategori_canvas" required="required">
                                                    <option value="1" {{ $produk->produk_canvas->kategori == 1 ? 'selected':'' }}>Produk</option>
                                                    <option value="2" {{ $produk->produk_canvas->kategori == 2 ? 'selected':'' }}>Pemasaran</option>
                                                    <option value="3" {{ $produk->produk_canvas->kategori == 3 ? 'selected':'' }}>Target</option>
                                                </select>
                                                @error('kategori_canvas')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <textarea name="canvas_canvas" id="editor" class="form-control" placeholder="Gambar bisa dengan table atau yang lainnya">{!! $produk->produk_canvas->canvas !!}</textarea>
                                        @error('canvas_canvas')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- <div id="editor"></div> -->
                                    </div>
                                    <div id="ijin">
                                        <h5 class="border-bottom border-gray pb-2">Kelengkapan Ijin Produk</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="jenis_ijin">Jenis Ijin :</label>
                                                <select class="form-control" name="jenis_ijin" required="required">
                                                    <option value="P-IRT" {{ $produk->produk_ijin->jenis == 'P-IRT' ? 'selected':'' }}>P-IRT</option>
                                                    <option value="Sertifikasi Penyuluhan" {{ $produk->produk_ijin->jenis == 'Sertifikasi Penyulihan' ? 'selected':'' }}>Sertifikasi Penyuluhan</option>
                                                    <option value="MD BPOM" {{ $produk->produk_ijin->jenis == 'MD BPOM' ? 'selected':'' }}>MD BPOM</option>
                                                    <option value="ML BPOM" {{ $produk->produk_ijin->jenis == 'ML BPOM' ? 'selected':'' }}>ML BPOM</option>
                                                </select>
                                                @error('jenis_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pemberi_ijin">Pemberi Ijin :</label>
                                                <input class="form-control" id="pemberi_ijin" name="pemberi_ijin" type="text" placeholder="Jorge Antonio..." required="required" value="{{ $produk->produk_ijin->pemberi }}" >
                                                @error('pemberi_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="status_ijin">Status Ijin :</label>
                                                <select class="form-control" name="status_ijin" required="required">
                                                    <option value="Aktif" {{ $produk->produk_ijin->status == 'Aktif' ? 'selected':'' }}>Aktif</option>
                                                    <option value="Tidak Aktif" {{ $produk->produk_ijin->status == 'Tidak Aktif' ? 'selected':'' }}>Tidak Aktif</option>
                                                </select>                                                
                                                @error('status_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tahun_ijin">Tahun :</label>
                                                <input class="form-control" id="tahun_ijin" name="tahun_ijin" type="number" required="required" value="{{ $produk->produk_ijin->tahun }}" min="1995" max="2099" step="1">
                                                @error('tahun_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tanggal_ijin">Tanggal :</label>
                                                <input class="form-control" id="tanggal_ijin" name="tanggal_ijin" type="date" required="required" value="{{ $produk->produk_ijin->tanggal }}">
                                                @error('tanggal_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="dokumen_ijin">Dokumen :</label>
                                                <a href="#" data-toggle="tooltip" title="Tidak usah di isi jika tidak akan mengganti">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="dokumen_ijin" name="dokumen_ijin" type="file" value="{{ old('dokumen_ijin') }}" >
                                                        <label class="custom-file-label" for="dokumen_ijin">{{ $produk->produk_ijin->dokumen ?? 'Choose file' }}</label>
                                                    </div>
                                                </div>
                                                File yang anda input sebelumnya : 
                                                <a href="{{ asset('file/produk/ijin'.'/'.$produk->produk_ijin->dokumen) }}" class="font-weight-bold">
                                                    {{ $produk->produk_ijin->dokumen ?? 'tidak ada data' }}
                                                </a>
                                                @error('dokumen_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="custom-separator"></div>
                                        </div>
                                    </div>
                                    <div id="image">
                                        <h5 class="border-bottom border-gray pb-2">Foto Produk Anda <a class="btn btn-primary" href="javascript:void(0);" id="add_foto" title="Add field">+</a></h5>
                                        <div class="field_foto">
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <img src="{{ asset('img/produk/dummy.jpg') }}" width="200px" height="130px">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group col-md-10">
                                                        <label class="ul-form__label" for="foto_image">Foto :</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input class="custom-file-input" id="foto_image" name="foto_image[]" type="file">
                                                                <label class="custom-file-label" for="foto_image">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @error('foto')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                        <input class="form-control" name="caption_image[]" id="caption_image" type="text" placeholder="Ini diisi caption" value="">
                                                        @error('caption_image')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-separator mb-3"></div>
                                        @foreach($image as $row)
                                        <div class="field_image">
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <img src="{{ asset('img/produk/' . $row->image) }}" width="200px" height="130px" alt="{{ $row->image }}"><br>
                                                    <a href="{{ route('tenant.produk.deleteImage', $row->id) }}" class="deleteImage btn btn-sm btn-danger">Hapus Gambar</a>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group col-md-10">
                                                        <label class="ul-form__label" for="foto_image">Foto :</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input class="custom-file-input" id="foto_image" name="foto_image[]" type="file">
                                                                <label class="custom-file-label" for="foto_image">{{ $row->image }}</label>
                                                            </div>
                                                            <!-- <div class="col-auto">
                                                                <a class="btn btn-primary" href="#" id="#" title="Add field">-</a>
                                                            </div> -->
                                                        </div>
                                                        @error('foto')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                        <input class="form-control" name="caption_image[]" id="caption_image" type="text" placeholder="Ini diisi caption" value="{{ $row->caption }}">
                                                        @error('caption_image')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="custom-separator mb-3"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="ki">
                                        <h5 class="border-bottom border-gray pb-2">Kelengkapan Kekayaan Intelektual</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="jenis_ki">Jenis Kekayaan Intelektual :</label>
                                                <select class="form-control" name="jenis_ki" required="required">
                                                    <option value="1" {{ $produk->produk_ki->jenis == 1 ? 'selected':'' }}>Hak Cipta</option>
                                                    <option value="2" {{ $produk->produk_ki->jenis == 2 ? 'selected':'' }}>Paten</option>
                                                    <option value="3" {{ $produk->produk_ki->jenis == 3 ? 'selected':'' }}>Merk Dagang</option>
                                                    <option value="4" {{ $produk->produk_ki->jenis == 4 ? 'selected':'' }}>Rahasia Dagang</option>
                                                </select>
                                                @error('jenis_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="status_ki">Status :</label>
                                                <select class="form-control" name="status_ki" required="required">
                                                    <option value="Aktif" {{ $produk->produk_ki->status == 'Aktif' ? 'selected':'' }}>Aktif</option>
                                                    <option value="Tidak Aktif" {{ $produk->produk_ki->jenis == 'Tidak Aktif' ? 'selected':'' }}>Tidak Aktif</option>
                                                </select>
                                                @error('status_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="permohonan_ki">Permohonan :</label>
                                                <input class="form-control" id="permohonan_ki" name="permohonan_ki" type="text" placeholder="Permohonan..." required="required" value="{{ $produk->produk_ki->permohonan }}">
                                                @error('permohonan_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="sertifikat_ki">Sertifikat :</label>
                                                <a href="#" data-toggle="tooltip" title="Tidak usah di isi jika tidak akan mengganti">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="sertifikat_ki" name="sertifikat_ki" type="file" value="{{ old('sertifikat_ki') }}">
                                                        <label class="custom-file-label" for="sertifikat_ki">
                                                            {{ $produk->produk_ki->sertifikat ?? 'Choose file' }}
                                                        </label>
                                                    </div>
                                                </div>
                                                File yang anda input sebelumnya : 
                                                <a href="{{ asset('file/produk/ki'.'/'.$produk->produk_ki->sertifikat) }}" class="font-weight-bold">
                                                    {{ $produk->produk_ki->sertifikat ?? 'tidak ada data' }}
                                                </a>
                                                @error('sertifikat_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="berlaku_mulai_ki">Berlaku Mulai :</label>
                                                <input class="form-control" id="berlaku_mulai_ki" name="berlaku_mulai_ki" type="date" placeholder="Berlaku mulai..." required="required" value="{{ $produk->produk_ki->berlaku_mulai }}">
                                                @error('berlaku_mulai_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="berlaku_sampai_ki">Berlaku Sampai :</label>
                                                <input class="form-control" id="berlaku_sampai_ki" name="berlaku_sampai_ki" type="date" placeholder="Berlaku Sampai..." required="required" value="{{ $produk->produk_ki->berlaku_sampai }}">
                                                @error('berlaku_sampai_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pemilik_ki">Pemilik KI :</label>
                                                <input class="form-control" id="pemilik_ki" name="pemilik_ki" type="text" placeholder="Pemilik Kekayaan Intelektual..." required="required" value="{{ $produk->produk_ki->pemilik_ki }}">
                                                @error('pemilik_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                    </div>
                                    <div id="riset">
                                        <h5 class="border-bottom border-gray pb-2">Dokumen Riset Produk</h5>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="nama_riset">Nama Riset :</label>
                                                <input class="form-control" id="nama_riset" name="nama_riset" type="text" placeholder="Nama riset..." required="required" value="{{ $produk->produk_riset->nama_riset }}" />
                                                @error('nama_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pelaksana_riset">Pelaksanaan :</label>
                                                <input class="form-control" id="pelaksana_riset" name="pelaksana_riset" type="text" placeholder="Pelaksana riset..." required="required" value="{{ $produk->produk_riset->pelaksana }}" />
                                                @error('pelaksana_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tahun_riset">Tahun :</label>
                                                <input class="form-control" id="tahun_riset" name="tahun_riset" type="number" required="required" value="2020" min="1995" max="2099" step="1" value="{{ $produk->produk_riset->tahun }}" />
                                                @error('tahun_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pendanaan_riset">Pendanaan :</label>
                                                <input class="form-control" id="pendanaan_riset" name="pendanaan_riset" type="text" placeholder="Pendanaan riset..." required="required" value="{{ $produk->produk_riset->pendanaan }}">
                                                @error('pendanaan_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="skema_riset">Skema :</label>
                                                <input class="form-control" id="skema_riset" name="skema_riset" type="text" placeholder="Skema riset..." required="required" value="{{ $produk->produk_riset->skema }}">
                                                @error('skema_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="nilai_riset">Nilai :</label>
                                                <input class="form-control" id="nilai_riset" name="nilai_riset" type="text" placeholder="Nilai..." required="required" value="{{ $produk->produk_riset->nilai }}">
                                                @error('nilai_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="aktifitas_riset">Aktifitas :</label>
                                                <input class="form-control" id="aktifitas_riset" name="aktifitas_riset" type="text" placeholder="Aktifitas selama riset..." required="required" value="{{ $produk->produk_riset->aktifitas }}">
                                                @error('aktifitas_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tujuan_riset">Tujuan :</label>
                                                <input class="form-control" id="tujuan_riset" name="tujuan_riset" type="text" placeholder="Tujuan dari riset..." required="required" value="{{ $produk->produk_riset->tujuan }}">
                                                @error('tujuan_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="hasil_riset">Hasil :</label>
                                                <input class="form-control" id="hasil_riset" name="hasil_riset" type="text" placeholder="Hasil dari dilaksanakannya riset..." required="required" value="{{ $produk->produk_riset->hasil }}">
                                                @error('hasil_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                    </div>
                                    <div id="sertifikasi">
                                        <h5 class="border-bottom border-gray pb-2">Kelengkapan Sertifikasi Produk</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="jenis_sertifikasi">Jenis Setifikasi :</label>
                                                <select class="form-control" name="jenis_sertifikasi" required="required">
                                                    <option value="P-IRT" {{ $produk->produk_sertifikasi->jenis_sertif == 'P-IRT' ? 'selected':'' }}>P-IRT</option>
                                                    <option value="HACCP" {{ $produk->produk_sertifikasi->jenis_sertif == 'HACCP' ? 'selected':'' }}>HACCP</option>
                                                    <option value="Halal" {{ $produk->produk_sertifikasi->jenis_sertif == 'Halal' ? 'selected':'' }}>Halal</option>
                                                    <option value="MD (Merek Dalam)" {{ $produk->produk_sertifikasi->jenis_sertif == 'MD (Merek Dalam)' ? 'selected':'' }}>MD (Merek Dalam)</option>
                                                    <option value="Lainnya"  {{ $produk->produk_sertifikasi->jenis_sertif == 'Lainnya' ? 'selected':'' }}>Lainnya</option>
                                                </select>
                                                @error('jenis_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="pemberi_sertifikasi">Pemberi Sertifikasi :</label>
                                                <select class="form-control" name="pemberi_sertifikasi" required="required">
                                                    <option value="Dinas Kesehatan Kabupaten/Kota" {{ $produk->produk_sertifikasi->pemberi_sertif == 'Dinas Kesehatan Kabupaten/Kota' ? 'selected':'' }}>Dinas Kesehatan Kabupaten/Kota</option>
                                                    <option value="BPOM" {{ $produk->produk_sertifikasi->pemberi_sertif == 'BPOM' ? 'selected':'' }}>BPOM</option>
                                                    <option value="LPPOM MUI" {{ $produk->produk_sertifikasi->pemberi_sertif == 'LPPOM MUI' ? 'selected':'' }}>LPPOM MUI</option>
                                                    <option value="Lainnya" {{ $produk->produk_sertifikasi->pemberi_sertif == 'Lainnya' ? 'selected':'' }}>Lainnya</option>
                                                </select>
                                                @error('pemberi_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tanggal_sertifikasi">Tanggal :</label>
                                                <input class="form-control" id="tanggal_sertifikasi" name="tanggal_sertifikasi" type="date" required="required" value="{{ $produk->produk_sertifikasi->tanggal }}" />
                                                @error('tanggal_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="tahun_sertifikasi">Tahun :</label>
                                                <input class="form-control" id="tahun_sertifikasi" name="tahun_sertifikasi" type="number" required="required" value="2020" min="1995" max="2099" step="1" required="required" value="{{ $produk->produk_sertifikasi->tahun }}" />
                                                @error('tahun_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="dokumen_sertifikasi">Dokumen :</label>
                                                <a href="#" data-toggle="tooltip" title="Tidak usah di isi jika tidak akan mengganti">
                                                    <i class="ul-form__icon i-Information"></i>
                                                </a>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="dokumen_sertifikasi" name="dokumen_sertifikasi" type="file">
                                                        <label class="custom-file-label" for="dokumen_sertifikasi">{{ $produk->produk_sertifikasi->dokumen }}</label>
                                                    </div>
                                                </div>
                                                File yang anda input sebelumnya : 
                                                <a href="{{ asset('file/produk/sertifikasi'.'/'.$produk->produk_sertifikasi->dokumen) }}" class="font-weight-bold">
                                                    {{ $produk->produk_sertifikasi->dokumen ?? 'tidak ada data' }}
                                                </a>
                                                @error('dokumen_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="ul-form__label" for="status_sertifikasi">Status :</label>
                                                <select class="form-control" name="status_sertifikasi" required="required">
                                                    <option value="Aktif" {{ $produk->produk_sertifikasi->status == 'Aktif' ? 'selected':'' }}>Aktif</option>
                                                    <option value="Tidak Aktif" {{ $produk->produk_sertifikasi->status == 'Tidak Aktif' ? 'selected':'' }}>Tidak Aktif</option>
                                                </select>
                                                @error('status_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                    </div>
                                    <div id="team">
                                        <h5 class="border-bottom border-gray pb-2">Team Pengembangan Produk</h5>
                                        @foreach($produk_team as $row)
                                        <div class="row" id="field_team">
                                            <div class="col-md-6 mb-2">
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label" for="user_id_team">Nama</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" name="user_id_team[]" required="required">
                                                                    @forelse($user_id as $row)
                                                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                                                    @empty
                                                                        <option>Belum ada anggota di tenant ini</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label" for="jabatan_team">Jabatan</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="jabatan_team" name="jabatan_team[]" type="text" placeholder="Digital marketing...">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label" for="divisi_team">Divisi</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="divisi_team" name="divisi_team[]" type="text" placeholder="Marketing">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label" for="tugas_team">Tugas</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" id="tugas_team" name="tugas_team[]" type="text" placeholder="Memupuk pundi-pundi customer"></textarea>
                                                            </div>
                                                        </div>
                                                        <a class="btn btn-primary" href="javascript:void(0);" id="add_team" title="Add field">Tambah Orang</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('theme/js/plugins/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/smart.wizard.script.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/form.validation.script.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/tagging.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/tagging.script.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script type="text/javascript">

//Field tag        
    $(document).ready(function() {
        $('select').selectpicker();
    });

//text editor
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

//Field Proposal di Detail
    $("body").on("change", ".custom-file-input", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


//Field Foto Produk
    $(document).ready(function(){
        var maxField = 5;
        var addButton = $('#add_foto');
        var wrapper = $('.field_foto');
        var fieldHTML = '<div class="form-row"> <div class="col-md-3"> <img src="{{ asset('img/produk/dummy.jpg') }}" width="200px" height="130px"> <a href="javascript:void(0);" class="remove_button btn btn-danger">Hapus</a> </div> <div class="col-md-9"> <div class="form-group col-md-10"> <label class="ul-form__label" for="foto_image">Foto :</label> <div class="input-group"> <div class="custom-file"> <input class="custom-file-input" id="foto_image" name="foto_image[]" type="file"> <label class="custom-file-label" for="foto_image">Choose file</label> </div> </div> @error('foto') <div class="text-danger"> {{ $message }} </div> @enderror </div> <div class="form-group col-md-10"> <input class="form-control" name="caption_image[]" id="caption_image" type="text" placeholder="Ini diisi caption" value="{{ old('caption_image') }}"> @error('caption_image') <div class="text-danger"> {{ $message }} </div> @enderror </div> </div> </div> '; 
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){ 
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('').parent('').remove();
            x--;
        });
    });

//Field team
    $(document).ready(function(){
        $('body').on('click', '#add_team', function () {
            console.log('ok');
            var rap = $('#field_team');
            $.ajax({
                url: 'api/getUser',
                success: function(data){
                    var html = '<div class="col-md-6 mb-2"><div class="card mb-2"><div class="card-body"><div class="form-group row"><label class="col-sm-2 col-form-label" for="user_id_team">Nama</label><div class="col-sm-10"><select class="form-control" name="user_id_team[]" required="required">'+data.option+'</select></div></div><div class="form-group row"><label class="col-sm-2 col-form-label" for="jabatan_team">Jabatan</label><div class="col-sm-10"><input class="form-control" id="jabatan_team" name="jabatan_team[]" type="text" placeholder="Digital marketing..."></div></div><div class="form-group row"><label class="col-sm-2 col-form-label" for="divisi_team">Divisi</label><div class="col-sm-10"><input class="form-control" id="divisi_team" name="divisi_team[]" type="text" placeholder="Marketing"></div></div><div class="form-group row"><label class="col-sm-2 col-form-label" for="tugas_team">Tugas</label><div class="col-sm-10"><textarea class="form-control" id="tugas_team" name="tugas_team[]" type="text" placeholder="Memupuk pundi-pundi customer"></textarea></div></div><a href="javascript:void(0);" class="remove_button btn btn-danger">Hapus</a></div></div></div>';
                    $(rap).append(html);
                }
            });
        });
    });

//Delete Image
    $(document).ready(function(){
        var wrapper = $('.field_image')
        $(wrapper).on('click','.deleteImage', function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('href'),
                success : function(){
                    $(wrapper).parent('').parent('').remove();
                }
            })
        });
    });
</script>
@endsection