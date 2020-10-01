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
                    @role('inkubator')
                    <a href="{{route('inkubator.event-list')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
                    <a href="{{route('inkubator.event-calendar')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
                    @endrole
                    @role('tenant')
                    <a href="{{route('tenant.event-list')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
                    <a href="{{route('tenant.event-calendar')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
                    @endrole
                    @role('mentor')
                    <a href="{{route('mentor.event-list')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
                    <a href="{{route('mentor.event-calendar')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
                    @endrole
				</div>
			  </div>
            </div>
            @role('inkubator')
			<div class="card-body">
				<div class="create_event_wrap">
                    <a href="{{route('inkubator.event.create')}}"><button class="btn btn-outline-primary btn-block">Tambah Event</button></a>
				</div>
            </div>
            @endrole
        </div>

        {{-- Menu Filter --}}
        @role(['inkubator', 'mentor'])
        <div class="card mb-4">
			<div class="card-header container-fluid">
			  <div class="row">
				<div class="col">
				  <h3>Filter</h3>
				</div>
			  </div>
            </div>
			<div class="card-body">
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="title" id="title" class="form-control" placeholder="search" value="{{ request()->input('title') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="daterange">Rentang tanggal</label>
                    <input type="text" name="daterange" class="form-control" placeholder="set tanggal">
                </div>
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
                </div>
                <div class="form-group">
                    <label for="publish">Status</label>
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
                </div>
                <div class="form-group">
                    <button id="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
        @endrole
	</div>
	<div class="col-md-9">
        <div class="form-row">
    {{-- <div class="col-12">
      @include('event.alert')
    </div> --}}
        <div id="task-manager-list">
            <!--  content area -->
            <div class="content"> 
                <!--  task manager table -->
                <div class="card" id="card">

                    <div class="card-body" id="card-body">
                        <div class="search ul-task-manager__search-inline">
                            <nav class="navbar">
                                <form class="form-inline">
                                        
                                </form>
                            </nav>
                            {{-- <label><span>Show:</span>
                                <select id="pagination">
                                             <option value="5" @if($items == 5) selected @endif >5</option>
                                             <option value="10" @if($items == 10) selected @endif >10</option>
                                             <option value="25" @if($items == 25) selected @endif >25</option>
                                </select>
                            </label> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered custom-sm-width" id="names">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Event Description</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col">Tanggal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Latest Update</th>
                                        
                                        @role('inkubator')
                                        <th scope="col">Action</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="8">Last Week</th>
                                    </tr>
                                </thead>
                                <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach ($event as $key => $item)
                                        
                                    
                                    <tr id="names">
                                        <th class="head-width" scope="row">{{ $event->firstItem() + $key }}</th>
                                        <td class="collection-item">
                                            @role('inkubator')
                                            <div class="font-weight-bold"><a href="/inkubator/event/{{ $item->slug }}">{{ $item->title }}</a></div>
                                            @endrole
                                            @role('mentor')
                                            <div class="font-weight-bold"><a href="/inkubator/event/{{ $item->slug }}">{{ $item->title }}</a></div>
                                            @endrole
                                            @role('tenant')
                                            <div class="font-weight-bold"><a href="/tenant/event/{{ $item->slug }}">{{ $item->title }}</a></div>
                                            @endrole
                                            <div class="text-muted">{!! Str::limit($item->event, 50) !!}</div>
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
                                            <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Calendar-4"></i><span>{{ $item->tgl_mulai->format("d M Y") }}</span></div>
                                            <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Clock"></i><span>{{ $item->waktu_mulai->format("H:i") }}</span></div>
                                        </td>
                                        <td class="custom-align">
                                            <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Calendar-4"></i><span>{{ $item->tgl_selesai->format("d M Y") }}</span></div>
                                            <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Clock"></i><span>{{ $item->waktu_selesai->format("H:i") }}</span></div>
                                        </td>
                                        <td class="custom-align">
                                            {!! $item->publish == 1 ? '<button class="btn btn-sm btn-primary">Published</button>' : '<button class="btn btn-sm btn-warning">Draft</button>' !!}
                                        </td>
                                        <td class="custom-align">
                                            <div class="d-inline-flex align-items-center calendar align-middle"><i class="i-Calendar-4"></i><span>{{ $item->updated_at->format("d M Y") }}</span></div>
                                        </td>
                                        
                                        @role('inkubator')
                                        <td><a class="ul-link-action text-success" href="/inkubator/event/{{ $item->slug }}/edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="i-Edit"></i></a><a class="ul-link-action text-danger mr-1 hapus"  href="/inkubator/event/{{ $item->slug }}/delete" data-toggle="tooltip" data-placement="top" title="Want To Delete !!!"><i class="i-Eraser-2"></i></a>
                                        @endrole
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

@section('css')
<link rel="stylesheet" href="{{ asset('theme/css/plugins/datatables.min.css')}}" />
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{ asset('theme/js/scripts/datatables.script.min.js')}}"></script>
<script>

$(document).ready( function () {
    $('#names').DataTable(
        {
            "pagingType": "numbers",
            "searching": false
        }
    );
});
    
    $(function() {
        $('input[name="daterange"]').daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Clear'
        },
        }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
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
        let start = $('input[name="daterange"]').val();

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

        if(start !== ""){
            let startDate = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');

            href += '&filter[between]=' + startDate + ',' + endDate;
        }

        console.log(href);

        document.location.href=href;
    }

    document.getElementById("filter").addEventListener("click", filterResults);

    toastr.options = {
        "debug": false,
        //   "positionClass": "toast-bottom-full-width",
        "onclick": null,
        "showMethod": "slideDown",
        "hideMethod": "slideUp",
        "timeOut": 2000,
        "extendedTimeOut": 1000
    }

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
  
    $('.hapus').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
        title: 'Apa Anda Yakin Menghapus ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection

