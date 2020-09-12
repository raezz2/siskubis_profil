@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{$title}}</h4>
            </div>
            <div class="modal-body">
                @if(session('pesan'))
                <div class="alert alert-success alert-block">
                    <b>Berhasil</b> : {{session('pesan')}}
                </div>
                @endif
                <form action="/inkubator/pengumuman/store" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Title...." name="title" />
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="kategori">
                            <option selected="" disabled="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="inkubator">
                            <option selected="" disabled="">Pilih Inkubator</option>
                            <option value="0">Kategori Umum</option>
                            @foreach ($inkubator as $i)
                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Pengumuman ...." name="pengumuman"></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="modal-footer">
                        <a href="/inkubator/pengumuman/"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button></a>
                        <button class="btn btn-primary" type="submit">
                            Save
                            changes
                        </button>
                    </div>
                </form>
            </div>
            @endsection