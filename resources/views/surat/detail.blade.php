@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Detail Pesan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
            @foreach($surat as $p)
            <div class="col-12">
              <h4> Judul</h4>
              <p>{{ $p->title }}</p>
            </div>

            <div class="col-12">
                <h4>Dari</h4>
                    <p>{{ $p->dari }}</p>
            </div>

            <div class="col-12">
                <h4>Kepada</h4>
                    <p>{{ $p->kepada }}</p>
            </div>

            <div class="col-12">
                <h4>Jenis Surat</h4>
                    <p>{{ $p->jenis_surat }}</p>
            </div>
            
            <div class="col-12">
                <h4>Perihal</h4>
                    <p>{{ $p->perihal }}</p>
            </div>

            <div class="col-12">
                <h4>Dokumen</h4>
                    <img src="/file/dokumen/{{ $p->dokumen }}" class="dokumen" alt="dokumen">
            </div>

            

            
              @endforeach
            </div>
          </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection
