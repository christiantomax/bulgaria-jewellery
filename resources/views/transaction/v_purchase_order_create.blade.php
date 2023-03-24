@extends('v_main')

@section('title','Purchase Order')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Purchase Order</b></h1>
            </div>
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $datatanggal }}</i></b></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <a href="/transaction/po" class="btn btn-block btn-success"><b>
                    <i class="fa fa-arrow-left"></i>&nbsp Back</b></a>
            </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Add New Purchase Order</b></h2>
                <div class="col-3"><button onclick="refresh()" class="btn btn-block btn-success"><b>New Purchase Order</b></button></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="idpodescription">ID PO</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="idpodescription" placeholder="Purchase Order ID" readonly="">
                            <input type="hidden" id="idpo" name="idpo" value="{{$idpo}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="notasupplier">Nota Supplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="notasupplier" placeholder="Nota dari Supplier">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="exchangerate">Exchange Rate (Rp)<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                           <input type="number" class="form-control" id="exchangerate" placeholder="(Rp)">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="idsupplier">Suplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                            <select class="form-control" id="idsupplier" name="idsupplier">
                                <option value="">-- Select Supplier --</option>
                            @foreach($datasupplier as $row)
                                <option option value="{{ $row->id }}">{{ $row->IDSupplier }} - {{ $row->Nama }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="tanggaljatuhtempo">Jatuh Tempo</label>
                        <div class="col-sm-7">   
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" id="tanggaljatuhtempo" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for=""></label>
                        <div class="col-sm-7">   
                            <button id="addnewarticle" onclick="showaddnewarticle()" class="btn btn-block btn-primary"><b>Add Article</b></button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
    <div>
        <div class="collapse" id="collapseaddnewarticle">
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Article Detail</b></h2>
                <div class="col-3"></div>
            </div>
        </div>
            <div class="card-body">
                <div class="row form-horizontal" style="height:30vh;">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="upload-image-form">Gambar Barang<a style="color:red;">*</a></label>
                                <div class="col-sm-7">
                                    <img src="" class="img-fluid" id="output" style="max-height: 190px; width:200px; height: 200px; background-color: lightslategrey;">
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <form method="post" id="upload-image-form" enctype="multipart/form-data" accept="image/*">
                            @csrf
                            <div class="form-group">
                                <input type="file" id="file" accept="image/*" onchange="fileValidation()" class="form-control" >
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-12">
                            <hr>
                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="col-sm-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="articleallocation">Tipe Barang<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                                <select class="form-control" id="articletype" name="articletype">
                                    <option value="select">-- Select Article Type --</option>
                                        @foreach($dataarticletype as $row)
                                            <option value="{{ $row->IDArticleType }}">[{{ $row->KodeAwal }}] {{ $row->NamaJenisArticle }}</option>
                                        @endforeach
                                    </select>
                                    <div style="display: none;">
                                        <select class="form-control select2bs4allocation" id="articleallocation" name="articleallocation" >
                                            <option selected value="1">[GDNG] Gudang</option>
                                        </select>
                                    </div>
                                <!-- <input type="hidden" value="1" class="form-control" id="articleallocation" name="articleallocation"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="articlename">Nama Barang<a style="color:red;">*</a></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="articlename" placeholder="Nama Barang">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="articleweight">Berat<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="articleweight" placeholder="contoh: 3.8 g">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="articlepurchaseprice">Harga($)<a style="color:red;">*</a></label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="articlepurchaseprice" placeholder="(Rp)">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="kodebarangsupplier">Kode Barang Supplier<a style="color:red;">*</a></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="kodebarangsupplier" placeholder="Kode barang dari supplier">
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <div class="col-sm-1"></div>
                            <label class="col-sm-3 col-form-label">Stone Weight<a style="color:red;">*</a></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="articlekarat1">
                                </div>
                                <div class="col-sm-1" style="padding-top: 1%;">
                                    :
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="articlekarat2">
                                </div>
                                <div class="col-sm-1" style="padding-top: 1%;">
                                    <span>ct</span>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary" style="width:100%;" onclick="setKarat()">+</button>
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-11">
                                <textarea class="form-control" id="articlekarat" rows="8" style="text-align: right;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <button id="addRow" class="btn btn-block btn-primary"><b>Add Article</b></button>
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
                <div class="col-3"><button onclick="viewmodalpostdata()" id="simpanpo" class="btn btn-block btn-success" style="visibility: hidden;"><b>Simpan Purchase Order</b></button></div>
                <div class="col-9"></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="tabel-po">
                <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 10%">Nama Barang</th>
                        <th style="width: 10%">Tipe Barang</th>
                        <th style="width: 10%">Harga($)</th>
                        <th style="width: 5%">Berat</th>
                        <th style="width: 10%">Stone Weight</th>
                        <th style="width: 10%">Kode Barang Supplier</th>
                        <th style="width: 34%">Gambar Barang</th>
                        <th style="width: 5%">Edit</th>
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
                    <img class="img-fluid" id="outputmodalimage" class="img-fluid" alt="Responsive image">

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
                    <button type="button" onclick="refresh()" class="btn btn-default" data-dismiss="modal"><b>New Purchase Order</b></button>
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
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $('.select2bs4allocation').select2({
        theme: 'bootstrap4'
    })

    $('.select2bs4article').select2({
        theme: 'bootstrap4'
    })

        var datapost = [];
        var counter = 0;
        var totalharga = 0;
        var tempcountersplice = 0;
    $(document).ready(function() {
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
            if (showaddnewarticleDetail()) {
                var e = document.getElementById("articleallocation");
                var strAllocation = e.options[e.selectedIndex].text;
                var e = document.getElementById("articletype");
                var strArticleType = e.options[e.selectedIndex].text;
                t.row.add( [
                    (counter+1),
                    $('#articlename').val(),
                    strArticleType,
                    $('#articlepurchaseprice').val(),
                    $('#articleweight').val(),
                    $('#articlekarat').val(),
                    $('#kodebarangsupplier').val(),
                    '<img src="" class="img-fluid" id="outputimage'+counter+'" style="max-height: 190px; width:200px; height: 200px; background-color: lightslategrey;">',
                    '<button class="btn btn-success" onclick="editdatapost('+counter+')"><i class="nav-icon fas fa-edit"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+counter+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                adddatapost(strArticleType, strAllocation);
                counter++;
            }
            
        });
    } );
    // '<button class="btn btn-info" id="image'+counter+'" onclick="setimagearticle('+counter+')"><i class="nav-icon fas fa-image"></i></button>',
                    
    function adddatapost(strArticleType, strAllocation){
        datapost[counter] = {};
        datapost[counter]['articlename'] = $('#articlename').val();
        var e = document.getElementById("articletype");
        datapost[counter]['articletype'] = $('#articletype').val();
        datapost[counter]['articletypedescription'] = strArticleType;
        datapost[counter]['articleallocation'] = $('#articleallocation').val();
        datapost[counter]['articleallocationdescription'] = strAllocation;
        datapost[counter]['articlepurchaseprice'] = $('#articlepurchaseprice').val();
        datapost[counter]['articleweight'] = $('#articleweight').val() + " gr";
        datapost[counter]['articlekarat'] = $('#articlekarat').val();
        datapost[counter]['kodebarangsupplier'] = $('#kodebarangsupplier').val();
        datapost[counter]['articleimage'] = file.files[0];

        totalharga += (datapost[counter]['articlepurchaseprice']*$('#exchangerate').val());
        
        var image = document.getElementById('outputimage'+counter);
        image.src = URL.createObjectURL(datapost[counter]['articleimage']);

        $('#file').val("");
        $('#articleweight').val("");
        $('#articlename').val("");
        $('#articlepurchaseprice').val("");
        $('#articlekarat').val("");
        $('#kodebarangsupplier').val("");
        document.getElementById("output").src = "";
        
        document.getElementById('simpanpo').style.visibility = 'visible';
        document.getElementById("articletype").value = "select";
    }

    function deletedatapost(request){
        if(datapost.length-1 == 0){
            document.getElementById('simpanpo').style.visibility = 'hidden';
        }
        datapost[request]['articlename'] = "";
        var t = $('#tabel-po').DataTable();
        $('#tabel-po').dataTable().fnClearTable();
        $('#tabel-po').dataTable().fnDraw();
        var tempcounter = 0;
        var tempdatapost = [];
        for (var i = 0; i < counter; i++) {
            if (datapost[i]['articlename'] != "") {                
                t.row.add( [
                    (tempcounter+1),
                    datapost[i]['articlename'],
                    datapost[i]['articletypedescription'],
                    datapost[i]['articlepurchaseprice'],
                    datapost[i]['articleweight'],
                    datapost[i]['articlekarat'],
                    datapost[i]['kodebarangsupplier'],
                    '<img src="" class="img-fluid" id="outputimage'+tempcounter+'" style="max-height: 190px; width:200px; height: 200px; background-color: lightslategrey;">',
                    '<button class="btn btn-success" onclick="editdatapost('+(tempcounter)+')"><i class="nav-icon fas fa-edit"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+(tempcounter)+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                tempdatapost[tempcounter] = datapost[i];
                tempcounter++;
            }
            else{
                tempcountersplice = i;
                totalharga -= (datapost[i]['articlepurchaseprice']*$('#exchangerate').val());
            }
        }
        datapost.splice(tempcountersplice, 1);
        counter--;
        var image = null;
        for (var i = 0; i < counter; i++) {
            image = document.getElementById('outputimage'+i);
            image.src = URL.createObjectURL(datapost[i]['articleimage']);
        }
    }

    function editdatapost(request){
        $('#articlename').val(datapost[request]['articlename']);
        $('#articlepurchaseprice').val(datapost[request]['articlepurchaseprice']);
        $('#articleweight').val(datapost[request]['articleweight']);
        $('#articlekarat').val(datapost[request]['articlekarat']);
        $('#kodebarangsupplier').val(datapost[request]['kodebarangsupplier']);
        document.getElementById("articletype").value = datapost[request]['articletype'];

        deletedatapost(request);
    }

    function showaddnewarticleDetail(){
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
      
        // Allowing file type
        var allowedExtensions = 
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;


        var validationString = "";
        if ($('#articlename').val() == '' ){
            validationString += "[Nama Barang] ";
        }
        if ($('#articletype').val() == 'select'){
            validationString += "[Tipe Barang] ";
        }
        if ($('#articlepurchaseprice').val() == '' ){
            validationString += "[Harga($)] ";
        }
        if ($('#articleweight').val() == ''){
            validationString += "[Berat] ";
        }
        if ($('#articlekarat').val() == '' ){
            validationString += "[Stone Weight] ";
        }
        if ($('#kodebarangsupplier').val() == '' ){
            validationString += "[Kode Barang Supplier] ";
        }
        if ($('#file').val() == null || $('#file').val() == ""){
            validationString += "[Gambar Barang] ";
        }

        if(validationString != ""){
            $('#error-msg').html('Please check your data!<br>'+validationString);
            $('#create-error').modal('show');
            return false;
        }else if (!allowedExtensions.exec(filePath)) {
            $('#error-msg').html('Please check your article image');
            $('#create-error').modal('show');
            fileInput.value = null;
            return false;
        } else{
            return true;
        }

    }

    function showaddnewarticle(){
        
        var validationString = "";
        if ($('#idsupplier').val() == '' ){
            validationString += "[Suplier] ";
        }
        if ($('#exchangerate').val() == ''){
            validationString += "[Exchange Rate] ";
        }
        if ($('#notasupplier').val() == ''){
            validationString += "[Nota Supplier] ";
        }

        if(validationString != ""){
            $('#error-msg').html('Please check your data!<br>'+validationString);
            $('#create-error').modal('show');
        }else{
            $('#collapseaddnewarticle').collapse("show");
            document.getElementById('addnewarticle').style.visibility = 'hidden';
            document.getElementById('purchaseorderheader').remove();
            document.getElementById('simpanpo').style.visibility = 'visible';
            
            $('#idsupplier').prop('disabled', true);
            $('#exchangerate').prop('readonly', true);
            $('#notasupplier').prop('readonly', true);
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
            fd.append("idsupplier", $('#idsupplier').val());
            fd.append("idpo", $('#idpo').val());
            fd.append("tanggaljatuhtempo", $('#tanggaljatuhtempo').val());
            fd.append("notasupplier", $('#notasupplier').val());
            fd.append("exchangerate", $('#exchangerate').val());
            fd.append("articlename", datapost[i]['articlename']);
            fd.append("articletype", datapost[i]['articletypedescription'].slice(1, datapost[i]['articletypedescription'].indexOf("]") ));
            fd.append("articletypeid", datapost[i]['articletype']);
            fd.append("articleallocation", datapost[i]['articleallocation']);
            fd.append("articlepurchaseprice", datapost[i]['articlepurchaseprice']);
            fd.append("articleweight", datapost[i]['articleweight']);
            fd.append("articlekarat", datapost[i]['articlekarat']);
            fd.append("kodebarangsupplier", datapost[i]['kodebarangsupplier']);
            fd.append("file", datapost[i]['articleimage']);
            fd.append("status", "create");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "POST",
                url : "{{ route('createpo') }}",
                data: fd,
                contentType: false,
                processData: false,
                success:function(data){
                    console.log(data)
                    if(JSON.stringify(data).split('"').join('') == 'error'){
                        $('#create-validation').modal('hide');
                        $("#post_submit").attr("disabled", false);
                        $("#submit").attr("disabled", false);
                        $('#error-msg').html('There is an error...');
                        $('#create-error').modal('show');

                    }else{
                        $('#success-msg').html('Transaction ID : '+$('#idpo').val());
                        $('#idpodescription').val($('#idpo').val());
                        $('#create-validation').modal('hide');
                        $('#create-scd').modal('show');

                        $('#collapseaddnewarticle').collapse("hide");

                        $('#idsupplier').prop('disabled', true);
                        $('#tanggaljatuhtempo').prop('readonly', true);
                        $('#exchangerate').prop('readonly', true);
                        $('#notasupplier').prop('readonly', true);

                        $("#simpanpo").attr("disabled", true);
                        $("#addRow").attr("disabled", true);
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
                    "JudulAgenda" : "PO "+$('#idpo').val(),
                    "NoteAgenda" : "Total Bayar : "+totalharga,
                    "Status" : 1,
                },
                success:function(data){
                    console.log(data);
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

    function fileValidation() {
        var fileInput = document.getElementById('file');
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
            var imagea = document.getElementById('output');
            imagea.src = URL.createObjectURL(event.target.files[0]);
            return true;
        }
    }

    function setKarat(){
        var karat1 = $('#articlekarat1').val();
        var karat2 = $('#articlekarat2').val();
        var karatnow = $('#articlekarat').val();
        karat1 = karatnow + karat1 + " : " + karat2 + " ct\r\n";
        $('#articlekarat').val(karat1);
        
        $('#articlekarat1').val('');
        $('#articlekarat2').val('');
        document.getElementById("articlekarat1").focus();
    }

    $("#articlekarat2").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        setKarat();
        document.getElementById("articlekarat1").focus();
    }
});
</script>
@endsection