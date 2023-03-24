@extends('v_main')

@section('title','Customer - Update')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Customer Update</b></h1>
        </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <input type="hidden" id="idc" value="{{ $datacustomer->id }}">
            <input type="hidden" id="kode" value="{{ $datacustomer->IDCustomer }}">
            <h1 class="card-title" style="display: flex; align-items: center;">
                <b>{{ $datacustomer->IDCustomer }} - {{ $datacustomer->Nama }}</b></h1>
        </div>
        <div class="card-body">
            @if(Auth::user()->IDLevel == 1 || Auth::user()->IDLevel == 2)
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button onclick="del()" id="delete" class="btn btn-block btn-danger"><i class="fas fa-trash"></i> &nbsp<b>Delete</b></button>
                </div>
            </div><br>
            @endif
            <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="kode">Customer ID</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode" placeholder="Customer ID" disabled value="{{ $datacustomer->IDCustomer }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customernama">Nama<a style="color:red;">*</a></label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customernama" placeholder="Nama Customer" value="{{ $datacustomer->Nama }}">
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                    
                    <div class="form-group row">  
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-7">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" placeholder="Tanggal Lahir" id="lahir" value="{{ $datacustomer->BirthDate }}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="customertelepon">Telepon 1<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="customertelepon" placeholder="Telepon 1" value="{{ $datacustomer->Telepon }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customertelepon2">Telepon 2</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customertelepon2" placeholder="Telepon 2" value="{{ $datacustomer->Telepon2 }}">
                            </div>
                        </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customeralamat">Alamat<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <textarea class="form-control" id="customeralamat" placeholder="Address">{{ $datacustomer->Alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="creator">Creator / Updater</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="creator" value="{{ $datacustomer->Maker }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customeremail">Email</label>
                            <div class="col-sm-7">
                            <input type="email" class="form-control" id="customeremail" placeholder="Email" value="{{ $datacustomer->Email }}">
                            </div>
                        </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="note">{{ $datacustomer->Note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            @if(Auth::user()->IDLevel == 1 || Auth::user()->IDLevel == 2)
            <!-- Button -->
            <br><div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button id="submit" onclick="validate()" class="btn btn-block btn-primary"><b>Update</b></button>
                </div>
            </div>
            @endif
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
                    <p>Are you sure want to delete customer?</p>
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
                    <a href="/customer/setup" class="btn btn-default"><b>Close</b></a>
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
                    <a href="/customer/setup" class="btn btn-default"><b>Close</b></a>
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

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    function validate(){
        if($('#customernama').val() == '' || $('#customeralamat').val() == 0 ||
        $('#customertelepon').val() == '' ){
            $('#error-msg').html('Please check your data!');
            $('#update-error').modal('show');
        }else{
            $('#update-validation').modal('show');
        }
        
    }

    function del(){
        if($('#customernama').val() == '' || $('#customeralamat').val() == 0 || $('#lahir').val() == '' ||
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

        var idc = $('#idc').val();
        var note = $('#note').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('delCustomer') }}",
            data : {
                "idc" : idc,
                "note" : note,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#delete-validation').modal('hide');
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#delete-validation').modal('hide');
                    $('#delete-scd').modal('show');
                    window.location.href = "/customer/setup";
                }
           }
        });
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#customernama').val();
        var alamat = $('#customeralamat').val();
        var telepon = $('#customertelepon').val();
        var telepon2 = $('#customertelepon2').val();
        var email = $('#customeremail').val();
        var note = $('#note').val();
        var idc = $('#idc').val();
        var kode = $('#kode').val();
        var lahir =  $('#lahir').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateCustomerPost') }}",
            data : {
                "nama" : nama,
                "alamat" : alamat,
                "telepon" : telepon,
                "telepon2" : telepon2,
                "email" : email,
                "note" : note,
                "idc" : idc,
                "status" : status,
                "kode" : kode,
                "lahir" : lahir,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#update-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#update-validation').modal('hide');
                    $('#update-scd').modal('show');
                    window.location.href = "/customer/setup";
                }
           }
        });
    }
</script>
@endsection