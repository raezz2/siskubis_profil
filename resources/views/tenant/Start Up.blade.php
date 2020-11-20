@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Data Tenant</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
@endsection
@section('content')
<div class="card user-profile o-hidden mb-4">
	<div class="header-cover" style="background-image: url('{{ asset("theme/images/photo-wide-4.jpg")}}')"></div>
	<div class="user-info"><img class="profile-picture avatar-lg mb-2" src="{{ asset('img/tenant/'.$tenant->foto)}}" alt="" />
		<p class="m-0 text-24">{{$tenant->title}}</p>
		<p class="text-muted m-0">{{$tenant->subtitle}}</p>
	</div>
	<div class="card-body">
		<ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
			<li class="nav-item"><a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a></li>
			<li class="nav-item"><a class="nav-link" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">Timeline</a></li>
			<li class="nav-item"><a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a></li>
			<li class="nav-item"><a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a></li>
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
				<p>
					{{$tenant->description}}
				</p>
				<hr />
				<div class="row">
					<div class="col-md-4 col-6">
						<div class="mb-4">
							<p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p><span>{{$tenant->tanggal_berdiri}}</span>
						</div>
						<div class="mb-4">
							<p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Alamat</p><span>{{$tenant->alamat}}</span>
						</div>
						<div class="mb-4">
						<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Visi</p><span>{{$tenant->visi}}</span>
						</div>
					</div>
					<div class="col-md-4 col-6">
						<div class="mb-4">
							<p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Contact</p><span>{{$tenant->kontak}}</span>
						</div>
						<div class="mb-4">
						<p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p><span>{{$tenant->website}}</span>
						</div>
						<div class="mb-4">
						<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Misi</p><span>{{$tenant->misi}}</span>
						</div>
					</div>
					<div class="col-md-4 col-6">
						<div class="mb-4">
							<p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Bidang Usaha</p><span>{{$tenant->bidang_usaha}}</span>
						</div>
						<div class="mb-4">
							<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Slogan</p><span>{{$tenant->slogan}}</span>
						</div>
						<div class="mb-4">
						<p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Jam Operasional</p><span>{{$tenant->jam_operasional}}</span>
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
				@foreach($tenantuser as $user)
					<div class="col-md-3">
						<div class="card card-profile-1 mb-4">
							<div class="card-body text-center">
								<div class="avatar box-shadow-2 mb-3"><img src="{{ asset('theme/images/faces/'.$user->foto)}}" alt="" /></div>
								<h5 class="m-0">{{$user->nama}}</h5>
								<p>{{$user->deskripsi}}</p>
								@role('mentor')
								<a href="{{ route('mentor.profile-detail',''.$user->user_id)}}"><button class="btn btn-primary btn-rounded">Contact {{$user->nama}}</button></a>
								@endrole
								@role('inkubator')
								<a href="{{ route('profile-detail',''.$user->user_id)}}"><button class="btn btn-primary btn-rounded">Contact {{$user->nama}}</button></a>
								@endrole
								<div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
			<div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
				<div class="row">
				@foreach($gallery as $gallery)
					<div class="col-md-4">
						<div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('theme/images/products/'. $gallery->foto)}}" alt="" />
							<div class="card-img-overlay">
								<div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>{{$gallery->created_at}}</span></div>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
	</div>
</div><!-- end of main-content -->
@endsection