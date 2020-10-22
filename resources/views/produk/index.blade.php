@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @role('tenant')
                <div class="card">
                    <div class="card-header">
                        <h3>Produk</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{route('tenant.formProduk')}}" class="btn btn-outline-primary btn-block" >
                            + Tambah Produk
                        </a>
                        <div class="modal fade" id="formProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newModal">New Produk</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="title" placeholder="Nama Produk" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="title" placeholder="Subtitle" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Harga Pokok" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Harga Jual" />
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select name="publish" class="form-control custom-select" required>
                                                         <option value="">Tag</option>
                                                         <option value="1">Publish</option>
                                                         <option value="0">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select name="publish" class="form-control custom-select" required>
                                                         <option value="">Kategori</option>
                                                         <option value="1">Publish</option>
                                                         <option value="0">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Spesifikasi" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Keterbaharuan" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Manfaat" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Keunggulan" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Teknologi" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="Pengembangan" />
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="subtitle" rows="3" placeholder="Tentang Produk"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="subtitle" rows="3" placeholder="Latar Produk"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputPassword1" type="text" placeholder="No Telphone" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Location" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Address" />
                                            </div>
                                            <div class="input-group">
                                                <select name="priority" class="form-control custom-select" required hidden>
                                                     <option value="">Priority</option>
                                                     <option value="1">Pra Start Up</option>
                                                     <option value="2">Proposal</option>
                                                     <option value="3">Scale Up</option>
                                                     <option value="4">Start Up</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select name="publish" class="form-control custom-select" required>
                                                         <option value="">User Id</option>
                                                         <option value="1">Publish</option>
                                                         <option value="0">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Uploda Proposal</label><br>
                                                <input type="file" name="foto" value="{{ old('foto') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Upload Foto</label><br>
                                                <input type="file" name="foto" value="{{ old('foto') }}" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="button">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
	        <div class="card mt-3">
                <div class="card-header">
                    <h3>Filter</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="search">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="search" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        @foreach ($priority as $item)
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="priority" value="{{ $item->id }}"
                                    @if (in_array($item->id, explode(',', request()->input('filter.priority'))))
                                        checked
                                    @endif 
                                />
                                <span>{{ $item->name }}</span><span class="checkmark"></span>
                        </label>
                    @endforeach
                    </div>
                    <div class="form-group">
                        <button id="filter" class="btn btn-primary">Filter</button>
                    </div>
                </div>
	        </div>
        </div>
	    <div class="col-md-9">
	        <section class="product-cart">
                <div class="row list-grid">
                    @forelse ($produk as $row)
                        <div class="list-item col-md-3">
                            <div class="card o-hidden mb-4 d-flex flex-column">
                                <div class="list-thumb d-flex"><img alt="" src="{{ asset('img/produk/' . $row->produk_image->image) }}" /></div>
                                <div class="flex-grow-1 d-bock">
                                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                        @role('inkubator')
                                        <a class="w-40 w-sm-100" href="{{ route('inkubator.detailProduk', $row->id) }}">
                                            <div class="item-title">
                                                {{ $row->title }}
                                            </div>
                                        </a>
                                        @endrole
                                        @role('mentor')
                                        <a class="w-40 w-sm-100" href="{{ route('mentor.detailProduk', $row->id) }}">
                                            <div class="item-title">
                                                {{ $row->title }}
                                            </div>
                                        </a>
                                        @endrole
                                        @role('tenant')
                                        <a class="w-40 w-sm-100" href="{{ route('tenant.detailProduk', $row->id) }}">
                                            <div class="item-title">
                                                {{ $row->title }}
                                            </div>
                                        </a>
                                        @endrole
                                        <p class="m-0 text-muted text-small w-15 w-sm-100">Harga Rp. {{ number_format($row->harga_jual,0,',','.') }}</p>
                                        <p class="m-0 text-muted text-small w-15 w-sm-100">{{ $row->tenant->title }}</p>
                                        @role('tenant')
                                            <a href="#" class="btn btn-sm btn-warning w-100 mt-3">UPDATE</a>
                                            <a href="{{ route('tenant.destroyProduk', $row->id) }}" class="btn btn-sm btn-danger w-100 mt-1">HAPUS</a>
                                        @endrole
                                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                            <span class="badge badge-info">{{ $row->priority->name }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h5>Belum ada produk</h5>
                    @endforelse
                    <div class="col-md-12 mt-3 ">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                {{ $produk->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
	    </div>
    </div>
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
			responsive:true
		});
    </script>
@endsection
