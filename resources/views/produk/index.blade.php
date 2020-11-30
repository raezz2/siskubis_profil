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
                            <input type="text" name="titles" id="title" class="form-control" placeholder="search" value="{{ $title != null ? $title : null }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        @foreach ($priority as $item)
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" name="filterByPriority" value="{{ $item->id }}"
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
                                <div class="list-thumb d-flex"><img alt="" src="{{ asset('img/produk/' . $row->produk_image->image ?? 'dummy.jpg') }}" /></div>
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
                                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                            <span class="badge badge-info">{{ $row->priority->name }}</span>
                                        </p>
                                    </div>
                                    <div class="card-footer p-0">
                                        @role('tenant')
                                            <div class="dropup">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle w-100" data-toggle="dropdown">
                                                    Option
                                                </button>
                                                <div class="dropdown-menu bg-primary w-100">
                                                    <a href="{{ route('tenant.editProduk', $row->id) }}" class="dropdown-item btn-primary w-100 text-white"><small class="font-weight-700">UPDATE</small></a>
                                                    <a href="{{ route('tenant.destroyProduk', $row->id) }}" class="dropdown-item btn-primary w-100 text-white delete"><small class="font-weight-bolder">HAPUS</small></a>
                                                </div>
                                            </div>
                                            <!-- <button class="btn btn-primary btn-block w-100" id="with-timer" type="button">Option</button> -->
                                            <!-- <button type="button" class="btn btn-primary btn-block w-100" data-toggle="modal" data-target="#myModal">
                                                Option
                                            </button>
                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">OPTION</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <a href="{{ route('tenant.editProduk', $row->id) }}" class="dropdown-item btn-warning">UPDATE</a>
                                                            <a href="{{ route('tenant.destroyProduk', $row->id) }}" class="dropdown-item btn-danger">HAPUS</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        @endrole
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
        $(function() {
            function getIds(checkboxName) {
                let checkBoxes = document.getElementsByName(checkboxName);
                let ids = Array.prototype.slice.call(checkBoxes)
                                .filter(ch => ch.checked==true)
                                .map(ch => ch.value);
                return ids;
            }
            function filterResults () {
                let priorityIds = getIds("filterByPriority");
                let title = $('input[name="titles"]').val();
                let href = 'produk?';
                if(priorityIds.length) {
                    href += 'filter[priority]=' + priorityIds;
                }
                if(title !== ""){
                    href += '&filter[title]=' + title;
                }
                console.log(href);
                document.location.href=href;
            }
        document.getElementById("filter").addEventListener("click", filterResults);
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif

        $('.delete').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apa Anda Yakin Menghapus ?',
                type: 'warning',
                showCancelButton:true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Hapus',
                cancelButtontext: 'Batal',
                confirmButtonClass: 'btn btn-success mr-5',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function(value){
                if (value){
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection
