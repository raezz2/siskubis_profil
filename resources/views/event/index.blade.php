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

        {{-- Menu Filter --}}
        <div class="card mb-4">
			<div class="card-header container-fluid">
			  <div class="row">
				<div class="col">
				  <h3>Filter</h3>
				</div>
			  </div>
			</div>
			<div class="card-body">
                {{-- <form action="{{ route('search.event') }}" method="get"> --}}
                    <div class="form-group">
                        <label for="search">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="search" value="{{ request()->input('title') }}">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="daterange">Rentang tanggal</label>
                        <input type="text" name="daterange" class="form-control" placeholder="set tanggal">
                    </div> --}}
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        @foreach ($priority as $item)
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="priority" value="{{ $item->id }}"
                                    @if (in_array($item->id, explode(',', request()->input('filter.priority'))))
                                        checked
                                    @endif
                                /><span>{{ $item->name }}</span><span class="checkmark"></span>
                            </label>
                        @endforeach
                        {{-- <select name="priority" class="form-control">
                            <option>Pilih Salah satu</option>
                            @foreach ($priority as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    <div class="form-group">
                        <label for="publish">Status</label>
                        halo
                        <label class="checkbox checkbox-primary">
                            <input type="checkbox" value="1" name="publish"
                            @if (in_array('1', explode(',', request()->input('filter.publish'))))
                                checked
                            @endif
                            /><span>Published</span><span class="checkmark"></span>
                        </label>
                        <label class="checkbox checkbox-warning">
                            <input type="checkbox" value="0" name="publish"
                            @if (in_array('0', explode(',', request()->input('filter.publish'))))
                                checked
                            @endif
                            /><span>Draft</span><span class="checkmark"></span>
                        </label>
                        {{-- <select name="publish" class="form-control">
                            <option value="2">All</option>
                            <option value="1">Published</option>
                            <option value="0">Draft</option>
                        </select> --}}
                    </div>
                    <div class="form-group">
                        <button id="filter" class="btn btn-primary">Filter</button>
                    </div>
                {{-- </form> --}}
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
                                                <th scope="col">Action</th>
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
                                                        @if ( $item->priority->id == 1 )
                                                        <button class="btn btn-primary custom-btn btn-sm" type="button" aria-haspopup="true" aria-expanded="false">
                                                            {{ $item->priority->name }}
                                                        </button>
                                                        @elseif( $item->priority->id == 2 )
                                                        <button class="btn btn-danger custom-btn btn-sm" type="button" aria-haspopup="true" aria-expanded="false">
                                                            {{ $item->priority->name }}
                                                        </button>
                                                        @elseif( $item->priority->id == 3 )
                                                        <button class="btn btn-warning custom-btn btn-sm" type="button" aria-haspopup="true" aria-expanded="false">
                                                            {{ $item->priority->name }}
                                                        </button>
                                                        @else
                                                        <button class="btn btn-info custom-btn btn-sm" type="button" aria-haspopup="true" aria-expanded="false">
                                                            {{ $item->priority->name }}
                                                        </button>
                                                        @endif
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
                                                            <div><a href="/inkubator/event/{{ $item->slug}}/delete"><i class="text-20 i-Remove-Basket"></i></a> <br> <a href="/inkubator/event/{{ $item->slug }}/edit"><i class="text-20 i-Edit"></i></a></div>
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

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });

    function getIds(checkboxName) {
        let checkBoxes = document.getElementsByName(checkboxName);
        let ids = Array.prototype.slice.call(checkBoxes)
                        .filter(ch => ch.checked==true)
                        .map(ch => ch.value);
        return ids;
    }

    function filterResults () {
        let priorityIds = getIds("priority");
        let title = $('#title').val();
        let publishStats = getIds("publish");

        let href = 'event?';

        if(priorityIds.length) {
            href += 'filter[priority]=' + priorityIds;
        }

        if(publishStats.length) {
            href += '&filter[publish]=' + publishStats;
        }

        if(title !== ""){
            href += '&filter[title]=' + title;
        }

        document.location.href=href;
    }

    document.getElementById("filter").addEventListener("click", filterResults);
</script>
@endsection