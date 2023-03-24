@extends('v_main')

@section('title','Custom Order')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Custom Order</b></h1>
            </div>
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $datatanggal }}</i></b></div>
            </div>
        </div>
        <div class="row" style="margin-top: 3%;">
            <div class="col-2">
                <a href="/transaction/co" class="btn btn-block btn-success"><b>
                    <i class="fa fa-arrow-left"></i>&nbsp Back</b></a>
            </div>
            <div class="col-7" style="margin-left: auto;"></div>
            <div class="col-3" style="margin-left: auto;">
                <form action="{{ route('printcoinv') }}" method="POST">
                @csrf
                <input type="hidden" name="nocoid" id="nocoid">
                <button id="print" type="submit" class="btn btn-block bg-gradient-info" formtarget="_blank"><b>
                <i class="fas fa-print"></i>&nbsp Print Invoice</b></a>
                </form>
            </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Add New Custom Order</b></h2>
                <!-- <div class="col-3"><button onclick="refresh()" class="btn btn-block btn-success"><b>New Custom Order</b></button></div> -->
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="idcodescription">ID CO</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="idcodescription" placeholder="Custom Order ID" readonly="">
                            <input type="hidden" id="idco" name="idco" value="{{$idco}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="idcustomer">Customer<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                            <select class="form-control select2bscustomer" id="idcustomer" name="idcustomer">
                                <option value="">-- Select Customer --</option>
                                @foreach($datacustomer as $row)
                                <option value="{{ $row->id }}">{{ $row->IDCustomer }} - {{ $row->Nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="customordertype">Order Type<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                            <select class="form-control select2bs4ordertype" id="customordertype" name="customordertype">
                                <option value="">-- Select Order Type --</option>
                                @foreach($datacotype as $row)
                                <option value="{{ $row->id }}">{{ $row->NamaJenisType }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="tanggaljatuhtempo">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-7">
                            <input type="date" id="tanggaljatuhtempo" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="downpayment">Downpayment</label>
                        <div class="col-sm-7">
                            <input type="number" min="0" value="0" class="form-control" id="downpayment" placeholder="Downpayment">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="customorderheader">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button id="addnewarticle" onclick="showaddnewarticle()" class="btn btn-block btn-primary"><b>Add Article</b></button>
                </div>
            </div>
    </div>
</div>
    <div>
        <div class="collapse" id="collapseaddnewarticle">
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Custom Order Detail</b></h2>
                <div class="col-3"></div>
            </div>
        </div>
            <div class="card-body">
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customorderHargaFinal">Harga<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderHargaFinal" value="0" placeholder="(Rp.)">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customorderSize">Size<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderSize" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customorderWeight">Weight<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderWeight" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customorderMetalType">Metal Type<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderMetalType" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customorderQuality">Quality<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderQuality" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customorderLaborCost">Labor Cost<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderLaborCost" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customorderGoldPrice">Gold Price<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customorderGoldPrice" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customorderNote">Note<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <textarea class="form-control" id="customorderNote" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customorderHargaFinal">Image<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                                <input type="file" id="file" onchange="fileValidation()" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-7">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <button id="addRow" class="btn btn-block btn-primary"><b>Add Custom Order Detail</b></button>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
    <br><div class="card elevation-2">
        <div class="card-header">
            <div class="row">
                <div class="col-3"><button onclick="viewmodalpostdata()" id="simpanpo" class="btn btn-block btn-success" style="visibility: hidden;"><b>Simpan Custom Order</b></button></div>
                <div class="col-9"></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="tabel-po">
                <thead>
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 10%">Order Type</th>
                        <th style="width: 10%">Harga</th>
                        <th style="width: 10%">Size</th>
                        <th style="width: 10%">Weight</th>
                        <th style="width: 10%">Metal Type</th>
                        <th style="width: 10%">Quality</th>
                        <th style="width: 10%">Labor Cost</th>
                        <th style="width: 10%">Gold Price</th>
                        <th style="width: 10%">Note</th>
                        <th style="width: 5%">Article Image</th>
                        <th style="width: 5%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

        <!-- Modal Validation -->
        <div class="modal fade" id="create-validation">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="validation-msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                    <button type="button" id="post_submit" class="btn btn-primary" onclick="postData()"><b>Submit</b></button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Show Image -->
        <div class="modal fade" id="create-image">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="create-image-header">Article Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" id="output" class="img-fluid" alt="Responsive image">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
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
                    <p id="success-msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="refresh()" class="btn btn-default" data-dismiss="modal"><b>New Custom Order</b></button>
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
    $('.select2bs4ordertype').select2({
        theme: 'bootstrap4'
    })

    $('.select2bscustomer').select2({
        theme: 'bootstrap4'
    })

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
        var datapost = {};
        var counter = 0;
        var totalharga = 0;
    $(document).ready(function() {
        document.getElementById("print").style.display = "none";

        var t = $('#tabel-po').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#addRow').on( 'click', function () {
            if (fileValidation() && showaddnewarticleDetail() && checkmax()) {
                var e = document.getElementById("customordertype");
                var strCustomOrderType = e.options[e.selectedIndex].text;
                t.row.add( [
                    (counter+1),
                    strCustomOrderType,
                    $('#customorderHargaFinal').val(),
                    $('#customorderSize').val(),
                    $('#customorderWeight').val(),
                    $('#customorderMetalType').val(),
                    $('#customorderQuality').val(),
                    $('#customorderLaborCost').val(),
                    $('#customorderGoldPrice').val(),
                    $('#customorderNote').val(),
                    '<button class="btn btn-info" id="image'+counter+'" onclick="setimagearticle('+counter+')"><i class="nav-icon fas fa-image"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+counter+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                adddatapost(strCustomOrderType);
                counter++;
            }

        } );
    } );

    function adddatapost(strCustomOrderType){
        datapost[counter] = {};
        datapost[counter]['customorderHargaFinal'] = $('#customorderHargaFinal').val();
        datapost[counter]['customordertype'] = $('#customordertype').val();
        datapost[counter]['customordertypedescription'] = strCustomOrderType;
        datapost[counter]['customorderSize'] = $('#customorderSize').val();
        datapost[counter]['customorderWeight'] = $('#customorderWeight').val();
        datapost[counter]['customorderMetalType'] = $('#customorderMetalType').val();
        datapost[counter]['customorderQuality'] = $('#customorderQuality').val();
        datapost[counter]['customorderLaborCost'] = $('#customorderLaborCost').val();
        datapost[counter]['customorderGoldPrice'] = $('#customorderGoldPrice').val();
        datapost[counter]['customorderNote'] = $('#customorderNote').val();
        datapost[counter]['articleimage'] = file.files[0];

        totalharga += parseInt($('#customorderHargaFinal').val());

        $('#file').val("");
        $('#customorderHargaFinal').val("");
        $('#customorderSize').val("");
        $('#customorderWeight').val("");
        $('#customorderMetalType').val("");
        $('#customorderQuality').val("");
        $('#customorderLaborCost').val("");
        $('#customorderGoldPrice').val("");
        $('#customorderNote').val("");

    }

    function setimagearticle(request){
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(datapost[request]['articleimage']);
        $('#create-image').modal('show');
    }

    function deletedatapost(request){
        totalharga -= parseInt(datapost[request]['customorderHargaFinal']);
        datapost[request]['customorderHargaFinal'] = null;
        var t = $('#tabel-po').DataTable();
        $('#tabel-po').dataTable().fnClearTable();
        $('#tabel-po').dataTable().fnDraw();
        var tempcounter = 0;
        var tempdatapost = {};
        for (var i = 0; i < counter; i++) {
            if (datapost[i]['customorderHargaFinal'] != null) {

                t.row.add( [
                    (i+1),
                    datapost[i]['customordertypedescription'],
                    datapost[i]['customorderHargaFinal'],
                    datapost[i]['customorderSize'],
                    datapost[i]['customorderWeight'],
                    datapost[i]['customorderMetalType'],
                    datapost[i]['customorderQuality'],
                    datapost[i]['customorderLaborCost'],
                    datapost[i]['customorderGoldPrice'],
                    datapost[i]['customorderNote'],
                    '<button class="btn btn-info" id="image'+(tempcounter)+'" onclick="setimagearticle('+(tempcounter)+')"><i class="nav-icon fas fa-image"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+(tempcounter)+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                tempdatapost[tempcounter] = datapost[i];
                tempcounter++;
            }
        }
        datapost = tempdatapost;
        counter--;


    }

    function showaddnewarticleDetail(){
        if($('#customorderHargaFinal').val() == '' || $('#customorderSize').val() == '' || $('#customorderWeight').val() == '' || $('#customorderMetalType').val() == '' || $('#customorderQuality').val() == '' || $('#customorderLaborCost').val() == '' || $('#customorderGoldPrice').val() == ''|| $('#customorderNote').val() == ''|| $('#file').val() == null){
            $('#error-msg').html('Please check your data detail!');
            $('#create-error').modal('show');

            return false;
        }else{
            return true;
        }

    }

    function showaddnewarticle(){
        if($('#idcustomer').val() == '' || $('#customordertype').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else{
            $('#idcustomer').prop('disabled', true);
            $('#customordertype').prop('disabled', true);
            $('#collapseaddnewarticle').collapse("show");
            document.getElementById('addnewarticle').style.visibility = 'hidden';
            document.getElementById('customorderheader').remove();
            document.getElementById('simpanpo').style.visibility = 'visible';
        }

    }

    function validate(){
        if(false){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else
            $('#create-validation').modal('show');
    }

    function viewmodalpostdata(){
        $('#validation-msg').html('Are you sure want to submit this data '+counter+' articles?');
        $('#create-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        for (var i = 0; i < counter; i++) {
            var fd = new FormData();
            fd.append("idcustomer", $('#idcustomer').val());
            fd.append("idco", $('#idco').val());
            fd.append("tanggaljatuhtempo", $('#tanggaljatuhtempo').val());
            fd.append("customordertype", $('#customordertype').val());
            fd.append("downpayment", $('#downpayment').val());
            fd.append("customorderHargaFinal", datapost[i]['customorderHargaFinal']);
            fd.append("customorderSize", datapost[i]['customorderSize']);
            fd.append("customorderWeight", datapost[i]['customorderWeight']);
            fd.append("customorderMetalType", datapost[i]['customorderMetalType']);
            fd.append("customorderQuality", datapost[i]['customorderQuality']);
            fd.append("customorderLaborCost", datapost[i]['customorderLaborCost']);
            fd.append("customorderGoldPrice", datapost[i]['customorderGoldPrice']);
            fd.append("customorderNote", datapost[i]['customorderNote']);
            fd.append("file", datapost[i]['articleimage']);
            fd.append("status", "create");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "POST",
                url : "{{ route('createco') }}",
                data: fd,
                contentType: false,
                processData: false,
                success:function(data){
                    if(JSON.stringify(data).split('"').join('') == 'error'){
                        $('#create-validation').modal('hide');
                        $("#post_submit").attr("disabled", false);
                        $("#submit").attr("disabled", false);
                        $('#error-msg').html('There is an error...');
                        $('#create-error').modal('show');

                    }else{
                        $('#success-msg').html('Transaction ID : '+$('#idco').val());
                        $('#idpodescription').val($('#idco').val());
                        $('#create-validation').modal('hide');
                        $('#create-scd').modal('show');

                        $('#collapseaddnewarticle').collapse("hide");

                        $('#idsupplier').prop('disabled', true);
                        $('#tanggaljatuhtempo').prop('readonly', true);
                        $('#exchangerate').prop('readonly', true);

                        $("#simpanpo").attr("disabled", true);
                        $("#addRow").attr("disabled", true);

                        document.getElementById("print").style.display = "block";
                        $('#nocoid').val($('#idco').val());
                    }
               }
            });
        }

        //post agenda
        if($('#tanggaljatuhtempo').val() != ""){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type : "POST",
                    url : "{{ route('createagenda') }}",
                    data : {
                        "TglMulai" : $('#tanggaljatuhtempo').val(),
                        "JudulAgenda" : "CO "+$('#idco').val(),
                        "NoteAgenda" : "Total Bayar : "+totalharga,
                        "Status" : 1,
                    },
                    success:function(data){
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
            }
    }

    function refresh(){
        window.location.reload();
    }

    function checkmax() {

        if (counter > 1) {
            $('#error-msg').html('maximum of data 1');
            $('#create-error').modal('show');
            fileInput.value = null;
            return false;
        }
            return true;
    }

    function fileValidation() {
        var fileInput =
            document.getElementById('file');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#error-msg').html('Please check your article image');
            $('#create-error').modal('show');
            fileInput.value = null;
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
@endsection
