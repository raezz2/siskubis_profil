@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Data Tenant</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
@endsection
@section('content')

@if( $check == '[]')
	@if(count($check) == 0)
	<div class="container text-center" >
	<h4 style="color: red; margin:auto">Anda harus melengkapi profil tenant untuk menampilkan data tenant.</h4>

	<button style="width:30%; margin:auto" class="btn btn-outline-secondary btn-block mt-5 mb-4" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">ADD PROFIL</button>
	</div>
	@endif
	@else
		<div class="card user-profile o-hidden mb-4">
			<div class="header-cover" style="background-image: url('{{ asset("theme/images/photo-wide-4.jpg")}}')"></div>
			<div class="user-info"><img class="profile-picture avatar-lg mb-2" src="{{ asset('img/tenant/'. $data->foto)}}" alt="" />
				<p class="m-0 text-24">{{$data->title}}</p>
				<p class="text-muted m-0"></p>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
					<li class="nav-item"><a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a></li>
					<li class="nav-item"><a class="nav-link" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">Timeline</a></li>
					<li class="nav-item"><a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a></li>
					<li class="nav-item"><a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a></li>
					<li class="nav-item"><a class="nav-link delete" id="profil" tenant-id="{{$data->id}}" data-toggle="tab" href="" role="tab" aria-controls="profil" aria-selected="false"><i id="profil" tenant-id="{{$data->id}}" class="delete" ></i>Edit Profil</a></li>
          			<li class="nav-item"><a class="nav-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab" aria-controls="keuangan" aria-selected="false">Keuangan</a></li>
				</ul>
				<div class="tab-content" id="profileTabContent">
					<div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="about-tab">
					<ul class="timeline clearfix">
							<li class="timeline-line"></li>
							<li class="timeline-item">
								<div class="timeline-badge"><i class="badge-icon bg-primary text-white i-Cloud-Picture"></i></div>
								<div class="timeline-card card">
									<div class="card-body">
										<div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> added a new photo
											<p class="text-muted">3 hours ago</p>
										</div><img class="rounded mb-2" src="{{ asset('theme/images/photo-wide-1.jpg')}}" alt="" />
										<div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
											<div class="input-group-append">
												<button class="btn btn-primary" id="button-comment1" type="button">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="timeline-item">
								<div class="timeline-badge"><img class="badge-img" src="{{ asset('theme/images/faces/1.jpg')}}" alt="" /></div>
								<div class="timeline-card card">
									<div class="card-body">
										<div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> updated his sattus
											<p class="text-muted">16 hours ago</p>
										</div>
										<p>
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi dicta beatae illo illum iusto iste mollitia explicabo quam officia. Quas ullam, quisquam architecto aspernatur enim iure debitis dignissimos suscipit
											ipsa.
										</p>
										<div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
											<div class="input-group-append">
												<button class="btn btn-primary" id="button-comment2" type="button">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<ul class="timeline clearfix">
							<li class="timeline-line"></li>
							<li class="timeline-group text-center">
								<button class="btn btn-icon-text btn-primary"><i class="i-Calendar-4"></i> 2018</button>
							</li>
						</ul>
						<ul class="timeline clearfix">
							<li class="timeline-line"></li>
							<li class="timeline-item">
								<div class="timeline-badge"><i class="badge-icon bg-danger text-white i-Love-User"></i></div>
								<div class="timeline-card card">
									<div class="card-body">
										<div class="mb-1"><strong class="mr-1">New followers</strong>
											<p class="text-muted">2 days ago</p>
										</div>
										<p><a href="#">Henry krick</a> and 16 others followed you</p>
										<div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
											<div class="input-group-append">
												<button class="btn btn-primary" id="button-comment3" type="button">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="timeline-item">
								<div class="timeline-badge"><i class="badge-icon bg-primary text-white i-Cloud-Picture"></i></div>
								<div class="timeline-card card">
									<div class="card-body">
										<div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> added a new photo
											<p class="text-muted">2 days ago</p>
										</div><img class="rounded mb-2" src="{{ asset('theme/images/photo-wide-2.jpg')}}" alt="" />
										<div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
											<div class="input-group-append">
												<button class="btn btn-primary" id="button-comment4" type="button">Submit</button>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<ul class="timeline clearfix">
							<li class="timeline-line"></li>
							<li class="timeline-group text-center">
								<button class="btn btn-icon-text btn-warning"><i class="i-Calendar-4"></i> Joined
									in 2013
								</button>
							</li>
						</ul>
					</div>
					<div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="timeline-tab">
						<h4>Tenant Information</h4>
						<p>{{$data->subtitle}}</p>
						<p>{{$data->description}}</p>
						<hr />
						<div class="row">
							<div class="col-md-4 col-6">
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Tanggal Berdiri</p><span>{{$data->tanggal_berdiri}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Alamat</p><span>{{$data->alamat}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i>Visi</p><span>{{$data->visi}}</span>
								</div>
							</div>
							<div class="col-md-4 col-6">
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Contact</p><span>{{$data->kontak}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p><span>{{$data->website}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i>Misi</p><span>{{$data->misi}}</span>
								</div>
							</div>
							<div class="col-md-4 col-6">
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Bidang Usaha</p><span>{{$data->bidang_usaha}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i>Slogan</p><span>{{$data->slogan}}</span>
								</div>
								<div class="mb-4">
									<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i>Jam Operasional</p><span>{{$data->jam_operasional}}</span>
								</div>
							</div>
						</div>
						<hr />
						<h4>Other Info</h4>
						<p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum dolore labore reiciendis ab quo ducimus reprehenderit natus debitis, provident ad iure sed aut animi dolor incidunt voluptatem. Blanditiis, nobis aut.</p>
						<div class="row">
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Plane text-32 text-primary"></i>
								<p class="text-16 mt-1">Travelling</p>
							</div>
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Camera text-32 text-primary"></i>
								<p class="text-16 mt-1">Photography</p>
							</div>
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Car-3 text-32 text-primary"></i>
								<p class="text-16 mt-1">Driving</p>
							</div>
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Gamepad-2 text-32 text-primary"></i>
								<p class="text-16 mt-1">Gaming</p>
							</div>
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Music-Note-2 text-32 text-primary"></i>
								<p class="text-16 mt-1">Music</p>
							</div>
							<div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Shopping-Bag text-32 text-primary"></i>
								<p class="text-16 mt-1">Shopping</p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
						<div class="row">
							@if(count($check) > 0)
								@foreach( $profil as $pf)
								<div class="col-md-3">
									<div class="card card-profile-1 mb-4">
										<div class="card-body text-center">
											<div class="avatar box-shadow-2 mb-3"><img src="{{ asset('theme/images/faces/'.$pf->foto)}}" alt="" /></div>
											<h5 class="m-0">{{$pf->nama}}</h5>
											<p>{{$pf->deskripsi}}</p>
											<a href="{{ route('tenant.profile-detail',''.$pf->user_id)}}"><button class="btn btn-primary btn-rounded">Contact {{$pf->nama}}</button></a>
											<div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
										</div>
									</div>
								</div>
								@endforeach
							@endif
						</div>
					</div>
					<div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
						<div class="row">
							@foreach( $gallery as $gl)
							<div class="col-md-4">
								<div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('theme/images/products/'.$gl->foto)}}" alt="" />
									<div class="card-img-overlay">
										<div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>0</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>{{$gl->created_at}}</span></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						{{ $gallery->links() }}
					</div>
                    <div class="tab-pane fade" id="keuangan" role="tabpanel" aria-labelledby="keuangan-tab">
					    @include('keuangan.keuangan')
			        </div>
				</div>
			</div>
		</div><!-- end of main-content -->
	@endif

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
							<div class="col-md-4">
								<div class="drop-zone">
									<span class="drop-zone__prompt">Drop file here or click to upload</span>
									<input type="file" name="file" id="exampleInputFile" for="exampleInputFile" class="drop-zone__input">
								</div>
							</div>
							<div class="col-md-6">
								<p style="color:red">Silahkan lengkapi profile tenant anda terlebih dahulu! untuk bisa menambahkan anggota dan tampilan detail tenant.</p>
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
									<label for="phone">Website</label>
									<input class="form-control" id="phone" placeholder="Masukan Website" required="required" name="website" />
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
</div><!-- end of main-content -->

<!-- end::modal add profil-->
@endif



@endsection

@section('css')
	<!-- Asset Alert iziToast -->
	<link rel="stylesheet" href="{{asset('izitoast/dist/css/iziToast.min.css')}}">
@endsection

@section('js')
<!-- Asset Alert iziToast -->
<script src="{{asset('izitoast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$('#profil').click(function(){

	var data_id = $(this).attr('tenant-id');

	window.location.href = "/tenant/editprofil/"+ data_id ;
		
});
</script>
@endsection

