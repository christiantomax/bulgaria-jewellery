@extends('v_main')

@section('title','Customer - Setup')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Setup Customer</b></h1>
        </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Add New Customer</b></h2>
                <div class="col-3"><button onclick="refresh()" class="btn btn-block btn-success"><b>New Customer</b></button></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="kode">Customer ID</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode" placeholder="Customer ID" disabled>
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
                            <input type="text" class="form-control" id="customernama" placeholder="Nama Customer">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">  
                    <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" placeholder="Tanggal Lahir" id="lahir" class="form-control datetimepicker-input" data-target="#reservationdate"/>
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
                        <input type="text" class="form-control" id="customertelepon" placeholder="Telepon 1">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customertelepon2">Telepon 2</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="customertelepon2" placeholder="Telepon 2">
                            </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="customeralamat">Alamat<a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <textarea class="form-control" id="customeralamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="customeremail">Email</label>
                        <div class="col-sm-7">
                        <input type="email" class="form-control" id="customeremail" placeholder="Email">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="customernote">Note</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" id="customernote" placeholder="Note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button id="submit" onclick="validate()" class="btn btn-block btn-primary"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<br><div class="card elevation-2">
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-customer">
            <thead>
                <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 15%">ID Customer</th>
                    <th style="width: 15%">Nama</th>
                    <th style="width: 10%">Telepon</th>
                    <th style="width: 10%">Telepon2</th>
                    <th style="width: 15%">Email</th>
                    <th style="width: 25%">Alamat</th>
                    <th style="width: 5%">Rubah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datacustomer as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $row->IDCustomer }}</td>
                    <td>{{ $row->Nama }}</td>
                    <td>{{ $row->Telepon }}</td>
                    <td>{{ $row->Telepon2 }}</td>
                    <td>{{ $row->Email }}</td>
                    <td>{{ $row->Alamat }}</td>
                    <td><a href="/customer/update/{{ $row->id }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i></button></td>
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
        $('#tabel-customer').DataTable({
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

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    function validate(){
        var validationString = "";
        if ($('#customernama').val() == '' ){
            validationString += "[Nama] ";
        }
        if ($('#customeralamat').val() == ''){
            validationString += "[Alamat] ";
        }
        if ($('#customertelepon').val() == '' ){
            validationString += "[Telepon] ";
        }

        if(validationString != ""){
            $('#error-msg').html('Please check your data!<br>'+validationString);
            $('#create-error').modal('show');
        }else
            $('#create-validation').modal('show');
    }

    function postData(){
        // $("#post_submit").attr("disabled", true);
        // $("#submit").attr("disabled", true);

        var nama = $('#customernama').val();
        var alamat = $('#customeralamat').val();
        var telepon = $('#customertelepon').val();
        var telepon2 = $('#customertelepon2').val();
        var email = $('#customeremail').val();
        var lahir = $('#lahir').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('createCustomer') }}",
            data : {
                "nama" : nama,
                "alamat" : alamat,
                "telepon" : telepon,
                "telepon2" : telepon2,
                "email" : email,
                "lahir" : lahir,
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