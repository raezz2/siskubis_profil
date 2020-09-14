@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				<h3>Pengumuman</h3>
			</div>
			<div class="card-body">
				<div class="ul-contact-list">
					<div class="contact-close-mobile-icon float-right mb-2"><i class="i-Close-Window text-15 font-weight-600"></i></div>
					<!-- modal-->
					<a href="/inkubator/pengumuman/tambah"><button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal">Tambah Pengumuman</button></a>
					<!-- end:modal-->
					<input class="form-control form-control-rounded col-md-12" id="exampleFormControlInput1" type="text" placeholder="Search Tenant..." />
					<br>
					<div class="list-group" id="list-tab" role="tablist"><a class="list-group-item list-group-item-action border-0 active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="nav-icon i-Business-Mens"></i> Semua Pengumuman</a>
						<a class="list-group-item list-group-item-action border-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="nav-icon i-Conference"></i> Non Tenan</a>
						<label class="text-muted font-weight-600 py-8" for="">MEMBERS INKUBATOR</label>
						<select class="form-control form-control-rounded">
							<option>All Inkubator</option>
							<option></option>
						</select>
						</br>
						<a class="list-group-item list-group-item-action border-0" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i> Pra Start Up</a>
						<a class="list-group-item list-group-item-action border-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="nav-icon i-Arrow-Next"></i> Start Up</a>
						<a class="list-group-item list-group-item-action border-0" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings"><i class="nav-icon i-Arrow-Next"></i> Scale Up</a>
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
							<th width="65%">Pengumuman</th>
							<th width="15%">Kategori</th>
							<th width="15%">Status</th>
							<th width="15%">Tanggal</th>
							<th width="5%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pengumuman as $p)
						<tr>
							<td>
								<a href="/inkubator/pengumuman/{{ $p->slug }}">
									<strong>{{ $p->title }}</strong>
									<p>{{ str_limit($p->pengumuman), '100' }}</p>
								</a>
							</td>
							<td>
								@if($p->priority_id == 1)
								<a class="badge badge-success m-2 p-2" href="#">{{ $p->priority->name }}</a>
								@elseif($p->priority_id == 2)
								<a class="badge badge-danger m-2 p-2" href="#">{{ $p->priority->name }}</a>
								@elseif($p->priority_id == 3)
								<a class="badge badge-primary m-2 p-2" href="#">{{ $p->priority->name }}</a>
								@else
								<a class="badge badge-warning m-2 p-2" href="#">{{ $p->priority->name }}</a>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-danger btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										Status
									</button>
									<div class="dropdown-menu ul-task-manager__dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -102px, 0px);"><a class="dropdown-item" href="#"><span class="ul-task-manager__dot bg-warning mr-2">
											</span>Draft</a><a class="dropdown-item" href="#"><span class="ul-task-manager__dot bg-success mr-2">
											</span>Published</a></div>
								</div>

							</td>
							<td>{{ $p->created_at }}</td>
							<td><a class="ul-link-action text-success" data-toggle="tooltip" href="/inkubator/pengumuman/edit/{{ $p->id }}" data-placement="top" title="Edit"><i class="i-Edit"></i>
									<a class="ul-link-action text-danger mr-1" href="/inkubator/pengumuman/hapus/{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Want To Delete !!!">
										<i class="i-Eraser-2"></i></a>
							</td>
						</tr>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><!-- end of main-content -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Tenant</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<input class="form-control" type="text" placeholder="Title...." name="title" />
					</div>
					<div class="form-group">
						<select class="form-control">
							<option value="">Pilih Kategori</option>
							<option value="1"></option>
							<option value="2"></option>
							<option value="3"></option>
						</select>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" placeholder="Pengumuman ...." name="pengumuman"></textarea>
					</div>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="exampleInputFile" name="file">
						<label class="custom-file-label" for="exampleInputFile">Choose file</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" type="button">
					Save
					changes
				</button>
			</div>
		</div>
	</div>
</div> <!-- end of form-input -->
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
	$(document).ready(function() {
		var flash = "{{ Session::get('sukses')}}";
		if (flash) {
			var pesan = "{{ Session::get('sukses')}}"
			alert(pesan);
		}

		$('.btn-refresh').click(function(e) {
			e.preventDefault();
			location.reload();
		})
	});
	$(document).ready(function() {
		var flash = "{{ Session::get('hapus')}}";
		if (flash) {
			var pesan = "{{ Session::get('hapus')}}"
			alert(pesan);
		}

		$('.btn-refresh').click(function(e) {
			e.preventDefault();
			location.reload();
		})
	});
	$('#ul-contact-list').DataTable({
		responsive: true,
		order: [
			[2, 'DESC']
		]
	});
</script>
@endsection