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
				 <a href="{{route('inkubator.event-list')}}"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Receipt"></i></button></a>
				 <a href="#"><button class="btn btn-primary custom-btn btn-sm"><i class="i-Calendar-4"></i></button></a>
				</div>
			  </div>
			</div>
			<div class="card-body">
				<div class="create_event_wrap">
					<form class="js-form-add-event">
						<div class="form-group">
							<label for="newEvent">Create new Event</label>
							<input class="form-control" id="newEvent" type="text" name="newEvent" placeholder="new Event" aria-describedby="helpId" />
						</div>
					</form>
					<ul class="list-group" id="external-events">
						<li class="list-group-item bg-success fc-event">
							Hello World

						</li>
						<li class="list-group-item bg-primary fc-event">
							Go to Shopping

						</li>
						<li class="list-group-item bg-warning fc-event">
							Payment schedule

						</li>
						<li class="list-group-item bg-danger fc-event">
							Rent Due

						</li>
					</ul>
					<p>
						<input id="drop-remove" type="checkbox" />
						<label for="drop-remove">remove after drop</label>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="response"></div>
		<div class="card mb-4 o-hidden">
			<div class="card-body">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/calendar/fullcalendar.min.css')}}" />
@endsection
@section('js')
<script src="{{ asset('theme/js/plugins/calendar/jquery-ui.min.js')}}"></script>
<script src="{{ asset('theme/js/plugins/calendar/moment.min.js')}}"></script>
<script src="{{ asset('theme/js/plugins/calendar/fullcalendar.min.js')}}"></script>
{{-- <script src="{{ asset('theme/js/scripts/calendar.script.min.js')}}"></script> --}}

<script>
	$(document).ready(function () {

/* initialize the external events
		-----------------------------------------------------------------*/
function initEvent() {
  $('#external-events .fc-event').each(function () {
	// store data so the calendar knows to render an event upon drop
	$(this).data('event', {
	  title: $.trim($(this).text()),
	  // use the element's text as the event title
	  color: $(this).css('background-color'),
	  stick: true // maintain when user navigates (see docs on the renderEvent method)

	}); // make the event draggable using jQuery UI

	$(this).draggable({
	  zIndex: 999,
	  revert: true,
	  // will cause the event to go back to its
	  revertDuration: 0 // original position after the drag

	});
  });
}

initEvent();
/* initialize the calendar
-----------------------------------------------------------------*/

var newDate = new Date(),
	date = newDate.getDate(),
	month = newDate.getMonth(),
	year = newDate.getFullYear();
$('#calendar').fullCalendar({
  header: {
	left: 'prev,next today',
	center: 'title',
	right: 'month,agendaWeek,agendaDay'
  },
  themeSystem: "bootstrap4",
  droppable: true,
  editable: true,
  eventLimit: true,
  // allow "more" link when too many events
  drop: function drop() {
	// is the "remove after drop" checkbox checked?
	if ($('#drop-remove').is(':checked')) {
	  // if so, remove the element from the "Draggable Events" list
	  $(this).remove();
	}
  },
  events: [
	  @foreach($event as $e){
		title: "{{ $e->title }}",
		start: "{{ $e->tgl_mulai }}",
		end: "{{ $e->tgl_selesai }}",
		color: "#ffc107",
		url : "{{ $e->slug }}",
	  },
	  @endforeach
  ]
});
jQuery(".js-form-add-event").on("submit", function (e) {
  e.preventDefault();
  var data = $('#newEvent').val();
  $('#newEvent').val('');
  $('#external-events').prepend('<li class="list-group-item bg-success fc-event">' + data + '</li>');
  initEvent();
});
});
</script>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> bfb9e07ff12425f8654b38ec2cc5204e5516ebdb
