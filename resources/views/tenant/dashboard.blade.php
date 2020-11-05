@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">User Management</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
@endsection
@section('content')
   <div class="row">
   <div class="col-md-3">
	<div class="card">
		<div class="card-body">
			<div class="ul-contact-list">
				<div class="contact-close-mobile-icon float-right mb-2"><i class="i-Close-Window text-15 font-weight-600"></i></div>
				<!-- modal-->
				@if( count($check) == 0)

				<button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">ADD USER</button>
				@else
					@if( count($checkprofil) == 0)
					<button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal" data-target=".modal-77">ADD USER</button>
					@else
					<button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal" data-target=".modal-2">ADD USER</button>
					@endif
				@endif
				<!-- end:modal-->
				<input class="form-control form-control-rounded col-md-12" id="exampleFormControlInput1" type="text" placeholder="Search User..." />
				<br>
				<div class="list-group" id="list-tab" role="tablist"><a class="list-group-item list-group-item-action border-0 active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="nav-icon i-Business-Mens"></i>All User</a>
				<a class="list-group-item list-group-item-action border-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="nav-icon i-Conference"></i> Non Members</a>
				<label class="text-muted font-weight-600 py-8" for="">MEMBERS INKUBATOR</label>
					<select class="form-control form-control-rounded"><option>All Inkubator</option><option></option></select>
					</br>
					<a class="list-group-item list-group-item-action border-0" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i> Inkubator</a>
					<a class="list-group-item list-group-item-action border-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="nav-icon i-Arrow-Next"></i> Mentor</a>
					<a class="list-group-item list-group-item-action border-0" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"><i class="nav-icon i-Arrow-Next"></i> Tenant</a>
				</div>
			</div>
		</div>
	</div>
   </div>
	<div class="col-md-9">
	<div class="card">
		<div class="card-body">
			<table class="display table" id="ul-contact-list" style="width:100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Nik</th>
							<th>Phone</th>
							<th>Jenis Kelamin</th>
							<th>Joining Date</th>
							<th>Alamat</th>
							<th>Decription</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					@if(count($check) == 0)
					<tr>
									
								</tr>
					@else
					@foreach($profil as $profil)
						<tr>
							<td><a href="{{ route('tenant.profile-detail',''.$profil->user_id)}}">
									<div class="ul-widget-app__profile-pic"><img class="profile-picture avatar-sm mb-2 rounded-circle img-fluid" src="{{ url('theme/images/faces/'. $profil->foto)}}" alt="" /><br>{{$profil->nama}}</div>
								</a></td>
							<td>{{$profil->nik}}</td>
							<td>{{$profil->kontak}}</td>
							<td>{{$profil->jenkel}}</td>
							<td>{{$profil->created_at}}</td>
							<td>{{$profil->alamat}}</td>
							<td>{{$profil->deskripsi}}</td>
							<td>
							<a class="ul-link-action text-success" href="{{route('tenant.edit-profile-user','' .$profil->user_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="i-Edit"></i></a>
							@if( $profil->user_id == Auth::user()->id)
							@else
							<a class="ul-link-action text-danger mr-1" href="{{route ('tenant.delete-user','' .$profil->user_id)}}" data-toggle="tooltip" data-placement="top" title="Want To Delete !!!"><i class="i-Eraser-2"></i></a>
							@endif
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			
		</div>
	</div>
	</div>
</div><!-- end of main-content -->

@if( count($check) == 0)
<!-- begin::modal add profil-->
<div class="ul-card-list__modal">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div class="card-body">
						<div class="card-title mb-3">Add Profile Tenant</div>
						<form action="{{route('tenant.update-profil')}}" method="POST" enctype="multipart/form-data">
						@csrf
							<div class="row">
							<div class="col-md-6">
								<div class="drop-zone">
									<span class="drop-zone__prompt">Drop file here or click to upload</span>
									<input type="file" name="file" id="exampleInputFile" for="exampleInputFile" class="drop-zone__input">
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Nama </label>
									<input class="form-control" id="phone" placeholder="Masukan Nama" name="title"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="picker1">Priority</label>
									<select class="form-control" name="priority">
									@foreach($priority as $py)
										<option value="{{$py->id}}">{{$py->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Tanggal Berdidri</label>
									<input class="form-control" id="phone" placeholder="Masukan Tanggal Berdiri" required="required" name="tanggalberdiri"/>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label for="phone">Kontak</label>
									<input class="form-control" id="phone" placeholder="Masukan Kontak" required="required" name="kontak" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group mb-3">
									<label for="phone">Bidang Usaha</label>
									<input class="form-control" id="phone" placeholder="Masukan Bidang Usaha" required="required" name="bidang" />
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="phone">Deskripsi Singkat</label>
									<input class="form-control" id="phone" placeholder="Masukan Deskripsi Singkat" required="required" name="subtitle"/>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Deskripsi</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Deskripsi" required="required" name="deskripsi" ></textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Visi</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Visi" required="required" name="visi"></textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Misi</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Misi" required="required" name="misi" ></textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Slogan</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Slogan" required="required" name="slogan" ></textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Alamat</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Alamat" required="required" name="alamat" ></textarea>
								</div>
								<div class="col-md-12 form-group mb-3">
									<label for="credit1">Jam Operasional</label>
									<textarea class="form-control" id="credit1" placeholder="Masukan Jam Opeprasional" required="required" name="operasional"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Submit</button>
									<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
								</div>
							</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- end::modal add profil-->
@endif


<div class="modal fade bd-example-modal-lg modal-2"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Add User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
			<form action="{{route('tenant.add-user')}}" method="POST" class="needs-validation" novalidate="novalidate"  enctype="multipart/form-data" >
			@csrf
			<div class="row">
				<div class="col-md-12 form-group mb-3">
					<label for="firstName1">Username</label>
					<input class="form-control" id="validationCustom01" type="text" placeholder="Username" required="required" name="name" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan username anda.
						</div>
				</div>
				<div class="col-md-12 form-group mb-3">
					<label for="lastName1">E-mail</label>
					<input class="form-control" id="validationCustom01" type="email" placeholder="Masukan E-mail" required="required" name="email" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan e-mail anda.
						</div>
				</div>
				<div class="col-md-12 form-group mb-3">
					<label for="password">Password</label>
					<input class="form-control" id="validationCustom01" type="password" placeholder="Masukan Password" required="required" name="password" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan password anda.
						</div>
				</div>
				<div class="modal-header col-lg-12 col-md-12 col-12">
					<h5 class="modal-title" id="exampleModalCenterTitle">Profil User</h5>
					<button class="close" type="button" data-dismiss="modal"></button>
				</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group mt-3" >
						<label for="firstName1">Nama</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nama" required="required" name="nama" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan nama anda.
						</div>
					</div>
					<div class="col-md-6 form-group mt-3">
						<label for="firstName1">Kontak</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nomor" required="required" name="kontak" />
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
						<label for="firstName1">Alamat</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Alamat" required="required" name="alamat"/>
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan alamat anda.
						</div>
					</div>
					<div class="col-md-6 form-group mt-2">
						<label for="firstName1">Nik</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nik" required="required" name="nik" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan Nik anda.
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group mt-2">
						<label for="picker1">Jenis Kelamin</label>
						<select class="form-control" name="jenkel" >
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
						</select>
					</div>
						<div class="col-md-6 form-group mt-2">
						<label for="credit1">Foto</label>
							<div class="custom-file">
								<input class="custom-file-input" id="inputGroupFile02" type="file" name="file" required="required" />
								<label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
							</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-12 form-group mt-2">
						<label for="credit1">Deskripsi</label>
						<label for="credit1"></label>
						<textarea class="form-control" id="credit1" placeholder="Masukan Deskripsi" name="deskripsi" required="required"></textarea>
					</div>
				
				</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				<button class="btn btn-primary ml-2" type="submit">Save changes</button>
			</div>
		</div>
		</form>
	</div>
</div>


<!-- modal melengkapi profil user tenant -->
<div class="modal fade bd-example-modal-lg modal-77"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Add Profil {{Auth::user()->name}}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
			<form action="{{route('tenant.add-profil')}}" method="POST" class="needs-validation" novalidate="novalidate"  enctype="multipart/form-data" >
			@csrf
				<div class="row">
					<div class="container">
						<p style="color: red;">Anda belum melengkapi profil anda sebagai user. Silahkan lengkapi profil anda, kemudian anda bisa menambahkan anggota.</p>
					</div>
					<div class="col-md-6 form-group mt-3" >
						<label for="firstName1">Nama</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nama" required="required" name="nama" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan nama anda.
						</div>
					</div>
					<div class="col-md-6 form-group mt-3">
						<label for="firstName1">Kontak</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nomor" required="required" name="kontak" />
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
						<label for="firstName1">Alamat</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Alamat" required="required" name="alamat"/>
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan alamat anda.
						</div>
					</div>
					<div class="col-md-6 form-group mt-2">
						<label for="firstName1">Nik</label>
						<input class="form-control" id="validationCustom01" type="text" placeholder="Masukan Nik" required="required" name="nik" />
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-feedback">
							Masukan Nik anda.
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group mt-2">
						<label for="picker1">Jenis Kelamin</label>
						<select class="form-control" name="jenkel" >
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
						</select>
					</div>
						<div class="col-md-6 form-group mt-2">
						<label for="credit1">Foto</label>
							<div class="custom-file">
								<input class="custom-file-input" id="inputGroupFile02" type="file" name="file" required="required" />
								<label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
							</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-12 form-group mt-2">
						<label for="credit1">Deskripsi</label>
						<label for="credit1"></label>
						<textarea class="form-control" id="credit1" placeholder="Masukan Deskripsi" name="deskripsi" required="required"></textarea>
					</div>
				
				</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				<button class="btn btn-primary ml-2" type="submit">Save changes</button>
			</div>
		</div>
		</form>
	</div>
</div>

@endsection
@section('css')
	<link rel="stylesheet" href="{{asset('theme/css/plugins/datatables.min.css')}}" />
	<!-- Asset Alert iziToast -->
	<link rel="stylesheet" href="{{asset('izitoast/dist/css/iziToast.min.css')}}">
@endsection
@section('js')
	<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/contact-list-table.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/datatables.script.min.js')}}"></script>
	<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('theme/js/scripts/tooltip.script.min.js')}}"></script>
	<script src="{{asset('theme/js/scripts/form.validation.script.min.js')}}"></script>
	<!-- Asset Alert iziToast -->
	<script src="{{asset('izitoast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $('#ul-contact-list').DataTable({
			responsive:true
		});
	</script>
	
	<script type="text/javascript">
		$('.delete').click(function(){

			var surat_id = $(this).attr('surat-id');

			iziToast.question({
			timeout: 20000,
			close: false,
			overlay: true,
			displayMode: 'once',
			id: 'question',
			zindex: 999,
			title: 'Hey',
			message: 'Anda yakin ingin hapus surat ini?',
			// position: 'bottomRight',bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
			position: 'topCenter',
			buttons: [
				['<button><b>YES</b></button>', function (instance, toast) {
		
					instance.hide({ transitionOut: 'fadeOut' }, toast, 'button', window.location = "/inkubator/surat/"+ surat_id +"/delete ");
		
				}, true],
				['<button>NO</button>', function (instance, toast) {
		
					instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
		
				}],
			]
			});
		});
		
    </script>
	<script>
		@if(Session::has('success'))

			iziToast.success({
				title: 'OK',
				message: '{{ session('success') }}',
				position: 'topRight',
				transitionIn: 'fadeInUp',
			});
		@endif	
	</script>
	<script>
		@if(Session::has('error'))

		iziToast.error({
			title: 'Error',
			position: 'topRight',
			message: '{{ session('error') }}',
		});
		@endif	
	</script>
@endsection