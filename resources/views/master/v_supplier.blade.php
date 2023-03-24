@extends('v_main')

@section('title','Supplier - Setup')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Setup Supplier</b></h1>
        </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Add New Supplier</b></h2>
                <div class="col-3"><button onclick="refresh()" class="btn btn-block btn-success"><b>New Supplier</b></button></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="kode">Supplier ID</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode" placeholder="Supplier ID" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="suppliercode">Kode Supplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliercode" placeholder="Kode Supplier">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="suppliernama">Nama Suplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliernama" placeholder="Nama Suplier">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="suppliertelepon">Telepon 1<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliertelepon" placeholder="Telepon 1">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="suppliertelepon2">Telepon 2</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliertelepon2" placeholder="Telepon 2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
            <div class="col-sm-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="supplieremail">Email<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="email" class="form-control" id="supplieremail" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="supplieralamat">Alamat Suplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <textarea class="form-control" id="supplieralamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
            <div class="col-sm-6">
                
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <a style="color:red;font-weight: bold;">* Mohon mengisi kode supplier dengan 3 karakter</a>
                </div>
                <div class="col-sm-3">
                    <button id="submit" onclick="validate()" class="btn btn-block btn-primary"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<br><div class="card elevation-2">
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-user">
            <thead>
                <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 10%">ID suplier</th>
                    <th style="width: 5%">Kode Suplier</th>
                    <th style="width: 15%">Nama Suplier</th>
                    <th style="width: 10%">Telepon</th>
                    <th style="width: 10%">Telepon</th>
                    <th style="width: 15%">Email</th>
                    <th style="width: 25%">Alamat Suplier</th>
                    <th style="width: 5%">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datasupplier as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $row->IDSupplier }}</td>
                    <td>{{ $row->Kode }}</td>
                    <td>{{ $row->Nama }}</td>
                    <td>{{ $row->Telepon }}</td>
                    <td>{{ $row->Telepon2 }}</td>
                    <td>{{ $row->Email }}</td>
                    <td>{{ $row->Alamat }}</td>
                    <td><a href="/supplier/update/{{ $row->id }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
</div>

</div>
</div>
</section>

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
                    <p>Are you sure want to submit this data?</p>
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
                    <p>Success!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="refresh()" class="btn btn-default" data-dismiss="modal"><b>Close</b></button>
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
    $ ( function () {
        $('#tabel-user').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })

    function refresh(){
        window.location.reload();
    }

    function validate(){
	const isAllowedSupplierCode = [3,4,5];
        var validationString = "";
        if ($('#suppliernama').val() == '' ){
            validationString += "[Nama] ";
        }
        if ($('#suppliercode').val() == '' || !(isAllowedSupplierCode.includes($('#suppliercode').val().length))){
            validationString += "[Kode Suplier] ";
        }
        if ($('#supplieralamat').val() == '' ){
            validationString += "[Alamat] ";
        }
        if ($('#suppliertelepon').val() == '' ){
            validationString += "[Telepon] ";
        }
        if ($('#supplieremail').val() == '' ){
            validationString += "[Email] ";
        }
        if(validationString != ""){
            $('#error-msg').html('Please check your data!<br>'+validationString);
            $('#create-error').modal('show');
        }else
            $('#create-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#suppliernama').val();
        var alamat = $('#supplieralamat').val();
        var kode = $('#suppliercode').val();
        var telepon = $('#suppliertelepon').val();
        var telepon2 = $('#suppliertelepon2').val();
        if(telepon2 == ""){
            telepon2 = " ";
        }
        var email = $('#supplieremail').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('createsupplier') }}",
            data : {
                "nama" : nama,
                "kode" : kode,
                "alamat" : alamat,
                "telepon" : telepon,
                "telepon2" : telepon2,
                "email" : email,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#create-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#create-error').modal('show');
                }else{
                    $('#kode').val(JSON.stringify(data).split('"').join(''));
                    $('#create-validation').modal('hide');
                    $('#create-scd').modal('show');
                }
           }
        });
    }
</script>
@endsection