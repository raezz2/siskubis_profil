@extends('layouts.app')
@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Tenant</h1>
	<div class="row">
	<div class="col-xl-12">
		<div class="navbar navbar-expand-lg navbar-light navbar-component rounded">
			<div class="text-center d-lg-none w-100">
				<button class="task-manager-button navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbar-filter"><i class="i-Filter-2"></i></button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-filter">
				<div class="filter-mobile"><span class="navbar-text font-weight-semibold">Filter:</span></div>
				<ul class="navbar-nav flex-wrap">
					<li class="nav-item dropdown"><a class="navbar-nav-link" href="#" data-toggle="dropdown" aria-expanded="false"><i class="i-Time-Window"></i> By date</a>
						<div class="dropdown-menu"><a class="dropdown-item" href="#">Show all</a>
							<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Yesterday</a><a class="dropdown-item" href="#">This week</a><a class="dropdown-item" href="#">This month</a><a class="dropdown-item" href="#">This year</a>
						</div>
					</li>
					<li class="nav-item dropdown"><a class="navbar-nav-link" href="#" data-toggle="dropdown" aria-expanded="false"><i class="i-Bar-Chart-2"></i> By status</a>
						<div class="dropdown-menu"><a class="dropdown-item" href="#">Show all</a>
							<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Open</a><a class="dropdown-item" href="#">On hold</a><a class="dropdown-item" href="#">Resolved</a><a class="dropdown-item" href="#">Closed</a><a class="dropdown-item" href="#">Duplicate</a><a class="dropdown-item" href="#">Invalid</a><a class="dropdown-item" href="#">Wontfix</a>
						</div>
					</li>
					<li class="nav-item dropdown"><a class="navbar-nav-link" href="#" data-toggle="dropdown" aria-expanded="false"><i class="i-Arrow-Turn-Right"></i> By priority</a>
						<div class="dropdown-menu"><a class="dropdown-item" href="#">Show all</a>
							<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Highest</a><a class="dropdown-item" href="#">High</a><a class="dropdown-item" href="#">Normal</a><a class="dropdown-item" href="#">Low</a>
						</div>
					</li>
				</ul>
				<div class="filter-mobile"><span class="navbar-text font-weight-semibold">View Mode:</span></div>
				<ul class="navbar-nav flex-wrap">
					<li class="nav-item dropdown"><a class="navbar-nav-link" href="#" data-toggle="dropdown" aria-expanded="false"><i class="i-Time-Window"></i> List</a></li>
					<li class="nav-item dropdown"><a class="navbar-nav-link" href="#" data-toggle="dropdown" aria-expanded="false"><i class="i-Bar-Chart-2"></i> Grid</a></li>
				</ul>


			</div>
		</div>
	</div>
	</div>
</div>
@endsection
@section('content')
<div id="task-manager">
	<div class="row">
		<div class="col-xl-9">
			<div class="row">
			@foreach($data as $data)
				<div class="col-xl-4">
					<div class="card mt-2 mb-2">
						<a href="{{route('mentor.detailtenant',[''.$data->name,''.$data->tenant_id])}}"><img class="card-img-top" src="{{ asset('img/tenant/'.$data->foto)}}" alt="" height="300px"></a>
						<div class="card-header">
						<a href="{{route('mentor.detailtenant',[''.$data->name,''.$data->tenant_id])}}"><strong>{{$data->title}}</strong></a>
						</div>
						<div class="card-body">
							<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
								<div>
									<p class="ul-task-manager__paragraph mb-3">{{$data->subtitle}}</p>
									
									@foreach($user as $pt)
										@if($pt->tenant_id == $data->tenant_id)
											<a href="{{route('mentor.profile-detail',''.$pt->user_id)}}"><img class="rounded-circle" src="{{ asset('theme/images/faces/'.$pt->foto)}}" width="36" height="36" alt="corrupted" /></a>
										@endif
									@endforeach
								</div>
								<ul class="list list-unstyled mb-0 mt-3 mt-sm-0 ml-auto">
									
									<li>Priority:</li>
									@if($data->name == 'Proposal')
									<li><a class="badge badge-primary align-top" href="#">{{$data->name}}</a></li>
									@elseif($data->name == 'Pra Start Up')
									<li><a class="badge badge-warning align-top" href="#">{{$data->name}}</a></li>
									@elseif($data->name == 'Start Up')
									<li><a class="badge badge-danger align-top" href="#">{{$data->name}}</a></li>
									@else
									<li><a class="badge badge-success align-top" href="#">{{$data->name}}</a></li>
									@endif
								</ul>
							</div>
						</div>
						<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
						<!-- <span class="ul-task-manager__font-date text-muted">Terdaftar:{{$data->created_at}}</span> -->
						<span>Aktifitas: <span class="font-weight-semibold">18 hours ago</span></span>
							<ul class="list-inline mb-0 mt-2 mt-sm-0">
								<li class="list-inline-item dropdown"><a class="text-default" href="#" data-toggle="dropdown">Aktif</a>
									
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- pagination-->
			<div class="row justify-content-center mt-4">
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
					</ul>
				</nav>
			</div>
			<!-- end of pagination-->
		</div>
		<!-- right-sidebar-content-->
		<div class="col-xl-3">
			
			<!-- end of search-->
			<!-- navigation-->
			<div class="card mb-3">
				<div class="card-header font-weight-bold dropdown-toggle" onclick="customToggle3()">Filter</div>
				<div class="card-body">
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="titles" class="form-control" placeholder="search" value="{{ $title != null ? $title : null }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
					@foreach ($priority as $item)
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" item-id="{{ $item->id }}" name="priority" value="{{ $item->id }}"
                                @if (in_array($item->id, explode(',', request()->input('filter.priority'))))
                                    checked
                                @endif
                            /><span>{{ $item->name }}</span><span class="checkmark"></span>
                        </label>
                    @endforeach
				</div>
                <div class="form-group">
                    <button id="search" class="btn btn-primary">Filter</button>
                </div>
            </div>
			</div>
			<!-- end of navigation-->
			<!-- assigners-->

			<!-- end of assigners-->
			<!-- completeness stats-->
			<div class="card mb-3">
				<div class="card-header font-weight-bold dropdown-toggle" onclick="customToggle6()">Completeness Stats</div>
				<div class="card-body" id="custom-toggle6">
					<ul class="list-unstyled mb-0">
						<li class="mb-3">
							<div class="d-flex align-items-center mb-1">Pra Start Up <span class="text-muted ml-auto">100%</span></div>
							<div class="progress" style="height: 0.125rem;">
								<div class="progress-bar bg-danger" style="width: 100%"><span class="sr-only">100% Complete</span></div>
							</div>
						</li>
						<li class="mb-3">
							<div class="d-flex align-items-center mb-1">Start Up <span class="text-muted ml-auto">0%</span></div>
							<div class="progress" style="height: 0.125rem;">
								<div class="progress-bar bg-warning-400" style="width: 0%"><span class="sr-only">0% Complete</span></div>
							</div>
						</li>
						<li class="mb-3">
							<div class="d-flex align-items-center mb-1">Scale Up <span class="text-muted ml-auto">0%</span></div>
							<div class="progress" style="height: 0.125rem;">
								<div class="progress-bar bg-success-400" style="width: 0%"><span class="sr-only">0% Complete</span></div>
							</div>
						</li>
						<li>
							<div class="d-flex align-items-center mb-1">Proposal <span class="text-muted ml-auto">0%</span></div>
							<div class="progress" style="height: 0.125rem;">
								<div class="progress-bar bg-grey-400" style="width: 0%"><span class="sr-only">0% Complete</span></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- end of completeness-->
		</div>
	</div>

	<script>
		
			function getIds(checkboxName) {
				let checkBoxes = document.getElementsByName(checkboxName);
				let ids = Array.prototype.slice.call(checkBoxes)
								.filter(ch => ch.checked==true)
								.map(ch => ch.value);
				return ids;
			}
		
			function filterResults () {
				let priorityIds = getIds("priority");
				let title = $('input[name="titles"]').val();
		
				let href = 'daftartenant?';
		
				if(priorityIds) {
					href += 'filter[priority]=' + priorityIds;
				}
		
				if(title !== ""){
					href += '&filter[title]=' + title;
				}
		
				console.log(href);
		
				document.location.href=href;
			}
		
			document.getElementById("search").addEventListener("click", filterResults);
		
		</script>
@endsection
