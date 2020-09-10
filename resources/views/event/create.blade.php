@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/inkubator/event/store" method="post" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="title">
          </div>
          <div class="input-group mb-3">
            <div class="custom-file">
              <label class="custom-file-label" for="foto" aria-describedby="inputGroupFileAddon02">Choose file</label>
                <input class="custom-file-input" id="foto" type="file"  name="foto"/>
            </div>
            <div class="input-group-append"><span class="input-group-text" id="inputGroupFileAddon02">Upload</span></div>
        </div>
          <div class="form-group">
            <label for="event">Event</label>
            <textarea name="event" class="form-control" id="body" rows="5"></textarea>
          </div>
          <div class="row">
          <div class="form- col-md-6">
            <label for="priority">Priority</label>
            <select class="form-control" name="priority_id" id="priority_id">
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
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
    </div>
</div>
@endsection
