@extends('v_main')

@section('title','Sales Order - Create')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Create Sales Order</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-2">
                <a href="/transaction/sales" class="btn btn-block btn-success"><b>
                    <i class="fa fa-arrow-left"></i>&nbsp Back</b></a>
            </div>
            <div class="col-4"></div>
            <div class="col-3" style="margin-left: auto;">
                <form action="{{ route('printSertif') }}" method="POST">
                @csrf
                <input type="hidden" name="nososertif" id="nososertif">
                <button id="sertif" type="submit" class="btn btn-block btn-warning" formtarget="_blank"><b>
                <i class="far fa-file"></i>&nbsp Print Certificate</b></a>
                </form>
            </div>
            <div class="col-3" style="margin-left: auto;">
                <form action="{{ route('printInv') }}" method="POST">
                @csrf
                <input type="hidden" name="nosoinv" id="nosoinv">    
                <button id="print" type="submit" class="btn btn-block bg-gradient-info" formtarget="_blank"><b>
                <i class="fas fa-print"></i>&nbsp Print Invoice</b></a>
                </form>
            </div>
        </div>

<br><section class="content">
<!-- <div class="container"> -->
<div class="row">
<!-- SO Card -->
<div class="col-md-4 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title" style="display: flex; align-items: center;"><b>Sales Order Card</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">SO No.</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="sono" placeholder="SO Number" disabled>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="nama">User Creator</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="User Name" value="{{ Auth::user()->NamaUser }}" disabled>
                    </div>
                </div>
            </div>

            <!-- <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">Invoice No.</label>
                    <div class="col-sm-8">
                    <input type="text" id="invno" class="form-control" placeholder="Invoice Number" disabled>
                    </div>
                </div>
            </div> -->

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">SO Date</label>
                    <div class="col-sm-8">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" id="sodate" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $tanggalso }}"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="note">Note</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="note" placeholder="Sales Order Note">-</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- SO Card -->

<!-- Customer Card -->
<div class="col-md-8 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Customer Card</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="customer">Customer</label>
            
            <div class="col-sm-8 col-8">
                <select class="form-control select2bs4" id="customer" style="width : 100%;">
                        <option value="null">-- Select Customer --</option>
                    @foreach($customer as $row)
                        <option value="{{ $row->IDCustomer }}">{{ $row->Nama }} | {{ $row->Telepon }} | {{ $row->BirthDate }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-sm-2 col-2">
                <a href="/customer/setup" class="btn btn-block btn-success"><b>+</b></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone No.</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" id="no1" value="-" disabled>
                    </div>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" id="no2" value="-" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" id="lahir" value="-" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" id="email" value="-" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" placeholder="-" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12"><p style="float: right;" id="loadingcust"><br></p></div>
        </div><br>
    </div>
</div>
</div>
<!-- Customer Card -->

</div><br>
<!-- </div> -->
<!-- Row Atas -->

<!-- Row Article -->
<div class="row">
<div class="col-md-12">
    <div class="card elevation-2">
        <div class="card-header">
            <div class="row">
                <h2 class="card-title" style="display: flex; align-items: center;"><b>Item Card</b></h2>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12" style="background-color: #dbdbdb; border-radius: 5px; padding: 1%;">
                <table id="table-article" class="table table-bordered" style="background: white;">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Item Code</th>
                            <th style="width: 25%;">Item Name</th>
                            <th style="width: 10%;">Gold Weight</th>
                            <th style="width: 20%;">Gold Carat</th>
                            <th style="width: 20%;">Final Price</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f7f7f7;">
                        <tr>
                            <td>
                                <input class="form-control" id="article" type="text">
                            </td>
                            <td id="artname">-</td>
                            <td id="berat">-</td>
                            <td id="karat">-</td>
                            <input type="hidden" id="cekartready" value="false">
                            <td>
                                <input type="number" id="hargafinal" class="form-control" step="0.1" min=0 value=0>
                            </td>
                        </tr>
                        <tr id="preview">
                            <td colspan="4"><label class="form-label" style="float: right;">Preview Image : </label></td>
                            <td>
                                <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <img src="" id="img-preview" alt="Article Image" style="width: 100%;">
                                </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-12">
                    <p style="float: right;" id="loading"><br></p>
                </div>
                <div class="col-7"></div>
                <div class="col-5">
                    <button id="submit" onclick="validate()" class="btn btn-block btn-primary"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

        <!-- Modal Validation -->
        <div class="modal fade" id="create-validation">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Customer -->
                    <div class="form-group row">
                        <label class="col-sm-4">Sell to customer</label>
                        <div class="col-sm-8"><p id="m-customer"></p></div>
                    </div>

                    <!-- Article -->
                    <div class="form-group row">
                        <label class="col-sm-4">Item</label>
                        <div class="col-sm-8"><p id="m-article"></p></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Preview Image</label>
                        <div class="col-sm-8"><img id="m-image" style="max-width: 50%;"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12"><h2 id="m-hargafinal" style="float: right;"></h2></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                    <button type="button" id="post_submit" class="btn btn-primary" onclick="postData()"><b>Submit</b></button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Error -->
        <div class="modal fade" id="create-error">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="error-msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Close</b></button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Success -->
        <div class="modal fade" id="create-scd">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Success</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="no_series"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Close</b></button>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('js')
<script> 
    $( document ).ready(function() {
        document.getElementById("sertif").style.display = "none";
        document.getElementById("print").style.display = "none";
        $('#preview').hide();
    });

    function refresh(){
        window.location.reload();
    }

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#customer').on('change', function() {
        if(this.value != "null"){
            $('#loadingcust').html('<b>Loading...</b>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "POST",
                url : "{{ route('getCustSO') }}",
                data : {
                    "kode" : this.value,
                },
                success:function(data){
                    $('#no1').val(JSON.stringify(data[0]['Telepon']).split('"').join(''));
                    $('#no2').val(JSON.stringify(data[0]['Telepon2']).split('"').join(''));
                    $('#lahir').val(JSON.stringify(data[0]['BirthDate']).split('"').join(''));
                    $('#email').val(JSON.stringify(data[0]['Email']).split('"').join(''));
                    $('#alamat').html(JSON.stringify(data[0]['Alamat']).split('"').join(''));
                    $('#loadingcust').html('<br>');
                }
            });
        }else{
            $('#no1').val('-');
            $('#no2').val('-');
            $('#lahir').val('-');
            $('#email').val('-');
            $('#alamat').html('-');
            $('#loadingcust').html('<br>');
        }
    });

    $('#article').on('input',function(e){
        $('#loading').html('<b>Loading...</b>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('getArticleSO') }}",
            data : {
                "kode" : this.value,
            },
            success:function(data){
                if(data != ""){
                    $('#cekartready').val("true");
                    $('#artname').html(JSON.stringify(data[0]['NamaArticle']).split('"').join(''));
                    $('#berat').html(JSON.stringify(data[0]['BeratEmas']).split('"').join('') + ' gr');
                    var karat = JSON.stringify(data[0]['Karat']).split('"').join('');
                    karat = karat.replace(/(?:\\[rn])+/g, "<br>");
                    $('#karat').html(karat);
                    $('#img-preview').attr('src', data[0]['Path']);
                    $('#preview').show();
                    $('#loading').html('<br>');
                }else{
                    $('#cekartready').val("false");
                    $('#artname').html('-');
                    $('#berat').html('-');
                    $('#karat').html('-');
                    $('#preview').hide();
                    $('#loading').html('<br>');
                }
            }
        });
    });

    function rupiah(price){
        price = parseFloat(price).toFixed(2);
        var bil_bulat = price.toString().split('.')[0];
        var koma = price.toString().split('.')[1];
        var reverse = bil_bulat.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
        var rp = 'Rp '+ribuan+','+koma;
        return rp;
    }

    function validate(){
        if($('#customer').val() == 'null' || $('#article').val() == '' || $('#cekartready').val() == "false" ||
            $('#hargafinal').val() < 0 || $('#note').val() == '' || $('#sodate').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else{
            $('#m-customer').html(': '+ $("#customer :selected").text() +
                '<br>&nbsp'+ $('#alamat').val());
            $('#m-article').html(': '+ $("#artname").html() + '&nbsp(' + $('#berat').html() 
                + ')<br>&nbsp'+ $('#karat').html());
            $('#m-image').attr('src', $('#img-preview').attr('src'));
            $('#m-hargafinal').html('Total : <b>'+ rupiah($('#hargafinal').val()) +'</b>');
            $('#create-validation').modal('show');
        }
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var idcus = $('#customer').val();
        var sodate = $('#sodate').val();
        var note = $('#note').val();
        var idart = $('#article').val();
        var hargafinal = $('#hargafinal').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('createSOPost') }}",
            data : {
                "idcus" : idcus,
                "sodate" : sodate,
                "note" : note,
                "idart" : idart,
                "hargafinal" : hargafinal,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#create-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#create-error').modal('show');
                }else if(JSON.stringify(data).split('"').join('') == 'so'){
                    $('#create-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is another active SO...');
                    $('#create-error').modal('show');
                }else if(JSON.stringify(data).split('"').join('') == 'lokasi'){
                    $('#create-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('Item location invalid...');
                    $('#create-error').modal('show');
                }else{
                    document.getElementById("sertif").style.display = "block";
                    document.getElementById("print").style.display = "block";

                    $('#sodate').attr("disabled", true);
                    $('#note').attr("disabled", true);
                    $('#customer').attr("disabled", true);
                    $('#article').attr("disabled", true);
                    $('#hargafinal').attr("disabled", true);

                    $('#create-validation').modal('hide');
                    $('#no_series').html('<b>SO No : </b>'+ JSON.stringify(data).split('"').join(''));
                    $('#sono').val(JSON.stringify(data).split('"').join(''));
                    $('#nososertif').val($('#sono').val());
                    $('#nosoinv').val($('#sono').val());

                    $('#create-scd').modal('show');
                }
           }
        });
    }
</script>
@endsection