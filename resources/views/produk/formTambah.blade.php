@extends('layouts.app')
@section('content')
<form action="{{ route('tenant.storeProduk') }}" method="post" enctype="multipart/form-data" >
@csrf
	<div class="row">
		<div class="col-xl-6 col-lg-6">
			<div class="card">
				<div class="card-header container-fluid">
	  				<div class="row">
						<div class="col-md-10">
		  					<h3>Produk</h3>
						</div>
	  				</div>
                </div>
                <div class="card-body">
                    <div class="ul-widget__body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="Nama Produk" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="subtitle" rows="3" placeholder="Subtitle"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="harga_pokok" type="text" placeholder="Harga Pokok" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="harga_jual" type="text" row="3" placeholder="Harga Jual" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="contact" type="text" placeholder="No Telphone" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="location" rows="3" placeholder="Location"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="address" rows="7" placeholder="Address"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
			<div class="card mb-4">
				<div class="card-header container-fluid">
					<h3>Detail Produk</h3>
                </div>
                    <div class="card-body">
                        <div class="ul-widget__body">
                            <div class="form-group">
                                <input class="form-control" name="spesifikasi" type="text" placeholder="Spesifikasi" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="keterbaharuan" type="text" placeholder="Keterbaharuan" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="manfaat" type="text" placeholder="Manfaat" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="keunggulan" type="text" placeholder="Keunggulan" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="teknologi" type="text" placeholder="Teknologi" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="pengembangan" type="text" placeholder="Pengembangan" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="latar_produk" rows="3" placeholder="Latar Produk"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="tentang_produk" rows="7" placeholder="Tentang Produk"></textarea>
                            </div>
                        </div>
                    </div>
			    </div>
            </div>
        </div>
		<div class="col-xl-12 col-lg-4">
			<div class="card mb-4">
				<div class="card-header container-fluid">
					<h3>Lainnya</h3>
				</div>
				<div class="card-body">
					<div class="ul-widget__body">
                        <div class="form-group" hidden>
							<label>Tenant Id :</label>
	           				<div class="input-group">
								<input type="text" class="form-control" name="tenant_id" value="0" required>
	           				</div>
                        </div>
                        <div class="form-group" hidden>
							<label>Inventor Id :</label>
	           				<div class="input-group">
								<input type="text" class="form-control" name="inventor_id" value="0" required>
	           				</div>
                        </div>
                        <div class="form-group" hidden>
							<label>Priority Id :</label>
	           				<div class="input-group">
								<input type="text" class="form-control" name="priority" value="0" required>
	           				</div>
						</div>
                        {{-- <div class="form-group">
                            <label>User Id :</label>
                            <div class="input-group">
                                <select name="user_id" class="form-control custom-select" required>
                                 	<option value="">Pilih</option>
                                    @foreach ($user_id as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Produk Id :</label>
                            <div class="input-group">
                                <select name="berita_category_id" class="form-control custom-select" required>
                                 	<option value="">Pilih</option>
                                    @foreach ($kategori_berita as $row)
                                        <option value="{{ $row->id }}">{{ $row->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
						{{-- <div class="form-group">
							<label>Jabatan :</label>
	           				<div class="input-group">
								<select name="author_id" class="form-control custom-select" required>
                                 	<option value="">Pilih</option>
                                    @foreach ($penulis as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
	           				</div>
						</div> --}}
                        {{-- <div class="form-group">
                            <label>Divisi :</label>
                            <div class="input-group">
                                <select name="inkubator_id" class="form-control" required>
                                 	<option value="">Pilih</option>
                                 	<option value="0">Umum / Semua orang</option>
                                    @foreach ($inkubator as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Tugas :</label>
                            <div class="input-group">
                                <select name="inkubator_id" class="form-control" required>
                                 	<option value="">Pilih</option>
                                 	<option value="0">Umum / Semua orang</option>
                                    @foreach ($inkubator as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="input-group">
                                <select name="tag" class="form-control custom-select" required>
                                    <option value="">Tag</option>
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <select name="kategori" class="form-control custom-select" required>
                                    <option value="">Kategori</option>
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto">Uploda Proposal</label><br>
                            <input type="file" name="proposal" value="{{ old('proposal') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Upload Foto</label><br>
                            <input type="file" name="foto" value="{{ old('foto') }}" required>
                        </div>
						<div class="form-group">
							<button class="btn btn-primary">Tambah</button>
						</div>
					</div>
				</div>
			</div>
        </div>
	</div>
</form>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'berita' );
</script>
@endsection
