@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="paragraphs">
                    <div class="row">
                        <div class="span12 well">
                            @foreach($pengumuman as $p)
                            <img class="img-polaroid" src="\img\pengumuman\{{ $p->foto }}" style="width:450px; height: auto; float:left; margin-right:10px;" />
                            <div class="content-heading">
                                <h3>{{ $p->title }}</h3>
                            </div>
                            <p class="btn btn-inverse">Diposkan pada {{$p->created_at}}
                            </p>
                            <p style="text-align:justify; text-indent: 0.5in;">{!! $p->pengumuman !!}</p>
                            <div style="clear:both;"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of main-content -->
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
    $('#ul-contact-list').DataTable({
        responsive: true,
        order: [
            [2, 'DESC']
        ]
    });
</script>
@endsection