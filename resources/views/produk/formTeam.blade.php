@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

<style type="text/css">
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }

    #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #673AB7;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #673AB7;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #311B92
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #673AB7;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #673AB7;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #673AB7
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 10%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #produk:before {
        font-family: FontAwesome;
        content: "\f13e"
    }

    #progressbar #bisnis:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #canvas:before {
        font-family: FontAwesome;
        content: "\f030"
    }

    #progressbar #image:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #kintel:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #riset:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #sertifikasi:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #ijin:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar #finish:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 0px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #673AB7
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }


    body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        .input-container {
          display: -ms-flexbox; /* IE10 */
          display: flex;
          width: 100%;
          margin-bottom: 15px;
        }

        .icon {
          padding: 10px;
          background: #673AB7;
          color: white;
          min-width: 50px;
          text-align: center;
        }

        .input-field {
          width: 100%;
          padding: 10px;
          outline: none;
        }

        .input-field:focus {
          border: 2px solid #673AB7;
        }

        .btn:hover {
          opacity: 1;
        }

        .dropdown-toggle{
                height: 40px;
                width: 400px !important;
            }
    </style>
@endsection

@section('content')
<div class="card-body">

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <table class="table table-boardered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Jabatan</th>
                        <th>Divisi</th>
                        <th>Tugas</th>
                        <th style="text-align: center"><a href=# class="btn btn-info addRow">+</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="user_id" class="form-control custom-select" required>
                                        <option value="">Pilih User</option>
                                        @foreach ($user_id as $row)
                                            <option value="{{ $row->user_id }}">{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="jabatan" class="form-control custom-select" required>
                                        <option value="0">Jabatan</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="divisi" class="form-control custom-select" required>
                                        <option value="0">Divisi</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-container">
                                <i class="fas fa-align-justify icon"></i>
                                <input class="form-control" name="tugas" type="text" placeholder="Tugas" />
                            </div>
                        </td>
                        <td style="text-align: center"><a href="#" class="btn btn-danger remove">-</a><td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.addRow').on('click', function(){
        addRow();
    });

    function addRow(){
        var tr =    '<tr>'+
                        '<td>'+
                            '<div class="form-group">'+
                                '<div class="input-group">'+
                                    '<select name="user_id" class="form-control custom-select" required>'+
                                        '<option value="">Pilih User</option>'+
                                        '@foreach ($user_id as $row)'+
                                            '<option value="{{ $row->user_id }}">{{ $row->nama }}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="form-group">'+
                                '<div class="input-group">'+
                                    '<select name="jabatan" class="form-control custom-select" required>'+
                                        '<option value="0">Jabatan</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="form-group">'+
                                '<div class="input-group">'+
                                    '<select name="divisi" class="form-control custom-select" required>'+
                                        '<option value="0">Divisi</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="input-container">'+
                                '<i class="fas fa-align-justify icon"></i>'+
                                '<input class="form-control" name="tugas" type="text" placeholder="Tugas" />'+
                            '</div>'+
                        '</td>'+
                        '<td style="text-align: center"><a href="#" class="btn btn-danger remove">-</a><td>'+
                    '</tr>';

            $('tbody').append(tr);
    };

    $('tbody').on('click', '.remove', function(){
        $(this).parent().parent().remove();
    });
</script>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
        $('.tahun').datepicker({dateFormat: 'yy'});

    });
</script>
<script type="text/javascript">
//tooltip
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

//multi step form
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});

CKEDITOR.replace( 'editor1' );
</script>
@endsection
