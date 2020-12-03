@extends('layouts.app')
@section('content')
<div class="row">
    <!-- ICON BG-->
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Add-User"></i>
                <div class="col-md-12">
                <h5><b><p class="text-important">Penghasilan</p></b></h5>
                    <p class="text-important">{{"Rp " . number_format($masuk_labaRugi,2,',','.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Financial"></i>
                <div class="col-md-12">
                <h5><b><p class="text-important">Beban</p></b></h5>
                    <p class="text-important">{{"Rp ". number_format($keluar_labaRugi,2,',','.') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Money-2"></i>
            <div class="col-md-12">
                <h5><b><p class="text-important">Laba Bersih Akhir</p></b></h5>
                    <p class="text-important">{{"Rp " . number_format($laba_bersih,2,',','.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <!-- <div class="card-title">Grafik Keuangan Seluruh Tenant</div> -->
                <div id="chartKeuangan" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-3">
        {{-- Menu Filter --}}
        @role(['inkubator', 'mentor'])
        <div class="card mb-4">
			<div class="card-header container-fluid">
			  <div class="row">
				<div class="col">
				  <h4>Filter</h4>
				</div>
			  </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                <label for="tenant">Filter Bulan</label>
                    <!-- <input type="month" class="form-control" id="tag_select" name="month"/> -->
                    <select style="cursor:pointer;margin-bottom:1.5em;" class="form-control" id="tag_select" name="month">
                        <option value="0" selected disabled> Pilih Bulan</option>
                        <option value="01"> Januari</option>
                        <option value="02"> Februari</option>
                        <option value="03"> Maret</option>
                        <option value="04"> April</option>
                        <option value="05"> Mei</option>
                        <option value="06"> Juni</option>
                        <option value="07"> Juli</option>
                        <option value="08"> Agustus</option>
                        <option value="09"> September</option>
                        <option value="10"> Oktober</option>
                        <option value="11"> November</option>
                        <option value="12"> Desember</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="tenant">Filter Tehun</label>
                    <select style="cursor:pointer;margin-bottom:1.5em;" class="form-control" id="tag_select" name="year">
                        <option value="0" selected disabled> Pilih Tahun</option>
                        <?php 
                        $year = date('Y');
                        $min = $year - 60;
                        $max = $year;
                        for( $i=$max; $i>=$min; $i-- ) {
                        echo '<option value='.$i.'>'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tenant">Filter Tenant</label>
                    @foreach ($tenant as $item)
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="tenant" value="{{ $item->id }}"
                                @if (in_array($item->id, explode(',', request()->input('filter.tenant'))))
                                    checked
                                @endif/><span>{{ $item->title }}</span><span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>
                <div class="form-group">
                    <button id="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>        
        </div>
        @endrole
	</div>
	<div class="col-md-9">
        <div id="task-manager-list">
            <!--  content area -->
            <div class="content"> 
                <!--  task manager table -->
                <div class="card" id="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table" id="names" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="30%">Penghasilan</th>
                                        <th width="30%">Beban Usaha</th>
                                        <!-- <th width="10%">Tanda Bukti</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($labaRugi as $b)
                                    <tr>
                                        <td>
                                            {{ date('d F Y', strtotime($b->tanggal)) }}
                                        </td>
                                        <td>
                                            <p>{{ $b->keterangan }}</p>
                                        </td>
                                        <td>
                                            @if($b->jenis == 1)
                                            {{ "Rp " . number_format($b->jumlah,2,',','.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($b->jenis == 0)
                                            {{ "Rp " . number_format($b->jumlah,2,',','.') }}
                                            @endif
                                        </td>
                                        <!-- <td>
                                            <img src="{{ asset('img/keuangan/'. $b->foto ) }}" width="150" height="100" alt="">
                                        </td> -->
                                    </tr>
                                @endforeach       
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><b>
                                                <h5>Jumlah Beban Usaha</h5>
                                            </b></td>
                                        <td><b>{{"Rp " . number_format($masuk_labaRugi,2,',','.') }}</b></td>
                                        <td><b>{{"Rp " . number_format($keluar_labaRugi,2,',','.') }}</b></td>
                                        <!-- <td></td> -->
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                        <b>
                                            <h5>Laba Bersih</h5>
                                        </b>
                                        </td>
                                        <td><b>{{"Rp " . number_format($totalLaba,2,',','.') }}</b></td>
                                        <!-- <td></td> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end of task manager table -->
            </div>
            <!--  end of content area -->
        </div>
    </div>
    @role('inkubator')
    <!-- Modal -->
    @endrole
</div>
<div class="row">
    <div class="card">
        {{-- <div class="card-body">{{ $between }}</div> --}}
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('theme/css/plugins/datatables.min.css')}}" />
<link href="{{ asset('theme/css/plugins/toastr.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('theme/css/plugins/sweetalert2.min.css')}}" /> 
<style>
  .container{
    margin-top:20px;
  }
  .image-preview-input {
    position: relative;
  overflow: hidden;
  margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
  }
  .image-preview-input input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
  }
  .image-preview-input-title {
    margin-left:2px;
  }
  .laba{
    margin: auto;
    display: flex;
    flex-direction: column;
  }
</style>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{ asset('theme/js/scripts/datatables.script.min.js')}}"></script>
<script src="{{ asset('theme/js/plugins/toastr.min.js')}}"></script>
<script src="{{ asset('theme/js/script/toastr.script.min.js')}}"></script>
<script src="{{ asset('theme/js/plugins/sweetalert2.min.js')}}"></script>
<script src="{{ asset('theme/js/scripts/sweetalert2.script.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

    $(function () {
        @if(Session::has('errors'))
            $('#inputModal').modal('show');
        @endif
        $('#names').DataTable(
            {
                "pagingType": "numbers",
                @role('tenant')
                "searching": true,
                @endrole
                @role(['mentor', 'inkubator'])
                "searching": false,
                @endrole
                "scrollX": true
            }
        );
    });
    
    // $('#btnModal').on('click', function(){
    //     $('#inputModal').modal('show');
    // });
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'right',
            autoUpdateInput: false,
            @role(['inkubator', 'mentor'])
            @endrole
            locale: {
            cancelLabel: 'Clear'
            },
        }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

    function getIds(checkboxName) {
        let checkBoxes = document.getElementsByName(checkboxName);
        let ids = Array.prototype.slice.call(checkBoxes)
                        .filter(ch => ch.checked==true)
                        .map(ch => ch.value);
        return ids;
    }

    function filterResults () {
        let tenantIds = getIds("tenant");
        let bulan = $('select[name="month"]').val();
        let tahun = $('select[name="year"]').val();
        let href = 'laba-rugi?';

        if(tenantIds.length) {
            href += 'filter[tenant]=' + tenantIds;
        }
        if(bulan !== null) {
            href += '&filter[bulan]=' + bulan;
        }
        if(tahun !== null) {
            href += '&filter[tahun]=' + tahun;
        }
        console.log(href);

        document.location.href=href;
    }

    document.getElementById("filter").addEventListener("click", filterResults);

    toastr.options = {
        "debug": false,
        //   "positionClass": "toast-bottom-full-width",
        "onclick": null,
        "showMethod": "slideDown",
        "hideMethod": "slideUp",
        "timeOut": 2000,
        "extendedTimeOut": 1000
    }
</script>
<script>
        var labaMasuk = <?php echo json_encode($labaMasuk)?>;
        var labaKeluar = <?php echo json_encode($labaKeluar)?>;
        var totalLabaBersih = <?php echo json_encode($totalLabaBersih)?>;
        Highcharts.chart('chartKeuangan', {
            chart: {
                type: 'column'
			},
			legend: {
				borderRadius: 0,
				x: 'right',
				data: ['Arus Kas', 'Laba Rugi']
			},
            title: {
                @role('mentor')
                text: 'Grafik Laba Rugi Tenant yang dibimbing'
                @endrole
                @role('inkubator')
                text: 'Grafik Laba Rugi Seluruh Tenant'
                @endrole
            },
			grid: {
				left: '8px',
				right: '8px',
				bottom: '0',
				containLabel: true
			},
            xAxis: {
                categories: {!! json_encode($categories) !!},
			},
            yAxis: {
				min: 0,
				interval: 10000,
				axisLine: {
					show: false
				},
                title: {
                    text: 'Jumlah Keuangan'
                }
            },
			series: [{
				name: 'Penghasilan',
				data: labaMasuk,
				label: {
					show: false,
					color: '#0168c1'
				},
				barGap: 0,
				color: '#9400D3',
				smooth: true,
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowOffsetY: -2,
						shadowColor: 'rgba(0, 0, 0, 0.3)'
					}
                }
            },{
				name: 'Beban Usaha',
				data: labaKeluar,
				label: {
					show: false,
					color: '#0168c1'
				},
				barGap: 0,
				color: '#8B008B',
				smooth: true,
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowOffsetY: -2,
						shadowColor: 'rgba(0, 0, 0, 0.3)'
					}
				}
			},{
				name: 'Laba Bersih',
				data: totalLabaBersih,
				label: {
					show: false,
					color: '#0168c1'
				},
				barGap: 0,
				color: '#4B0082',
				smooth: true,
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowOffsetY: -2,
						shadowColor: 'rgba(0, 0, 0, 0.3)'
					}
				}
			}]
        });
</script>
@endsection
