@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="card mb-4">
			<div class="card-header container-fluid">
			  <div class="row">
				<div class="col-md-8">
				  <h3>Event</h3>
				</div>
				<div class="col-md-4 btn-group">
				  <a href="#"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
				  <a href="{{route('inkubator.event-calendar')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
				</div>
			  </div>
			</div>
			<div class="card-body">
				<div class="create_event_wrap">
                    <a href="{{route('inkubator.event.create')}}"><button class="btn btn-outline-primary btn-block">Tambah Event</button></a>
				</div>
			</div>
        </div>
        <div class="card mb-4">
			<div class="card-header container-fluid">
			  <div class="row">
				<div class="col-md-8">
				  <h3>Event</h3>
				</div>
				<div class="col-md-4 btn-group">
				  <a href="#"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
				  <a href="{{route('inkubator.event-calendar')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
				</div>
			  </div>
			</div>
			<div class="card-body">
				<div class="create_event_wrap">
                    <div class="d-flex justify-content-center">
                    <a href="{{route('inkubator.event.create')}}"><button class="btn btn-outline-primary btn-lg btn-block">Tambah Event</button></a>
                </div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
                <div id="task-manager-list">
                    <!--  content area -->
                    <div class="content">
                        <!--  task manager table -->
                        <div class="card" id="card">

                            <div class="card-body" id="card-body">
                                <div class="search ul-task-manager__search-inline">
                                    <nav class="navbar">
                                        <form class="form-inline">
                                            <label class="col-sm-2 col-form-label mr-2" for="inputEmail3">Filter:</label>
                                            <input class="form-control mr-sm-2" id="filterInput" type="search" placeholder="type to filter" aria-label="Search" />
                                        </form>
                                    </nav>
                                    <label><span>Show:</span>
                                        <select>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-sm-width" id="names">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Event Description</th>
                                                <th scope="col">Priority</th>
                                                <th scope="col">Latest Update</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Assigned Users</th>
                                                <th scope="col"><a href="href"><span class="checkmarks">
                                                            <div class="checkmark_stem"></div>
                                                            <div class="checkmark_kick"></div>
                                                        </span></a></th>
                                            </tr>
                                        </thead>
                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="7">Last Week</th>
                                            </tr>
                                        </thead>
                                        <tbody id="names">
                                            <!-- --------------------------- tr1 -------------------------------------------->
                                            @foreach ($event as $item)
                                                
                                            
                                            <tr id="names">
                                                <th class="head-width" scope="row">{{ $item->id }}</th>
                                                <td class="collection-item">
                                                    <div class="font-weight-bold"><a href="/inkubator/event/{{ $item->slug }}">{{ $item->title }}</a></div>
                                                    <div class="text-muted">{{ Str::limit($item->event, 100) }}</div>
                                                </td>
                                                <td class="custom-align">
                                                    <div class="btn-group">
                                                        <button class="btn btn-danger custom-btn btn-sm" type="button" aria-haspopup="true" aria-expanded="false">
                                                            {{ $item->priority->name }}
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="custom-align">
                                                    <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Calendar-4"></i><span>{{ $item->created_at->format("d M Y") }}</span></div>
                                                </td>
                                                <td class="custom-align">
                                                    {!! $item->publish == 1 ? '<button class="btn btn-sm btn-primary">Published</button>' : '<button class="btn btn-sm btn-warning">Draft</button>' !!}
                                                    {{-- <button class="btn btn-sm btn-primary">
                                                        {{ $item->publish }}
                                                    </button> --}}
                                                </td>
                                                <td class="custom-align"><img class="rounded-circle m-0 ul-task-manager__avatar" src="{{ asset('theme/images/faces/1.jpg')}}" alt="alt" /><img class="rounded-circle m-0 ul-task-manager__avatar" src="{{ asset('theme/images/faces/1.jpg')}}" alt="alt" /><i class="i-Add font-custom-table"></i></td>
                                                <td class="custom-align"><span id="menu-toggle">
                                                        <div class="dropdown"><i class="i-Align-Right custom-font-down-arrow" data-toggle="dropdown"></i>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">Check In</a><a class="dropdown-item" href="#">Attach Screenshot 2</a><a class="dropdown-item" href="#">Reassign</a><a class="dropdown-item" href="#">Edit Task</a><a class="dropdown-item" href="#">Remove</a></div>
                                                        </div>
                                                    </span></td>
                                            </tr>
                                            @endforeach                                    <!--  end of table row 3 -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row align-items-center">
                                    <div class="col"><span>Showing 1 to 25 of 25 entries</span></div>
                                    {{-- <div class="d-flex justify-content-end">
                                          
                                    </div> --}}
                                     {{  $event->links()  }}
                                </div>
                            </div>
                        </div>
                        <!--  end of task manager table -->
                    </div>
                    <!--  end of content area -->
                </div>
	</div>
</div>
@endsection
