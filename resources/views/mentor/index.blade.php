@extends('layouts.app')
@section('css')
	<style>
.item-divider {
    height: 0;
    margin: 0.5rem 0.5rem;
    overflow: hidden;
    border-left: 1px solid #979b9e;
	border-right: 1px
}
	</style>
@endsection
@section('content')
<section class="ul-contact-page">
<div class="row">
	<div class="col-lg-12 col-md-12 mb-4">
		<div class="card">
			<div class="card-body ">
				<strong>Pendamping</strong>
			<a href="{{route('admin.inkubator.view','grid')}}">Grid</a>
			<a class="item-divider"></a>
			<a href="{{route('admin.inkubator.view','list')}}">List</a>
			<button class="btn btn-primary btn-md m-1 float-right" type="button" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="i-Add-User text-white mr-2"></i> Tambah Pendamping</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
@foreach($data as $data)
	<div class="col-lg-4 col-xl-4 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="ul-contact-page__profile">
					<div class="user-profile"><img class="profile-picture mb-2" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="alt" /></div>
					<div class="ul-contact-page__info">
						<a href="{{route('inkubator.profile-detail',$data->uid)}}"><p class="m-0 text-24">{{$data->nama}}</p></a>
						<p class="text-muted m-0">{{$data->kontak}}</p>
						<p class="text-muted mt-3">{{$data->alamat}}</p>
						<p class="text-muted mt-3">NO: {{$data->id}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
</div>
</section>
<!-- begin::modal-->
			<div class="ul-card-list__modal">
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
							<h2>Tambah Pendamping</h2>
								<form action="{{ route('inkubator.regis') }}" method="POST">
									@csrf
									<div class="form-group">
										<label>Email</label>
										 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
	
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									</div>
									<div class="form-group">
										<label>Password</label>
										 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
	
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									</div>
									<div class="form-group">
										<label class="fw">Confirm Password</label>
										 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
									</div>
									
									
									<div class="form-group row">
										<div class="col-sm-10">
											<button class="btn btn-success" type="submit">Tambah Pendamping</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end::modal-->
@endsection