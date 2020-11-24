@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
    integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
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
        width: 11%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #produk:before {
        font-family: "Font Awesome 5 Free";
        content: "\f1b3"
    }

    #progressbar #bisnis:before {
        font-family: "Font Awesome 5 Free";
        content: "\f030"
    }

    #progressbar #canvas:before {
        font-family: "Font Awesome 5 Free";
        content: "\f030"
    }

    #progressbar #image:before {
        font-family: "Font Awesome 5 Free";
        content: "\f00c"
    }

    #progressbar #kintel:before {
        font-family: "Font Awesome 5 Free";
        content: "\f00c"
    }

    #progressbar #riset:before {
        font-family: "Font Awesome 5 Free";
        content: "\f00c"
    }

    #progressbar #sertifikasi:before {
        font-family: "Font Awesome 5 Free";
        content: "\f00c"
    }

    #progressbar #ijin:before {
        font-family: "Font Awesome 5 Free";
        content: "\f00c"
    }

    #progressbar #finish:before {
        font-family: "Font Awesome 5 Free";
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


    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    .input-container {
        display: -ms-flexbox;
        /* IE10 */
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

    .dropdown-toggle {
        height: 40px;
        width: 400px !important;
    }

    h6 {
        font-family: Arial, Helvetica, sans-serif;
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
                    <form id="msform" action="{{ route('tenant.storeProduk') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="produk"><strong>Detail Produk</strong></li>
                            <li id="bisnis"><strong>Bisnis</strong></li>
                            <li id="canvas"><strong>Canvas</strong></li>
                            <li id="image"><strong>Image</strong></li>
                            <li id="kintel"><strong>Kekayaan Intelektual</strong></li>
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
                                        <h2 class="steps">Step 1 - 9</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Nama Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user-tie icon"></i>
                                                        <input class="form-control" type="text" placeholder="Nama lengkap produk anda..."
                                                            name="title" value="{{ old('title') }}">
                                                    </div>
                                                    @error('title')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Harga Pokok :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-money-bill-wave-alt icon"></i>
                                                        <input class="form-control" name="harga_pokok" type="text"
                                                            placeholder="Rp. 100000"
                                                            value="{{ old('harga_pokok') }}" />
                                                    </div>
                                                    @error('harga_pokok')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Harga Jual :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-money-bill-wave-alt icon"></i>
                                                        <input class="form-control" name="harga_jual" type="text"
                                                            row="3" placeholder="Rp. 100000"
                                                            value="{{ old('harga_jual') }}" />
                                                    </div>
                                                    @error('harga_jual')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>No Telphone :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-phone-alt icon"></i>
                                                        <input class="form-control" name="contact" type="text"
                                                            placeholder="0811 1111 1111" value="{{ old('contact') }}" />
                                                    </div>
                                                    <h6>Pilih Tag :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-tasks icon"></i>
                                                        <select class="selectpicker" multiple data-live-search="true"
                                                            name="tag[]">
                                                            <option value="1">Aksesoris</option>
                                                            <option value="2">Gadget</option>
                                                            <option value="3">Fashion</option>
                                                            <option value="4">Foot</option>
                                                            <option value="5">Properti</option>
                                                            <option value="6">Tool</option>
                                                        </select>
                                                    </div><br />
                                                    @error('tag')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-group" hidden>
                                                        <div class="input-group">
                                                            <Input name="kategori" class="form-control custom-select"
                                                                value="0">
                                                            {{-- <option value="1">Kategori Id</option> --}}
                                                            {{-- </select> --}}
                                                        </div>
                                                    </div>
                                                    <h6>Subtitle Produk :</h6>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="subtitle" rows="2"
                                                            placeholder="Subtitle produk anda...">{{ old('subtitle') }}</textarea>
                                                    </div>
                                                    @error('subtitle')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Lokasi :</h6>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="location" rows="3"
                                                            placeholder="Sleman">{{ old('location') }}</textarea>
                                                    </div>
                                                    @error('location')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Alamat :</h6>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="address" rows="4"
                                                            placeholder="Jalan nusa indah no. 69, Depok">{{ old('address') }}</textarea>
                                                    </div>
                                                    @error('address')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-group">
                                                        <label for="foto">Uploda Proposal</label><br>
                                                        <input type="file" name="proposal"
                                                            value="{{ old('proposal') }}">
                                                    </div>
                                                    @error('proposal')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Spesifikasi Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="spesifikasi" type="text"
                                                            placeholder="Spesifikasi dari produk ini adalah sebagai berikut..."
                                                            value="{{ old('spesifikasi') }}" />
                                                    </div>
                                                    @error('spesifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Keterbaharuan Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="keterbaharuan" type="text"
                                                            placeholder="Apa yang baru dari produk ini..."
                                                            value="{{ old('keterbaharuan') }}" />
                                                    </div>
                                                    @error('keterbaharuan')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Manfaat Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="manfaat" type="text"
                                                            placeholder="Manfaat_produk" name="manfaat_produk[]" type="text" placeholder="Manfaat dari produk ini adalah sebagai berikut..." value="{{ old('manfaat') }}" />
                                                    </div>
                                                    @error('manfaat')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Keunggulan Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="keunggulan" type="text"
                                                            placeholder="Keunggulan dari produk ini adalah sebagai berikut..." value="{{ old('keunggulan') }}" />
                                                    </div>
                                                    @error('keunggulan')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Teknologi Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="teknologi" type="text"
                                                            placeholder="Tekonologi pada produk ini..." value="{{ old('teknologi') }}" />
                                                    </div>
                                                    @error('teknologi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pengembangan Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="pengembangan" type="text"
                                                            placeholder="Pengembangan pada produk..."
                                                            value="{{ old('pengembangan') }}" />
                                                    </div>
                                                    @error('pengembangan')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Latar Belakang Produk :</h6>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="latar_produk" rows="7"
                                                            placeholder="Produk ini adalah...">{{ old('latar_produk') }}</textarea>
                                                    </div>
                                                    @error('latar_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tentang Produk :</h6>
                                                    <div class="input-container">
                                                        <textarea class="form-control" name="tentang_produk" rows="7"
                                                            placeholder="Produk ini kami ciptakan agar...">{{ old('tentang_produk') }}</textarea>
                                                    </div>
                                                    @error('tentang_produk')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
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
                                        <h2 class="fs-title">Pandangan Produk :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 9</h2>
                                    </div>
                                </div>
                                <h5>Input Table Bisnis</h5>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Kompetitor :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user-tie icon"></i>
                                                        <input class="form-control" type="text" placeholder="Kompetitor Bisnis"
                                                            name="kompetitor" value="{{ old('kompetitor') }}">
                                                    </div>
                                                    @error('kompetitor')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Target Pasar :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-money-bill-wave-alt icon"></i>
                                                        <input class="form-control" name="target_pasar" type="text"
                                                            placeholder="Rp. 100000"
                                                            value="{{ old('target_pasar') }}" />
                                                    </div>
                                                    @error('target_pasar')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Harga Produksi :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-money-bill-wave-alt icon"></i>
                                                        <input class="form-control" name="produksi_harga" type="text"
                                                            row="3" placeholder="Rp. 100000"
                                                            value="{{ old('produksi_harga') }}" />
                                                    </div>
                                                    @error('produksi_harga')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Dampak Sosial :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="dampak_sosek" type="text"
                                                            placeholder="Bagaimana dampaknya"
                                                            value="{{ old('dampak_sosek') }}" />
                                                    </div>
                                                    @error('dampak_sosek')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pemasaran Produk :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="pemasaran" type="text"
                                                            placeholder="Bagaimana Pemasaranya" value="{{ old('pemasaran') }}" />
                                                    </div>
                                                    @error('pemasaran')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Produk Canva</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 9</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h5>Input Table Canvas :</h5><br>
                                                    <textarea name="editor1"></textarea><br />
                                                    <h5>Input Tanggal Canvas :</h5>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control" type="date" name="tanggal_canvas"
                                                            placeholder="Tanggal" value="{{ old('tanggal_canvas') }}">
                                                    </div>
                                                    @error('tanggal_canvas')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h5>Input Kategori Canvas :</h5>
                                                    <div class="input-container">
                                                        <i class="fas fa-tasks icon"></i>
                                                        <select class="selectpicker" multiple data-live-search="true"
                                                            name="kategori_canvas[]">
                                                            <option value="1">Aksesoris</option>
                                                            <option value="2">Gadget</option>
                                                            <option value="3">Fashion</option>
                                                            <option value="4">Foot</option>
                                                            <option value="5">Properti</option>
                                                            <option value="6">Tool</option>
                                                        </select>
                                                    </div><br />
                                                    @error('kategori_canvas')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Foto Produk</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 9</h2>
                                    </div>
                                </div>
                                <h5>Input Table Image :</h5>
                                <div class="form-group">
                                    <label for="foto">Upload Foto</label><br>
                                    <input type="file" name="foto" value="{{ old('foto') }}">
                                </div>
                                @error('foto')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Kekayaan Intelektual</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 5 - 9</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Jenis KI :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-tasks icon"></i>
                                                        <select class="" name="jenis_ki">
                                                            <option value="1">Hak Cipta</option>
                                                            <option value="2">Paten</option>
                                                            <option value="3">Merek</option>
                                                            <option value="4">Desain Industri</option>
                                                            <option value="5">Desain Tata Letak Sirkuit terpadu</option>
                                                            <option value="6">Indikasi Geografis</option>
                                                            <option value="7">Rahasia Dagang</option>
                                                        </select>
                                                    </div><br />
                                                    @error('jenis_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Status KI :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-circle icon"></i>
                                                        <input class="form-control" name="status_ki" type="text"
                                                            placeholder="Status Kekayaan Intelektual"
                                                            value="{{ old('status_ki') }}" />
                                                    </div>
                                                    @error('status_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Permohonan KI :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="permohonan_ki" type="text"
                                                            placeholder="Permohonan pada KI"
                                                            value="{{ old('permohonan_ki') }}" />
                                                    </div>
                                                    @error('permohonan_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Sertifikat KI :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-certificate icon"></i>
                                                        <input class="form-control" name="sertifikat_ki" type="text"
                                                            placeholder="Sertifikat Kekayaan Intelektual"
                                                            value="{{ old('sertifikat_ki') }}" />
                                                    </div>
                                                    @error('sertifikat_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Berlaku Mulai :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar icon"></i>
                                                        <input class="form-control" name="berlaku_mulai" type="date"
                                                            placeholder="Berlaku Mulai"
                                                            value="{{ old('berlaku_mulai') }}" />
                                                    </div>
                                                    @error('berlaku_mulai')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6> Berlaku Sampai :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-check icon"></i>
                                                        <input class="form-control" name="berlaku_sampai" type="date"
                                                            placeholder="Berlaku Sampai"
                                                            value="{{ old('berlaku_sampai') }}" />
                                                    </div>
                                                    @error('berlaku_sampai')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pemilik KI :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user-tie icon"></i>
                                                        <input class="form-control" name="pemilik_ki" type="text"
                                                            placeholder="Pemilik Kekayaan Intelektual"
                                                            value="{{ old('pemilik_ki') }}" />
                                                    </div>
                                                    @error('pemilik_ki')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Kelengkapan Riset Produk</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 6 - 9</h2>
                                    </div>
                                </div>
                                <h5>Input Table Riset :</h5>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Nama Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="nama_riset" type="text"
                                                            placeholder="Nama Riset...." value="{{ old('nama_riset') }}" />
                                                    </div>
                                                    @error('nama_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pelaksana Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user-tie icon"></i>
                                                        <input class="form-control" name="pelaksana_riset" type="text"
                                                            placeholder="Pelaksana riset produk"
                                                            value="{{ old('pelaksana_riset') }}" />
                                                    </div>
                                                    @error('pelaksana_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tahun Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control" name="tahun_riset" type="text"
                                                            placeholder="2020" value="{{ old('tahun_riset') }}" />
                                                    </div>
                                                    @error('tahun_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pendanaan Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="pendanaan_riset" type="text"
                                                            placeholder="Pendanaan riset produk"
                                                            value="{{ old('pendanaan_riset') }}" />
                                                    </div>
                                                    @error('pendanaan_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Skema Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="skema_riset" type="text"
                                                            placeholder="Skema riset produk" value="{{ old('skema_riset') }}" />
                                                    </div>
                                                    @error('skema_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Nilai Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="nilai_riset" type="text"
                                                            placeholder="Nilai Riset Produk" value="{{ old('nilai_riset') }}" />
                                                    </div>
                                                    @error('nilai_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Aktifitas Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="aktifitas_riset" type="text"
                                                            placeholder="Aktifitas riset produk"
                                                            value="{{ old('aktifitas_riset') }}" />
                                                    </div>
                                                    @error('aktifitas_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tujuan Riset: </h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="tujuan_riset" type="text"
                                                            placeholder="Tujuan riset produk" value="{{ old('tujuan_riset') }}" />
                                                    </div>
                                                    @error('tujuan_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Hasil Riset :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="hasil_riset" type="text"
                                                            placeholder="Hasil Riset Produk" value="{{ old('hasil_riset') }}" />
                                                    </div>
                                                    @error('hasil_riset')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Sertifikasi Produk</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 7 - 9</h2>
                                    </div>
                                </div>
                                <h5>Input Table Sertifakasi</h5>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Jenis Sertifikat :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="jenis_sertif" type="text"
                                                            placeholder="Jenis Sertifikat Produk"
                                                            value="{{ old('jenis_sertif') }}" />
                                                    </div>
                                                    @error('jenis_sertif')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pemberi Sertifikat :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user icon"></i>
                                                        <input class="form-control" name="pemberi_sertif" type="text"
                                                            placeholder="Pemberi Sertifikat..."
                                                            value="{{ old('pemberi_sertif') }}" />
                                                    </div>
                                                    @error('pemberi_sertif')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Status Sertifikat :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-circle icon"></i>
                                                        <input class="form-control" name="status_sertif" type="text"
                                                            placeholder="Status Sertifikat..." value="{{ old('status_sertif') }}" />
                                                    </div>
                                                    @error('status_sertif')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tahun Sertifikat :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control tahun" name="tahun_sertif" type=""
                                                            placeholder="2020" value="{{ old('tahun_sertif') }}" />
                                                    </div>
                                                    @error('tahun_sertif')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tanggal Sertifikat :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control" name="tanggal_sertif" type="date"
                                                            placeholder="Tanggal" value="{{ old('tanggal_sertif') }}" />
                                                    </div>
                                                    @error('tanggal_sertif')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-group">
                                                        <label for="foto">Uploda Dokumen</label><br>
                                                        <input type="file" name="file_sertifikasi"
                                                            value="{{ old('file_sertifikasi') }}">
                                                    </div>
                                                    @error('file_sertifikasi')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Ijin Produk</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 8 - 9</h2>
                                    </div>
                                </div>
                                <h5>Input Table Ijin</h5>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-widget__body">
                                                    <h6>Jenis Ijin :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-align-justify icon"></i>
                                                        <input class="form-control" name="jenis_ijin" type="text"
                                                            placeholder="Jenis Ijin.." value="{{ old('jenis_ijin') }}" />
                                                    </div>
                                                    @error('jenis_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Pemberi Ijin :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-user icon"></i>
                                                        <input class="form-control" name="pemberi_ijin" type="text"
                                                            placeholder="Pemberi Ijin"
                                                            value="{{ old('pemberi_ijin') }}" />
                                                    </div>
                                                    @error('pemberi_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Status Ijin :</h6>
                                                    <div class="input-container">
                                                        <i class="fas fa-circle icon"></i>
                                                        <input class="form-control" name="status_ijin" type="text"
                                                            placeholder="Status" value="{{ old('status_ijin') }}" />
                                                    </div>
                                                    @error('status_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tahun Ijin :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control" name="tahun_ijin" type="text"
                                                            placeholder="2020" value="{{ old('tahun_ijin') }}" />
                                                    </div>
                                                    @error('tahun_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <h6>Tanggal Ijin :</h6>
                                                    <div class="input-container">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        <input class="form-control" name="tanggal_ijin" type="date"
                                                            placeholder="Tanggal" value="{{ old('tanggal_ijin') }}" />
                                                    </div>
                                                    @error('tanggal_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-group">
                                                        <label for="foto">Uploda Dokumen</label><br>
                                                        <input type="file" name="file_ijin"
                                                            value="{{ old('file_ijin') }}">
                                                    </div>
                                                    @error('file_ijin')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 9 - 9</h2>
                                    </div>
                                </div> <br><br>
                                <h2 class="purple-text text-center"><strong>Pastikan data produk telah terisi dengan
                                        benar !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="{{asset('assets/images/submit.png')}}"
                                            class="fit-image"> </div>
                                </div><br>
                            </div>
                            <button value="submit" class="btn btn-primary">Submit</button>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
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
