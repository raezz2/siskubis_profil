@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Edit & Detail Profil Tenant</h1>
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
						<div class="card-title mb-3">Form Edit Profile</div>
						<form action="{{ route('tenant.update-tenant', ''.$tenant->id) }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
						@csrf
							<div class="row">
							<div class="col-md-6">
								<div class="drop-zone" >
									<span class="drop-zone__prompt" ><img src="{{asset('img/tenant/'. $tenant->foto)}}"></span>
									<input type="file" name="file" id="exampleInputFile" for="exampleInputFile" class="drop-zone__input" vlaue="{{ asset('img/tenant'.$tenant->foto)}}">
								</div>
							</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Nama </label>
									<input class="form-control" id="phone" placeholder="Masukan Nama" name="title" value="{{ $tenant->title }}"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="picker1">Priority</label>
									<select class="form-control" name="priority" value="{{$tenant->priority}}">
                                       
											<option style="background-color: #bdbdbd;color: white;" value="{{$select->id}}">{{$select->name}}</option>
										
                                        @foreach($priority as $py)
											<option value="{{$py->id}}">{{$py->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Tanggal Berdidri</label>
									<input class="form-control" id="phone" placeholder="Masukan Tanggal Berdiri" required="required" name="tanggalberdiri" value="{{ $tenant->tanggal_berdiri}}"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Kontak</label>
									<input class="form-control" id="phone" placeholder="Masukan Kontak" required="required" name="kontak" value="{{ $tenant->kontak}}" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Bidang Usaha</label>
									<input class="form-control" id="phone" placeholder="Masukan bidang Usaha" required="required" name="bidang" value="{{ $tenant->bidang_usaha}}"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Deskripsi Singkat</label>
									<input class="form-control" id="phone" placeholder="Masukan Deskripsi Singkat" required="required" name="subtitle" value="{{ $tenant->subtitle}}"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="credit1">Visi</label>
									<textarea class="form-control" id="credit1" style="height: 80px " placeholder="Masukan Visi" required="required" name="visi" value="{{ $tenant->visi}}">{{ $tenant->visi}}</textarea>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="credit1">Misi</label>
									<textarea class="form-control" id="credit1" style="height: 80px " placeholder="Masukan Misi" required="required" name="misi" value="{{ $tenant->misi}}">{{ $tenant->misi}}</textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Deskripsi</label>
									@foreach($check as $check)
									<label for="credit1">{{$check->name}}</label>
									@endforeach
									<textarea class="form-control" id="credit1" placeholder="Masukan Deskripsi" required="required" name="deskripsi" value="{{ $tenant->description}}">{{ $tenant->description}}</textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Slogan</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Slogan" required="required" name="slogan" value="{{ $tenant->slogan}}">{{ $tenant->slogan}}</textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Alamat</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Alamat" required="required" name="alamat" value="{{ $tenant->alamat}}">{{ $tenant->alamat}}</textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Jam Operasional</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Jam Operasional" required="required" name="operasional" value="{{ $tenant->jam_operasional}}">{{ $tenant->jam_operasional}}</textarea>
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