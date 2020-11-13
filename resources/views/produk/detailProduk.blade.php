@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
    .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }

    .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1; }

    .product-title, .price, .sizes, .colors {
        text-transform: UPPERCASE;
        font-weight: bold; }

    .checked, .price span {
        color: #ff9f1a; }

    .product-title, .rating, .product-description, .price, .vote, .sizes {
        margin-bottom: 15px; }

    .product-title {
        margin-top: 0; }

    .size {
        margin-right: 10px; }
  
    .size:first-of-type {
        margin-left: 40px; }

    .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px; }

    .color:first-of-type {
        margin-left: 20px; }

    .add-to-cart, .like {
        background: #ff9f1a;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #fff;
        -webkit-transition: background .3s ease;
        transition: background .3s ease; }

    .add-to-cart:hover, .like:hover {
        background: #b36800;
        color: #fff; }

    .not-available {
        text-align: center;
        line-height: 2em; }
    
    .not-available:before {
        font-family: fontawesome;
        content: "\f00d";
        color: #fff; }

    .orange {
        background: #ff9f1a; }

    .green {
        background: #85ad00; }

    .blue {
        background: #0076ad; }

    .tooltip-inner {
        padding: 1.3em; }

    #carousel-thumb .carousel-indicators {
        margin: 10px 0 0;
        /*overflow: auto;*/
        position: static;
        text-align: left;
        white-space: nowrap;
        width: 100%;
    }

    #carousel-thumb .carousel-inner img{
        height:500px;
    }
    
    #carousel-thumb .carousel-indicators li {
        background-color: transparent;
        -webkit-border-radius: 0;
        border-radius: 0;
        display: inline-block;
        height: auto;
        margin: 0 !important;
        width: auto;
    }

    #carousel-thumb .carousel-indicators li img {
        display: block;
        opacity: 0.5;
    }

    #carousel-thumb .carousel-indicators li.active img {
        opacity: 1;
    }

    #carousel-thumb .carousel-indicators li:hover img {
        opacity: 0.75;
    }
    #carousel-thumb .carousel-outer {
        position: relative;
    }
</style>
@endsection
@section('content')
	<div class="breadcrumb">
		<h1 class="mr-2">Data Produk</h1>
	</div>
	<div class="separator-breadcrumb border-top"></div>
	<section class="ul-product-detail">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
      							<!--Slides-->
      								<div class="carousel-inner" role="listbox">
      									@foreach($image as $key => $row)
        								<div class="carousel-item item{{ $key == 0 ? ' active' : '' }}">
          									<img class="d-block w-100" src="{{ asset('img/produk/' . $row->image) }}" alt="{{ $row->judul }}">
        								</div>
										@endforeach
      								</div>
      							<!--/.Slides-->
      							<!--Controls-->
      								<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
        								<span class="sr-only">Previous</span>
      								</a>
      								<a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        								<span class="carousel-control-next-icon" aria-hidden="true"></span>
        								<span class="sr-only">Next</span>
      								</a>
      							<!--/.Controls-->
      								<ol class="carousel-indicators">
      									@foreach ($image as $row)
        								<li data-target="#carousel-thumb" data-slide-to="{{ $row['id'] }}" class="active"> 
        									<img class="d-block w-100" style="height: 40px; width: 150px" src="{{ asset('img/produk/' . $row->image) }}" class="img-fluid">
        								</li>
        								@endforeach
      								</ol>
    							</div>
							</div>
							<div class="col-lg-2">
								<img src="{{ asset('img/produk/' . $produk->produk_image->image) }}" style="max-width:100%;height:auto" />
								<hr>
								<p class="product-description">{{ $produk->subtitle }}</p>
							</div>
							<div class="col-lg-4">
								<h3 class="product-title">{{ $produk->title }}</h3>
								<div class="rating">
									<div class="stars">
										<span class="fas fa-star checked"></span>
										<span class="fas fa-star checked"></span>
										<span class="fas fa-star checked"></span>
										<span class="fas fa-star"></span>
										<span class="fas fa-star"></span>
									</div>
									<span class="review-no">41 reviews</span>
								</div>
								<p class="product-description">{{ $produk->tentang }}</p>
								<h4 class="price">current price: <span>Rp  {{ number_format($produk->harga_jual,0,',','.') }}</span></h4>
								<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ul-product-detail__box">
		<div class="row">
			<div class="col-lg-3 col-md-3 mt-4 text-center">
				<div class="card">
					<div class="card-body">
						<div class="ul-product-detail__border-box">
							<div class="ul-product-detail--icon mb-2"><i class="i-Car text-success text-25 font-weight-500"></i></div>
							<h5 class="heading">Quick Delivery</h5>
							<p class="text-muted text-12">Jaminan pengiriman cepat karena kami berkolaborasi dengan jasa pengiriman yang handal.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 mt-4 text-center">
				<div class="card">
					<div class="card-body">
						<div class="ul-product-detail__border-box">
							<div class="ul-product-detail--icon mb-2"><i class="i-Reload text-danger text-25 font-weight-500"></i></div>
							<h5 class="heading">Back In 30 Days</h5>
							<p class="text-muted text-12">Garansi pengembalian barang sampai 30 hari. S&K berlaku tentunya.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 mt-4 text-center">
				<div class="card">
					<div class="card-body">
						<div class="ul-product-detail__border-box">
							<div class="ul-product-detail--icon mb-2"><i class="i-Headset text-info text-25 font-weight-500"></i></div>
							<h5 class="heading">Support 24/7</h5>
							<p class="text-muted text-12">Customer service yang siap melayani saat anda membutuhkannya.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 mt-4 text-center">
				<div class="card">
					<div class="card-body">
						<div class="ul-product-detail__border-box">
							<div class="ul-product-detail--icon mb-2"><i class="i-Money-Bag text-warning text-25 font-weight-500"></i></div>
							<h5 class="heading">High Secure Payment</h5>
							<p class="text-muted text-12">Jangan khawatir soal pembayaran, kami akan menjamin pembayaran anda.</p>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
	<section class="ul-product-detail__tab">
		<div class="row">
			<div class="col-lg-12 col-md-12 mt-4">
				<div class="card mt-2 mb-4">
					<div class="card-body">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active show" id="nav-produk-tab" data-toggle="tab" href="#nav-produk" role="tab" aria-controls="nav-produk" aria-selected="true">Detail Produk</a>

								<a class="nav-item nav-link" id="nav-bisnis-tab" data-toggle="tab" href="#nav-bisnis" role="tab" aria-controls="nav-bisnis" aria-selected="false">Bisnis</a>
								
								<a class="nav-item nav-link" id="nav-canvas-tab" data-toggle="tab" href="#nav-canvas" role="tab" aria-controls="nav-canvas" aria-selected="false">Canvas</a>
								
								<a class="nav-item nav-link" id="nav-ijin-tab" data-toggle="tab" href="#nav-ijin" role="tab" aria-controls="nav-ijin" aria-selected="false">Ijin</a>
								
								<a class="nav-item nav-link" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab" aria-controls="nav-image" aria-selected="false">Image</a>
								
								<a class="nav-item nav-link" id="nav-ki-tab" data-toggle="tab" href="#nav-ki" role="tab" aria-controls="nav-ki" aria-selected="false">Kekayaan Intelektual</a>
								
								<a class="nav-item nav-link" id="nav-riset-tab" data-toggle="tab" href="#nav-riset" role="tab" aria-controls="nav-riset" aria-selected="false">Riset</a>
								
								<a class="nav-item nav-link" id="nav-sertifikasi-tab" data-toggle="tab" href="#nav-sertifikasi" role="tab" aria-controls="nav-sertifikasi" aria-selected="false">Sertifikat</a>
								
								<a class="nav-item nav-link" id="nav-team-tab" data-toggle="tab" href="#nav-team" role="tab" aria-controls="nav-team" aria-selected="false">Team</a>

							</div>
						</nav>

						<div class="tab-content ul-tab__content p-5" id="nav-tabContent">
							<div class="tab-pane fade active show" id="nav-produk" role="tabpanel" aria-labelledby="nav-produk-tab">
								<h5 class="mb-5 font-weight-700 text-center">Detail dari {{ $produk->title }}</h5>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12">
										<img class="rounded" src="{{ asset('img/produk/' . $produk->produk_image->image) }}" alt="{{ $produk->produk_image->judul}}" />
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12">
										<dl class="row">
											<dt class="col-sm-3">Nama Tenant</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->tenant->title }} - {{ $produk->priority->name }}</dd>

										  	<dt class="col-sm-3">Inventor</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		@if($produk->inventor_id == 0)
										  			Belum ada data
										  		@else
										  			{{ $produk->inventor_id }}
										  		@endif
										  	</dd> <!-- Belum di deklarasikan -->

										  	<dt class="col-sm-3">Nama Produk</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->title }}</dd>

										  	<dt class="col-sm-3">Subtitle</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->subtitle }}</dd>

										  	<dt class="col-sm-3">Harga Pokok</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">Rp. {{ number_format($produk->harga_pokok,0,',','.') }}</dd>

										  	<dt class="col-sm-3">Harga Jual</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">Rp. {{ number_format($produk->harga_jual,0,',','.') }}</dd>

										  	<dt class="col-sm-3">Kategori Produk</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		@if($produk->kategori_id == 0)
										  			Belum ada data
										  		@else
										  			{{ $produk->kategori_id }}
										  		@endif
										  	</dd> <!-- Belum di deklarasikan -->

										  	<dt class="col-sm-3">Tags</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		<h5>
										  		@foreach($tag as $row)
										  			<span class="badge badge-light">#{{$row}}</span>
										  		@endforeach
										  		</h5>
										  	</dd>

										  	<dt class="col-sm-3">Nama Tenant</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->tenant->title }}</dd>

										  	<dt class="col-sm-3">Lokasi</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->location }}</dd>

										  	<dt class="col-sm-3">Alamat</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->address }}</dd>

										  	<dt class="col-sm-3">Kontak</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->contact }}</dd>

										  	<dt class="col-sm-3">Tentang</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->tentang }}</dd>

										  	<dt class="col-sm-3">Latar</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->latar }}</dd>

										  	<dt class="col-sm-3">Keterbaharuan</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->keterbaharuan }}</dd>

										  	<dt class="col-sm-3">Spesifikasi</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		@foreach($spesifikasi as $row)
                                    				<i class="fas fa-arrow-right"></i>  {{ $row }}<br />
										  		@endforeach

										  	</dd>

										  	<dt class="col-sm-3">Manfaat</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		@foreach($manfaat as $row)
                                    				<i class="fas fa-arrow-right"></i>  {{ $row }}<br />
										  		@endforeach
										  	</dd>

										  	<dt class="col-sm-3">Keunggulan</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		@foreach($keunggulan as $row)
                                    				<i class="fas fa-arrow-right"></i>  {{ $row }}<br />
										  		@endforeach

										  	</dd>

										  	<dt class="col-sm-3">Teknologi</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->teknologi }}</dd>

										  	<dt class="col-sm-3">Pengembangan</dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">{{ $produk->pengembangan }}</dd>

										  	<dt class="col-sm-3">Proposal </dt><dt class="col-md-1"> : </dt>
										  	<dd class="col-sm-8">
										  		<a href="{{ asset('file/produk/produk'.'/'.$produk->proposal) }}">
										  			{{ $produk->proposal }}
										  		</a>
										  	</dd>
										</dl>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="nav-bisnis" role="tabpanel" aria-labelledby="nav-bisnis-tab">
								<h5 class="mb-5 font-weight-700 text-center">Prospek Produk</h5>
								<dl class="row">
									<dt class="col-sm-3">Kompetitor</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_bisnis->kompetitor ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Target Pasar</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_bisnis->target_pasar ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Dampak Sosial dan Sekitar</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_bisnis->dampak_sosek ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Produksi Harga</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_bisnis->produksi_harga ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pemasaran</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_bisnis->pemasaran ?? 'tidak ada data'}}</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-canvas" role="tabpanel" aria-labelledby="nav-canvas-tab">
								<h5 class="mb-5 font-weight-700 text-center">Produk Canvas</h5>
								<dl class="row">
								  	<div class="w-100">{!! $produk->produk_canvas->canvas ?? 'tidak ada data'!!}</div>

								  	<dt class="col-sm-3">Target Pasar</dt>
								  	<dd class="col-sm-8">{{ $produk->produk_canvas->kategori ?? 'tidak ada data'}}</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-ijin" role="tabpanel" aria-labelledby="nav-ijin-tab">
								<h5 class="mb-5 font-weight-700 text-center">Kelengkapan Ijin Produk</h5>
								<dl class="row">
									<dt class="col-sm-3">Nama Produk</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->title }}</dd>

								  	<dt class="col-sm-3">Jenis Ijin</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ijin->jenis_ijin ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pemberi Ijin</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ijin->pemberi ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Status</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ijin->status ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tahun</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ijin->tahun ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tanggal</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ijin->tanggal ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Dokumen</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">
								  		<a href="{{ url('file/produk/ijin'.'/'.$produk->produk_ijin->dokumen ) }}">
								  			{{ $produk->produk_ijin->dokumen ?? 'tidak ada data' }}
								  		</a>
								  	</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
								<h5 class="mb-5 font-weight-700 text-center">Galeri Produk</h5>
								<div class="row">
									@forelse($image as $row)
										<div class="col-md-3">
											<img class="rounded w-100" src="{{ asset('img/produk/' . $row->image) }}" alt="{{ $row->judul }}">
										</div>
									@empty
									<h5>Tidak ada gambar untuk produk ini</h5>
									@endforelse
								</div>
							</div>

							<div class="tab-pane fade" id="nav-ki" role="tabpanel" aria-labelledby="nav-ki-tab">
								<h5 class="mb-5 font-weight-700 text-center">Kekayaan Intelektual</h5>
								<dl class="row">
									<dt class="col-sm-3">Jenis</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->jenis_ki ?? 'tidak ada data'}}</dd>

									<dt class="col-sm-3">Status</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->status_ki ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Permohonan</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->permohonan ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Sertifikat</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">
								  		<a href="{{ url('file/produk/ki'.'/'.$produk->produk_ki->sertifikat ?? 'tidak ada data') }}">
								  			{{ $produk->produk_ki->sertifikat ?? 'tidak ada data' }}
								  		</a>
								  	</dd>

								  	<dt class="col-sm-3">Berlaku Mulai</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->berlaku_mulai ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Berlaku Sampai</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->berlaku_sampai ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pemilik KI</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_ki->pemilik_ki ?? 'tidak ada data'}}</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-riset" role="tabpanel" aria-labelledby="nav-riset-tab">
								<h5 class="mb-5 font-weight-700 text-center">Riset Produk</h5>
								<dl class="row">
									<dt class="col-sm-3">Nama Riset</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->nama_riset ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pelaksana</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->pelaksana ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tahun</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->tahun ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pendanaan</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->pendanaan ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Skema</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->skema ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Nilai</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->nilai ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Aktifitas</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->aktifitas ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tujuan</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->tujuan ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Hasil</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_riset->hasil ?? 'tidak ada data'}}</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-sertifikasi" role="tabpanel" aria-labelledby="nav-sertifikasi-tab">
								<h5 class="mb-5 font-weight-700 text-center">Sertifikasi Produk</h5>
								<dl class="row">
									<dt class="col-sm-3">Jenis Sertifikasi</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_sertifikasi->jenis_sertif ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Pemberi Sertifikasi</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_sertifikasi->pemberi_sertif ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Status</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_sertifikasi->status ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tahun</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_sertifikasi->tahun ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Tanggal</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">{{ $produk->produk_sertifikasi->tanggal ?? 'tidak ada data'}}</dd>

								  	<dt class="col-sm-3">Jenis Sertifikasi</dt><dt class="col-md-1"> : </dt>
								  	<dd class="col-sm-8">
								  		<a href="{{ url('file/produk/sertifikasi'.'/'.$produk->produk_sertifikasi->dokumen ?? 'tidak ada data') }}">
								  			{{ $produk->produk_ijin->dokumen ?? 'tidak ada data' }}
								  		</a>
								  	</dd>
								</dl>
							</div>

							<div class="tab-pane fade" id="nav-team" role="tabpanel" aria-labelledby="nav-team">
								<div class="ul-product-detail__nested-card mt-2">
									<div class="row text-center">
										@foreach( $produk_team as $row )
										<div class="col-lg-3 col-sm-12 mb-2">
											<div class="card">
												<img src="{{ asset('img/produk/bussinesMan.svg') }}" class="card-img-top mt-2" alt="bussinesMan">
												<div class="card-body">
													<div class="ul-product-detail__border-box">
														<h5 class="heading">{{ $row->profil_user->nama ?? 'tidak ada data'}}</h5>
														<p class="text-muted text-12">{{ $row->profil_user->deskripsi ?? 'tidak ada data'}}</p>
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
				</div>
			</div>
		</div>
	</section>
@endsection