{{-- <img src="https://dummyimage.com/600x400/cfcfcf/fff" alt="">
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h5>
                Judul / Nama Event
            </h5>
        </div>
        <div class="card-body">
            <div class="text-center">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="https://dummyimage.com/600x400/cfcfcf/fff" alt="">
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <p class="mb-1"><i class="i-Calendar">Text</i></p>
                    </div>
                    <ul>
                        <li>Yang posting</li>
                        <li>Judul Event</li>
                        <li>lokasi</li>
                        <li>tanggal event</li>
                        <li>waktu event</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="" id="about">
                <h4>Detail Event</h4>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, commodi quam! Provident quis voluptate asperiores ullam, quidem odio pariatur. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, nulla eos?
                    Cum non ex voluptate corporis id asperiores doloribus dignissimos blanditiis iusto qui repellendus deleniti aliquam, vel quae eligendi explicabo.
                </p>
                <hr />
                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p><span>1 Jan, 1994</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Birth Place</p><span>Dhaka, DB</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Lives In</p><span>Dhaka, DB</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p><span>1 Jan, 1994</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Email</p><span>example@ui-lib.com</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p><span>www.ui-lib.com</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession</p><span>Digital Marketer</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Experience</p><span>8 Years</span>
                        </div>
                        <div class="mb-4">
                            <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> School</p><span>School of Digital Marketing</span>
                        </div>
                    </div>
                </div>       
        </div>
        <div class="col-md-6">
            <div class="card bg-dark text-white o-hidden mb-4"><img class="card-img" src="https://dummyimage.com/600x400/cfcfcf/fff" alt="Card image" />
                <div class="card-img-overlay">
                    <div class="text-center pt-4">
                        <h5 class="card-title mb-2 text-white">Card title</h5>
                        <div class="separator border-top mb-2"></div>
                        <p class="text-small font-italic">Last updated 3 mins ago</p>
                    </div>
                    <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i> 12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark text-white o-hidden mb-4"><img class="card-img" src="{{ asset("storage/" . $event->foto) }}" alt="Card image">
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
                    <i class="i-Calendar-4 mr-2"></i> 20 September 2020
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
                  {{ $event->event }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection