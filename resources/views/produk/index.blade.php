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
                        <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#formProduk">
                            + Tambah Produk
                        </button>
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
                                                <input class="form-control" type="text" placeholder="Nama produk...." />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Harga...." />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" id="exampleInputPassword1" type="text" placeholder="phone...." />
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="notes...."></textarea>
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
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="priority" value="2"><span>Pra Start Up</span><span class="checkmark"></span>
                        </label>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="priority" value="1"><span>Proposal</span><span class="checkmark"></span>
                        </label>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="priority" value="4"><span>Scale Up</span><span class="checkmark"></span>
                        </label>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="priority" value="3"><span>Start Up</span><span class="checkmark"></span>
                        </label>
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
                                    <a class="w-40 w-sm-100" href="{{ route('inkubator.detailProduk', $row->id) }}">
                                        <div class="item-title">
                                            {{ $row->title }}
                                        </div>
                                    </a>
                                    <p class="m-0 text-muted text-small w-15 w-sm-100">Harga Rp. {{ $row->harga_jual }}</p>
                                    <p class="m-0 text-muted text-small w-15 w-sm-100">{{ $row->tenant->title }}</p>
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