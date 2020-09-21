@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark text-white o-hidden mb-4"><img style="height: 310px" class="card-img" src="{{ asset("storage/" . $event->foto) }}" alt="Card image">
            {{-- <div class="card-img-overlay">
                <div class="text-center pt-4">
                    <h5 class="card-title mb-2 text-white">Card title</h5>
                    <div class="separator border-top mb-2"></div>
                    <p class="text-small font-italic">Last updated 3 mins ago</p>
                </div>
                <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i> 12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
            </div> --}}
        </div>
    </div>
    <div class="col-md-8">
        <div class="card container">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $event->title }}</h2>
                </div>
                <div class="d-flex align-items-center border-bottom-dotted-dim pb-3 mb-3"><img  style="border-radius: 50% !important" class="avatar-md rounded mr-3" src="https://dummyimage.com/75x75/cfcfcf/fff" alt="">
                    <div class="flex-grow-1">
                        <h6 class="m-0">David Hopkins</h6>
                        <p class="m-0 text-small text-muted">tukang posting event inkubator.</p>
                    </div>
                </div>
                <div class="mb-4">
                    <i class="i-Geo21 mr-2"></i> Ds. sanggrahan, Ngemplak, kab. Sleman, DI. Yogyakarta
                </div>
                <div class="mb-4">
                    <i class="i-Calendar-4 mr-2"></i> 
                </div>
                <div class="mb-4">
                    <i class="i-Clock mr-2"></i>{{ $event->waktu_mulai }} - {{ $event->waktu_selesai }}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Detail Event
                </div>
                <p>
                  {!! $event->event !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection