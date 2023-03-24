@extends('v_main')

@section('title','Supplier - Update')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Supplier Update</b></h1>
        </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <input type="hidden" id="idu" value="{{ $datasupplier->id }}">
            <h1 class="card-title" style="display: flex; align-items: center;">
                <b>{{ $datasupplier->IDSupplier }}</b></h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button onclick="del()" id="delete" class="btn btn-block btn-danger"><i class="fas fa-trash"></i> &nbsp<b>Delete</b></button>
                </div>
            </div><br>
            <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="kode">Supplier ID</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode" placeholder="Supplier ID" disabled value="{{ $datasupplier->IDSupplier }}">
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
                        <input type="text" class="form-control" id="suppliercode" placeholder="Kode Supplier" value="{{ $datasupplier->Kode }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="suppliernama">Nama Suplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliernama" placeholder="Nama Supplier" value="{{ $datasupplier->Nama }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="suppliertelepon">Telepon 1<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliertelepon" placeholder="Telepon 1" value="{{ $datasupplier->Telepon }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="suppliertelepon2">Telepon 2</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="suppliertelepon2" placeholder="Telepon 2" value="{{ $datasupplier->Telepon2 }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
            <div class="col-sm-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="supplieremail">Email<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="email" class="form-control" id="supplieremail" placeholder="Email" value="{{ $datasupplier->Email }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="supplieralamat">Alamat Suplier<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <textarea class="form-control" id="supplieralamat" placeholder="Alamat Suplier">{{ $datasupplier->Alamat }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="creator">Creator / Updater</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="creator" value="{{ $datasupplier->Maker }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="note">{{ $datasupplier->Note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Button -->
            <br><div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <button id="submit" onclick="validate()" class="btn btn-block btn-primary"><b>Update</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</section>

        <!-- Modal Validation -->
        <div class="modal fade" id="update-validation">
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

         <!-- Modal Reset -->
         <div class="modal fade" id="reset-validation">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to reset password?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                    <button type="button" id="post_reset" class="btn btn-primary" onclick="resetPost()"><b>Reset</b></button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="delete-validation">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                    <button type="button" id="post_delete" class="btn btn-primary" onclick="delPost()"><b>Delete</b></button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Error -->
        <div class="modal fade" id="update-error">
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
        <div class="modal fade" id="update-scd">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Update data success!</p>
                </div>
                <div class="modal-footer">
                    <a href="/user/setup" class="btn btn-default"><b>Close</b></a>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Success -->
        <div class="modal fade" id="delete-scd">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Delete data success!</p>
                </div>
                <div class="modal-footer">
                    <a href="/user/setup" class="btn btn-default"><b>Close</b></a>
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
            $('#update-error').modal('show');
        }else
            $('#update-validation').modal('show');
    }

    function del(){
        if($('#customernama').val() == '' || $('#customeralamat').val() == 0 || 
        $('#customertelepon').val() == '' || $('#customeremail').val() == ''|| $('#note').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#update-error').modal('show');
        }else{
            $('#delete-validation').modal('show');
        }
    }

    function delPost(){
        $("#post_delete").attr("disabled", true);
        $("#delete").attr("disabled", true);

        var idu = $('#idu').val();
        var note = $('#note').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('delSupplier') }}",
            data : {
                "idu" : idu,
                "note" : note,
            },
            success:function(data){
                alert(data);
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#delete-validation').modal('hide');
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#delete-validation').modal('hide');
                    $('#delete-scd').modal('show');
                    window.location.href = "/supplier/setup";
                }
           }
        });
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#suppliernama').val();
        var kode = $('#suppliercode').val();
        var alamat = $('#supplieralamat').val();
        var telepon = $('#suppliertelepon').val();
        var telepon2 = $('#suppliertelepon2').val();
        var email = $('#supplieremail').val();
        var note = $('#note').val();
        var idsupplier = $('#kode').val();
        var id = $('#idu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateSupplierPost') }}",
            data : {
                "nama" : nama,
                "kode" : kode,
                "alamat" : alamat,
                "telepon" : telepon,
                "telepon2" : telepon2,
                "email" : email,
                "note" : note,
                "idu" : id,
                "idsupplier" : idsupplier,
                "status" : status,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#update-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }
                else{
                    $('#update-validation').modal('hide');
                    $('#update-scd').modal('show');
                    window.location.href = "/supplier/setup";
                }
           }
        });
    }
</script>
@endsection