@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-body">
        <form action="/inkubator/event/store" method="post" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="title">
            @error('title')
                <div class="mt-2 text-danger">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="foto">Foto</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <label class="custom-file-label" for="foto">Choose file</label>
                <input class="custom-file-input" id="foto" type="file"  name="file"/>
              </div>
            </div>
            @error('title')
            <div class="mt-2 text-danger">
              Please Choose Your File
            </div>
        @enderror
          </div>
          <div class="form-group">
            <label for="event">Event</label>
            <textarea name="event" class="form-control" id="event" rows="5"></textarea>
            @error('event')
                <div class="mt-2 text-danger">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="tgl_mulai">Tanggal Mulai :</label>
              <div class="input-group">
                <input type="date" name="tgl_mulai" class="form-control">
                <input type="time" name="waktu_mulai" class="form-control">
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="tgl_selesai">Tanggal Selesai</label>
              <div class="input-group">
                <input type="date" name="tgl_selesai" class="form-control">
                <input type="time" name="waktu_selesai" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="priority">Priority</label>
              <select class="form-control" name="priority_id" id="priority_id">
                <option value="">Pilih salah satu</option>
                @foreach ($priority as $prio)
                    <option value="{{ $prio->id }}">{{ $prio->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="publish">Publish</label>
              <select name="publish" class="form-control" id="publish">
                <option value="1">Publish</option>
                <option value="0">Draft</option>
              </select>
            </div>
        </div>
          <br>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
    </div>
</div>
@endsection


