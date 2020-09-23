@extends('layouts.app')

<style>
  .dropzoneDragArea {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    padding: 60px;
    text-align: center;
    margin-bottom: 15px;
    cursor: pointer;
}
.dropzone{
  box-shadow: 0px 2px 20px 0px #f2f2f2;
  border-radius: 10px;
}
</style>
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
                <input class="custom-file-input" id="foto" type="file"  name="foto"/>
            </div>
          </div>
          @error('foto')
          <div class="mt-2 text-danger">
            {{ $message }}
          </div>
          @enderror
          </div>
          {{-- <div class="row mb-4">
            <div class="col-md-6 mb-4">
          <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div> --}}
          
          <div class="form-group">
            <label for="event">Event</label>
            <textarea name="event" id="event" class="form-control"></textarea>
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
                <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai">
              </div>
              @error('tgl_mulai')
                  <div class="mt-2 text-danger">
                    {{ $message }}
                  </div>
              @enderror
              @error('waktu_mulai')
                  <div class="mt-2 text-danger">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="tgl_selesai">Tanggal Selesai</label>
              <div class="input-group">
                <input type="date" name="tgl_selesai" class="form-control" id="tgl_selesai">
                <input type="time" name="waktu_selesai" class="form-control" id="waktu_selesa">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
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
          <br>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" id="#submit-all">Tambah</button>
          </div>
        </form>
    </div>
</div>
@endsection

@section('js')
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace('event');

  // Dropzone.autoDiscover = false;
	// jQuery(document).ready(function() {

	//   $("div#my-awesome-dropzone").dropzone({
  //     maxFilesize: 2,
  //     maxFiles: 1,  // 3 mb
  //     acceptedFiles: ".jpeg,.jpg,.png",
  //     addRemoveLinks: true,
  //     url: "/inkubator/event/store",
      
      
	//   });

  // });
  
  </script>
@endsection
