@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection

@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{ route('tenant.storeTeam',$produk->id) }}" method="post" id="form-team">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="profil_id">Nama</label>
                            <select type="text" class="form-control" name="profil_id">
                                @foreach ($user_id as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <input type="text" name="divisi" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tugas">Tugas</label>
                            <input type="text" name="tugas" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead class="text-center">
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Tugas</th>
                    <th>#</th>
                </thead>
                <tbody class="text-center" id="team-list">
                    @foreach ($team as $item)
                    <tr id="team{{ $item->id }}">
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->divisi }}</td>
                        <td>{{ $item->tugas }}</td>
                        <td><button href="" class="btn btn-danger btn-sm" value="{{ $item->id }}">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="col-md-12 text-right">
        <a href="{{route('tenant.produk')}}" class="btn btn-success">
            Selesai
        </a>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    });
    $('#form-team').on('submit', function(event){
        event.preventDefault();
        var url = '';
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            success: function(data){
                var team = '<tr id="team'+data.id+'"><td>'+data.nama+'</td><td>'+data.jabatan+'</td><td>'+data.divisi+'</td><td>'+data.tugas+'</td>';
                team += '<td><button href="" class="btn btn-danger btn-sm" value="'+data.id+'">Delete</button></td></tr>';
                $('#team-list').append(team);
            },
            error: function(data){
                console.log(data);
            }
        });
        console.log('ok');
    });
</script>
@endsection
