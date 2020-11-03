@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Edit Profile User</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
@endsection
<!-- begin::modal edit profile-->
@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card-body">
              <div id="exaple2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12 col-md-6"></div>
                  <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                <div class="col-sm-12">
						<div class="card-title mb-3">Form Edit Profile User</div>
						<form action="{{route ('tenant.update-profile-user',''.$data->id) }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
						@csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="drop-zone" >
                                        <span class="drop-zone__prompt" ><img src="{{ url('theme/images/faces/'. $data->foto)}}"></span>
                                        <input type="file" name="file" id="exampleInputFile" for="exampleInputFile" class="drop-zone__input" value="{{$data->foto}}">
                                    </div>
                                </div>
							</div>
							<div class="row">
                                <div class="col-md-6 form-group mt-3" >
                                    <label for="firstName1">Nama</label>
                                    <input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nama" required="required" name="nama" value="{{ $data->nama }}"/>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Masukan nama anda.
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-3">
                                    <label for="firstName1">Kontak</label>
                                    <input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nomor" required="required" name="kontak" value="{{ $data->kontak }}" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Masukan kontak anda.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mt-2">
                                    <label for="picker1">Jenis Kelamin</label>
                                    <select class="form-control" name="jenkel" value="{{ $data->jenkel }}" >
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label for="firstName1">Nik</label>
                                    <input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nik" required="required" name="nik" value="{{ $data->nik }}" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Masukan Nik anda.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mt-2">
                                    <label for="firstName1">Alamat</label>
                                    <input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Alamat" required="required" name="alamat" value="{{ $data->alamat }}"/>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Masukan alamat anda.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12 form-group mt-2">
                                    <label for="credit1">Deskripsi</label>
                                    <label for="credit1"></label>
                                    <textarea class="form-control" id="credit1" placeholder="Masukan Deskripsi" name="deskripsi" required="required" value="{{ $data->deskripsi }}">{{ $data->deskripsi }}</textarea>
                                </div>
                            
                            </div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="{{ route('tenant.home') }}"><button type="button" class="btn btn-danger">Back</button></a>
								</div>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- end::modal edit profile-->
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('theme/css/plugins/datatables.min.css')}}" />
@endsection
@section('js')
	<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/contact-list-table.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/datatables.script.min.js')}}"></script>
	<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/tooltip.script.min.js')}}"></script>
    <script>
        $('#ul-contact-list').DataTable({
			responsive:true
		});
    </script>
@endsection