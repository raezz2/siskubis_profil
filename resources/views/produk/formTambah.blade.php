@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style type="text/css">
* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

p {
    color: grey
}

#heading {
    text-transform: uppercase;
    color: #673AB7;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #673AB7;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #311B92
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}

.card {
    z-index: 0;
    border: none;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #673AB7;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #673AB7
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 10%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #produk:before {
    font-family: FontAwesome;
    content: "\f13e"
}

#progressbar #bisnis:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #canvas:before {
    font-family: FontAwesome;
    content: "\f030"
}

#progressbar #image:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #kintel:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #team:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #riset:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #sertifikasi:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #ijin:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar #finish:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 0px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #673AB7
}

.progress {
    height: 20px
}

.progress-bar {
    background-color: #673AB7
}

.fit-image {
    width: 100%;
    object-fit: cover
}


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
      background: #673AB7;
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
      border: 2px solid #673AB7;
    }

    .btn:hover {
      opacity: 1;
    }

    .dropdown-toggle{
            height: 40px;
            width: 400px !important;
        }
</style>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <div class="container">
                <h2 id="heading">Form Tambah Produk</h2>
                <p>mohon isi data produk dengan sebenar-benarnya</p>
                <form id="msform" action="{{ route('tenant.storeProduk') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="produk"><strong>Detail Produk</strong></li>
                        <li id="bisnis"><strong>Bisnis</strong></li>
                        <li id="canvas"><strong>Canvas</strong></li>
                        <li id="image"><strong>Image</strong></li>
                        <li id="kintel"><strong>Kekayaan Intelektual</strong></li>
                        <li id="team"><strong>Team</strong></li>
                        <li id="riset"><strong>Riset</strong></li>
                        <li id="sertifikasi"><strong>Sertifikasi</strong></li>
                        <li id="ijin"><strong>Ijin</strong></li>
                        <li id="finish"><strong>Finish</strong></li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Detail Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 10</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
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
                                                <label><strong>Select Tag :</strong></label><br/>
                                                <div class="input-container">
                                                    <i class="fas fa-tasks icon"></i>
                                                    <select class="selectpicker" multiple data-live-search="true" name="tag[]">
                                                      <option value="1">Aksesoris</option>
                                                      <option value="2">Gadget</option>
                                                      <option value="3">Fashion</option>
                                                      <option value="4">Foot</option>
                                                      <option value="5">Properti</option>
                                                      <option value="6">Tool</option>
                                                    </select>
                                                </div><br/>
                                                <div class="form-group" hidden>
                                                    <div class="input-group">
                                                        <select name="kategori" class="form-control custom-select" required>
                                                            <option value="1">Kategori Id</option>
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
                                                    <textarea class="form-control" name="address" rows="4" placeholder="Address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Uploda Proposal</label><br>
                                                    <input type="file" name="proposal" value="{{ old('proposal') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
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
                                                        <textarea class="form-control" name="latar_produk" rows="7" placeholder="Latar Produk"></textarea>
                                                    </div>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="tentang_produk" rows="7" placeholder="Tentang Produk"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Pandangan Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Bisnis</h5>
                            <div class="row">
                                <div class="col-xl-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <div class="input-container">
                                                    <i class="fas fa-user-tie icon"></i>
                                                    <input class="form-control" type="text" placeholder="Kompetitor" name="kompetitor">
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-money-bill-wave-alt icon"></i>
                                                    <input class="form-control" name="target_pasar" type="text" placeholder="Target Pasar" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-money-bill-wave-alt icon"></i>
                                                    <input class="form-control" name="produksi_harga" type="text" row="3" placeholder="Harga Produksi" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="dampak_sosek" type="text" placeholder="Dampak Sosek" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="pemasaran" type="text" placeholder="Pemasaran" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Produk Canva</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Canvas :</h5>
                            <div class="row">
                                <div class="col-xl-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <textarea name="editor1"></textarea><br/>
                                                <h5>Input Tanggal Canvas :</h5>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control" type="date" name="tanggal_canvas" placeholder="Tanggal">
                                                </div>
                                                <h5>Input Kategori Canvas :</h5>
                                                <div class="input-container">
                                                    <i class="fas fa-tasks icon"></i>
                                                    <select class="selectpicker" multiple data-live-search="true" name="kategori_canvas[]">
                                                      <option value="1">Aksesoris</option>
                                                      <option value="2">Gadget</option>
                                                      <option value="3">Fashion</option>
                                                      <option value="4">Foot</option>
                                                      <option value="5">Properti</option>
                                                      <option value="6">Tool</option>
                                                    </select>
                                                </div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Foto Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Image</h5>
                            <div class="form-group">
                                <label for="foto">Upload Foto</label><br>
                                <input type="file" name="foto" value="{{ old('foto') }}" required>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Kekayaan Intelektual</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 5 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Tabel KI</h5>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="jenis_ki" type="text" placeholder="Jenis Kekayaan Intelektual" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-circle icon"></i>
                                                    <input class="form-control" name="status_ki" type="text" placeholder="Status Kekayaan Intelektual" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="permohonan_ki" type="text" placeholder="Permohonan" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-certificate icon"></i>
                                                    <input class="form-control" name="sertifikat_ki" type="text" placeholder="Sertifikat" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <div class="input-container">
                                                        <i class="far fa-calendar icon"></i>
                                                        <input class="form-control" name="berlaku_mulai" type="date" placeholder="Berlaku Mulai" />
                                                    </div>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-check icon"></i>
                                                        <input class="form-control" name="berlaku_sampai" type="date" placeholder="Berlaku Sampai" />
                                                    </div>
                                                    <div class="input-container">
                                                        <i class="fas fa-user-tie icon"></i>
                                                        <input class="form-control" name="pemilik_ki" type="text" placeholder="Pemilik Kekayaan Intelektual" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Produk Team</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 6 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Team</h5>
                            <div class="col-xl-12 col-lg-4">
                                <div class="card mb-4">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Kelengkapan Riset Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 7 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Riset</h5>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="nama_riset" type="text" placeholder="Nama Riset" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-user-tie icon"></i>
                                                    <input class="form-control" name="pelaksana_riset" type="text" placeholder="Pelaksana" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control" name="tahun_riset" type="text" placeholder="Tahun" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="pendanaan_riset" type="text" placeholder="Pendanaan" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="skema_riset" type="text" placeholder="Skema" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="nilai_riset" type="text" placeholder="Nilai" />
                                                    </div>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="aktifitas_riset" type="text" placeholder="Aktifitas" />
                                                    </div>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="tujuan_riset" type="text" placeholder="Tujuan" />
                                                    </div>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="hasil_riset" type="text" placeholder="Hasil" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Sertifikasi Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 8 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Sertifakasi</h5>
                            <div class="row">
                                <div class="col-xl-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="jenis_sertif" type="text" placeholder="Jenis Sertifikat" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-user icon"></i>
                                                    <input class="form-control" name="pemberi_sertif" type="text" placeholder="Pemberi Sertifikat" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-circle icon"></i>
                                                    <input class="form-control" name="status_sertif" type="text" placeholder="Status" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control tahun" name="tahun_sertif" type="" placeholder="Tahun" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control" name="tanggal_sertif" type="date" placeholder="Tanggal" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Uploda Dokumen</label><br>
                                                    <input type="file" name="file_sertifikasi" value="{{ old('file_sertifikasi') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Ijin Produk</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 9 - 10</h2>
                                </div>
                            </div>
                            <h5>Input Table Ijin</h5>
                            <div class="row">
                                <div class="col-xl-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-widget__body">
                                                <div class="input-container">
                                                    <i class="fas fa-align-justify icon"></i>
                                                    <input class="form-control" name="jenis_ijin" type="text" placeholder="Jenis Ijin" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-user icon"></i>
                                                    <input class="form-control" name="pemberi_ijin" type="text" placeholder="Pemberi Ijin" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="fas fa-circle icon"></i>
                                                    <input class="form-control" name="status_ijin" type="text" placeholder="Status" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control" name="tahun_ijin" type="text" placeholder="Tahun" />
                                                </div>
                                                <div class="input-container">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <input class="form-control" name="tanggal_ijin" type="text" placeholder="Tanggal" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Uploda Dokumen</label><br>
                                                    <input type="file" name="file_ijin" value="{{ old('file_ijin') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="card mb-4">
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 10 - 10</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>Pastikan data produk telah terisi dengan benar !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="{{asset('assets/images/submit.png')}}" class="fit-image"> </div>
                            </div><br>
                        </div>
                        <button value="submit" class="btn btn-primary">Submit</button>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
        $('.tahun').datepicker({dateFormat: 'yy'});

    });
</script>
<script type="text/javascript">
//tooltip
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

//multi step form
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});

CKEDITOR.replace( 'editor1' );
</script>
@endsection
