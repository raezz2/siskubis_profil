@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}

    .input-container {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      width: 100%;
      margin-bottom: 15px;
    }

    .icon {
      padding: 10px;
      background: #402060;
      color: white;
      min-width: 50px;
      text-align: center;
    }

    .input-field {
      width: 100%;
      padding: 10px;
      outline: none;
    }

    .input-field:focus {
      border: 2px solid #402060;
    }

    /* Set a style for the submit button */
    .btn {
      background-color: #402060;
      color: white;
      padding: 15px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.9;
    }

    .btn:hover {
      opacity: 1;
    }
</style>

@endsection
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
                    <div class="input-container">
                        <i class="fas fa-user-tie icon"></i>
                        <input class="form-control" type="text" placeholder="Username" name="title">
                    </div>
                    <div class="input-container">
                        <i class="fas fa-money-bill-wave-alt icon"></i>
                        <input class="form-control" name="harga_pokok" type="text" placeholder="Harga Pokok" />
                    </div>
                    <div class="input-container">
                        <i class="fas fa-money-bill-wave-alt icon"></i>
                        <input class="form-control" name="harga_jual" type="text" row="3" placeholder="Harga Jual" />
                    </div>
                    <div class="input-container">
                        <i class="fas fa-phone-alt icon"></i>
                        <input class="form-control" name="contact" type="text" placeholder="No Telphone" />
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="tag" class="form-control custom-select" required>
                                <option value="0">Tag</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="kategori" class="form-control custom-select" required>
                                <option value="0">Kategori</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-container">
                        <textarea class="form-control" name="subtitle" rows="2" placeholder="Subtitle"></textarea>
                    </div>
                    <div class="input-container">
                        <textarea class="form-control" name="location" rows="3" placeholder="Location"></textarea>
                    </div>
                    <div class="input-container">
                        <textarea class="form-control" name="address" rows="5" placeholder="Address"></textarea>
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
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="spesifikasi" type="text" placeholder="Spesifikasi" />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="keterbaharuan" type="text" placeholder="Keterbaharuan" />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="manfaat" type="text" placeholder="Manfaat" />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="keunggulan" type="text" placeholder="Keunggulan" />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="teknologi" type="text" placeholder="Teknologi" />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-align-justify icon"></i>
                            <input class="form-control" name="pengembangan" type="text" placeholder="Pengembangan" />
                        </div>
                        <div class="input-container">
                            <textarea class="form-control" name="latar_produk" rows="4" placeholder="Latar Produk"></textarea>
                        </div>
                        <div class="input-container">
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
                <h3>Produk</h3>
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
                            <input type="text" class="form-control" name="priority_id" value="0" required>
                           </div>
                    </div>
                    <div class="form-group">
                        <label>User Id :</label>
                        <div class="input-group">
                            <select name="user_id" class="form-control custom-select" required>
                                 <option value="">Pilih</option>
                                @foreach ($user_id as $row)
                                    <option value="{{ $row->user_id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <label>Produk Id :</label>
                           <div class="input-group">
                            <input type="text" class="form-control" name="produk_id" value="0" required>
                           </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="jabatan" class="form-control custom-select" required>
                                <option value="0">Jabatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="divisi" class="form-control custom-select" required>
                                <option value="0">Divisi</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-container">
                        <i class="fas fa-align-justify icon"></i>
                        <input class="form-control" name="tugas" type="text" placeholder="Tugas" />
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
</form>
@endsection
