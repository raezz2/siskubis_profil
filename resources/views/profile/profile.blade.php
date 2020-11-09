@extends('layouts.app')

@section('breadcrumb')
<div class="breadcrumb">
	<h1 class="mr-2">Profil Pengguna</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
@endsection
@section('content')
<section class="ul-contact-detail">
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="card o-hidden"><img class="d-block w-100" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="First slide">
                                <div class="card-body">
                                    <div class="ul-contact-detail__info">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <div class="ul-contact-detail__info-1">
                                                    <h5><b>{{$data->nama}}</b></h5>
                                                </div>
                                            </div>
                                            <div class="col-6 text-center">
                                                <div class="ul-contact-detail__info-1">
                                                    <h5>Nik</h5><span>{{$data->nik}}</span>
                                                </div>
                                                <div class="ul-contact-detail__info-1">
                                                    <h5>Email</h5><span>{{$data->email}}</span>
                                                </div>
                                            </div>
											<div class="col-6 text-center">
                                                <div class="ul-contact-detail__info-1">
                                                    <h5>Kontak</h5><span>{{$data->kontak}}</span>
                                                </div>
                                                <div class="ul-contact-detail__info-1">
                                                    <h5>Jenis Kelamin</h5><span>{{$data->jenkel}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <div class="ul-contact-detail__info-1">
                                                    <h5>Alamat</h5><span>{{$data->alamat}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <div class="ul-contact-detail__social">
                                                    <div class="ul-contact-detail__social-1">
                                                        <button class="btn btn-facebook btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Facebook-2"></i></span></button><span class="t-font-boldest ul-contact-detail__followers">400</span>
                                                    </div>
                                                    <div class="ul-contact-detail__social-1">
                                                        <button class="btn btn-twitter btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Twitter"></i></span></button><span class="t-font-boldest ul-contact-detail__followers">900</span>
                                                    </div>
                                                    <div class="ul-contact-detail__social-1">
                                                        <button class="btn btn-dribble btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Dribble"></i></span></button><span class="t-font-boldest ul-contact-detail__followers">658</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-8">
                            <!--  begin::basic-tab -->
                            <div class="card mb-4">
                                <div class="card-header bg-transparent">Data Profil</div>
                                <div class="card-body">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist"><a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Home</a><a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a><a class="nav-item nav-link " id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="true">Edit Contact</a></div>
                                    </nav>
                                    <div class="tab-content ul-tab__content" id="nav-tabContent">
                                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="ul-contact-detail__timeline">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="ul-contact-detail__timeline-row">
                                                            <div class="row">
                                                                <div class="col-lg-1">
                                                                    <div class="ul-contact-detail__left-timeline">
                                                                        <div class="ul-widget3-img"><img class="img-fluid" id="userDropdown" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-11">
                                                                    <div class="ul-contact-detail__right-timeline"><a class="ul-widget4__title d-block" href="href">Saya Pengguna</a><small class="text-mute">10 minutes</small>
                                                                        <p>Mengupdate tugas baru <a href="#">Weblayout</a></p>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ul-contact-detail__timeline-row">
                                                            <div class="row">
                                                                <div class="col-lg-1">
                                                                    <div class="ul-contact-detail__left-timeline">
                                                                        <div class="ul-widget3-img"><img id="userDropdown" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-11">
                                                                    <div class="ul-contact-detail__right-timeline"><a class="ul-widget4__title d-block" href="href">Saya Pengguna</a><small class="text-mute">10 minutes</small>
                                                                        <p>Membuat tugas baru <a href="#">Weblayout</a></p>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ul-contact-detail__timeline-row">
                                                            <div class="row">
                                                                <div class="col-lg-1">
                                                                    <div class="ul-contact-detail__left-timeline">
                                                                        <div class="ul-widget3-img"><img id="userDropdown" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="ul-contact-detail__right-timeline"><a class="ul-widget4__title d-block" href="href">Saya Pengguna</a><small class="text-mute">10 minutes</small>
                                                                        <p class="mt-3">Penempatan Jabatan Sebagai CEO di PT. Agrito Sejahtera Indonesia</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ul-contact-detail__timeline-row">
                                                            <div class="row">
                                                                <div class="col-lg-1">
                                                                    <div class="ul-contact-detail__left-timeline">
                                                                        <div class="ul-widget3-img"><img id="userDropdown" src="{{ asset('theme/images/faces/'.$data->foto)}}" alt="alt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-11">
                                                                    <div class="ul-contact-detail__right-timeline"><a class="ul-widget4__title d-block" href="href">Saya Pengguna</a><small class="text-mute">10 minutes</small>
                                                                        <p>Mendaftarkan Tenant dengan nama PT. Agrito Sejahtera Indonesia</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="row">
                                                @foreach( $tenant as $tenant)
                                                    @role('inkubator')
                                                    <a href="{{route('inkubator.tenant-detail',[''.$tenant->name,''.$tenant->tenant_id])}}" >
                                                    @endrole
                                                    @role('mentor')
                                                    <a href="{{route('mentor.detailtenant',[''.$tenant->name,''.$tenant->tenant_id])}}" >
                                                    @endrole
                                                    @role('tenant')
                                                    <a href="{{route('tenant.detail-tenant')}}" >
                                                    @endrole
                                                    <div class="list-item col-md-4">
													<div class="card o-hidden mb-4 d-flex flex-column">
														<div class="list-thumb d-flex"><img alt="" src="{{ asset('img/tenant/'.$tenant->foto)}}"></div>
														<div class="flex-grow-1 d-bock">
															<div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                                            @role('mentor')
                                                            <a class="w-40 w-sm-100" href="{{route('mentor.detailtenant',[''.$tenant->name,''.$tenant->tenant_id])}}">
                                                            @endrole
                                                            @role('inkubator')
                                                            <a class="w-40 w-sm-100" href="{{route('inkubator.tenant-detail',[''.$tenant->name,''.$tenant->tenant_id])}}">
                                                            @endrole
                                                            @role('tenant')
                                                            <a class="w-40 w-sm-100" href="{{route('tenant.detail-tenant')}}">
                                                            @endrole
																	<div class="item-title"><b>{{$tenant->subtitle}}</b></div>
																</a>
                                                                <p class="m-0 text-muted text-small w-15 w-sm-100">{{$tenant->title}}</p>
                                                                @if( $data->role_id == 2)
                                                                Menjabat Anggota
                                                                @elseif( $data->role_id == 6)
                                                                Menjabat CEO
                                                                @endif

                                                                @if($tenant->name == 'Proposal')
                                                                <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-primary">{{ $tenant->name}}</span></p>
                                                                @elseif($tenant->name == 'Pra Start Up')
                                                                <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-warning">{{ $tenant->name}}</span></p>
                                                                @elseif($tenant->name == 'Start Up')
                                                                <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-danger">{{ $tenant->name}}</span></p>
                                                                @else
                                                                <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-success">{{ $tenant->name}}</span></p>
                                                                @endif
															</div>
														</div>
													</div>
													</a>
													</div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="ul-contact-dwtail__profile-swcription">
                                                        <h4>Deskripsi</h4>
                                                        <p class="mt-3">{{$data->deskripsi}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xl-12">
                                                    <h4 class="card-title mb-3">Skills</h4>
                                                    <div class="custom-separator"></div><span>Wordpress</span>
                                                    <div class="progress mb-3 mt-2">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                                                    </div><span>HTML 5</span>
                                                    <div class="progress mb-3 mt-2">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div><span>React.js</span>
                                                    <div class="progress mb-3 mt-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                    </div><span>Photoshop</span>
                                                    <div class="progress mb-3 mt-2">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="inputEmail3">Email</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="inputEmail3" type="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="inputPassword3">Password</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="inputPassword3" type="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button class="btn btn-primary" type="submit">Sign in</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  end::basic-tab -->
                        </div>
                    </div>
                </section>
@endsection