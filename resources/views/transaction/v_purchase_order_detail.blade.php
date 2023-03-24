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
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Purchase Order Detail</b></h2>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="idpodescription">ID PO</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="idpodescription" value="{{$datapoheader[0]->IDPO}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="idsupplier">Supplier</label>
                        <div class="col-sm-7">
                             
                            <input type="text" class="form-control" id="idsupplier" value="{{$datapoheader[0]->Supplier}}" readonly="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="notasupplier">Nota Supplier</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="notasupplier" value="{{$datapoheader[0]->NotaSupplier}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="purchasepricerupiah">Purchase Price Total ($)</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="purchasepricerupiah" value="{{$datapoheader[0]->TotalPurchasePriceDollar}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="purchasepricedollar">Purchase Price Total (Rp)</label>
                        <div class="col-sm-7">   
                            <input type="text" id="purchasepricedollar" class="form-control" value="{{$datapoheader[0]->TotalPurchasePriceRupiah}}" readonly=""> 

                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="exchangerate">Exchange Rate (Rp)</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="exchangerate" value="{{$datapoheader[0]->ExchangeRate}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="tanggaljatuhtempo">Due Date</label>
                        <div class="col-sm-7">   
                            <input type="text" id="tanggaljatuhtempo" class="form-control" value="{{$datapoheader[0]->TglJatuhTempo}}" readonly=""> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="users">User</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="users" value="{{$datapoheader[0]->users}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="create-at">Created At</label>
                        <div class="col-sm-7">   
                            <input type="text" id="create-at" class="form-control" value="{{$datapoheader[0]->created_at}}" readonly=""> 

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    
</div>
</div>
</div>
</section>
    <br><div class="card elevation-2">
        <div class="card-body">
            <table class="table table-bordered table-hover" id="tabel-po">
                <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 5%">Kode Barang</th>
                        <th style="width: 5%">Kode Barang Supplier</th>
                        <th style="width: 15%">Nama Barang</th>
                        <th style="width: 10%">Tipe Barang</th>
                        <th style="width: 5%">Harga ($)</th>
                        <th style="width: 5%">Harga (Rp.)</th>
                        <th style="width: 5%">Berat</th>
                        <th style="width: 10%">Stone Weight</th>
                        <th style="width: 29%">Barang Image</th>
                        <th style="width: 1%">Barcode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datapodetail as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 
                        <td>{{ $row->KodeArticle }}</td>
                        <td>{{ $row->KodeBarangSupplier }}</td>
                        <td>{{ $row->NamaArticle }}</td>
                        <td>{{ $row->NamaJenisArticle }}</td>
                        <td>{{ $row->HargaDollar }}</td>
                        <td>{{ $row->HargaRupiah }}</td>
                        <td>{{ $row->BeratEmas }}</td>
                        <td>{{ $row->Karat }}</td>
                        <td><img src="{{ $row->Path }}" class="img-fluid" style="max-height: 190px; width:200px; height: 200px; background-color: lightslategrey;"></td>
                        <td>
                            <form method="POST" action="{{ route('printArtKode') }}">
                                @csrf
                                <input type="hidden" name="kode" value="{{ $row->KodeArticle }}">
                                <button id="print" type="submit" class="btn btn-block bg-gradient-info" formtarget="_blank">
                                <i class="fas fa-print"></i>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
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
    </div>
</div>
</div>
@endsection

@section('js')
<script> 

        var datapost = {};
        var counter = 0;
        var totalharga = 0;
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
            if (fileValidation() && showaddnewarticleDetail()) {
                var e = document.getElementById("articleallocation");
                var strAllocation = e.options[e.selectedIndex].text;
                var e = document.getElementById("articletype");
                var strArticleType = e.options[e.selectedIndex].text;
                t.row.add( [
                    (counter+1),
                    $('#articlename').val(),
                    strArticleType,
                    strAllocation,
                    $('#articlepurchaseprice').val(),
                    $('#articleweight').val(),
                    $('#articlekarat').val(),
                    '<button class="btn btn-info" id="image'+counter+'" onclick="setimagearticle('+counter+')"><i class="nav-icon fas fa-image"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+counter+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                adddatapost(strArticleType, strAllocation);
                counter++;
            }
            
        } );
    } );

    function adddatapost(strArticleType, strAllocation){
        datapost[counter] = {};
        datapost[counter]['articlename'] = $('#articlename').val();
        var e = document.getElementById("articletype");
        datapost[counter]['articletype'] = $('#articletype').val();
        datapost[counter]['articletypedescription'] = strArticleType;
        datapost[counter]['articleallocation'] = $('#articleallocation').val();
        datapost[counter]['articleallocationdescription'] = strAllocation;
        datapost[counter]['articlepurchaseprice'] = $('#articlepurchaseprice').val();
        datapost[counter]['articleweight'] = $('#articleweight').val();
        datapost[counter]['articlekarat'] = $('#articlekarat').val();
        datapost[counter]['articleimage'] = file.files[0];

        totalharga += (datapost[counter]['articlepurchaseprice']*$('#exchangerate').val());

        // $('#articleweight').val("");
        // $('#articlename').val("");
        // $('#articlepurchaseprice').val("");
        // $('#articlekarat').val("");
    }

    function setimagearticle(request){
        document.getElementById("output").src = "http://127.0.0.1:8000"+request;
        $('#create-image').modal('show');
    }

    function deletedatapost(request){
        datapost[request]['articlename'] = null;
        var t = $('#tabel-po').DataTable();
        $('#tabel-po').dataTable().fnClearTable();
        $('#tabel-po').dataTable().fnDraw();
        var tempcounter = 0;
        var tempdatapost = {};
        for (var i = 0; i < counter; i++) {
            if (datapost[i]['articlename'] != null) {                
                t.row.add( [
                    (i+1),
                    datapost[i]['articlename'],
                    datapost[i]['articletypedescription'],
                    datapost[i]['articleallocationdescription'],
                    datapost[i]['articlepurchaseprice'],
                    datapost[i]['articleweight'],
                    datapost[i]['articlekarat'],
                    '<button class="btn btn-info" id="image'+(tempcounter)+'" onclick="setimagearticle('+(tempcounter)+')"><i class="nav-icon fas fa-image"></i></button>',
                    '<button class="btn btn-danger" onclick="deletedatapost('+(tempcounter)+')"><i class="nav-icon fas fa-trash-alt"></i></button>',
                ] ).draw( false );
                tempdatapost[tempcounter] = datapost[i];
                tempcounter++;
            }else{
                totalharga -= (datapost[i]['articlepurchaseprice']*$('#exchangerate').val());
            }
        }
        datapost = tempdatapost;
        counter--;    
        console.log(datapost);
    }

    function showaddnewarticleDetail(){
        if($('#articlename').val() == '' || $('#articletype').val() == '' || $('#articleallocation').val() == '' || $('#articlepurchaseprice').val() == '' || $('#articleweight').val() == '' || $('#articlekarat').val() == '' || $('#file').val() == null){
            $('#error-msg').html('Please check your data article detail!');
            $('#create-error').modal('show');
            return false;
        }else{
            return true;
        }

    }

    function showaddnewarticle(){
        if($('#idsupplier').val() == '' || $('#exchangerate').val() == 0){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else{
            $('#collapseaddnewarticle').collapse("show");
            document.getElementById('addnewarticle').style.visibility = 'hidden';
            document.getElementById('purchaseorderheader').remove();
            document.getElementById('simpanpo').style.visibility = 'visible';
            
            $('#idsupplier').prop('disabled', true);
            $('#exchangerate').prop('readonly', true);

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
            fd.append("exchangerate", $('#exchangerate').val());
            fd.append("articlename", datapost[i]['articlename']);
            fd.append("articletype", datapost[i]['articletypedescription'].slice(1, 4));
            fd.append("articletypeid", datapost[i]['articletype']);
            fd.append("articleallocation", datapost[i]['articleallocation']);
            fd.append("articlepurchaseprice", datapost[i]['articlepurchaseprice']);
            fd.append("articleweight", datapost[i]['articleweight']);
            fd.append("articlekarat", datapost[i]['articlekarat']);
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
                    "Status" : 0,
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