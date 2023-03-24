@extends('v_main')

@section('title','Log - Custom Order')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Log Custom Order</b></h1>
        </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<br><div class="card elevation-2">
    <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Log Custom Order</b></h2>
                <div class="col-3"></div>
            </div>
        </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-customer">
            <thead>
                <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 15%">ID Custom Order</th>
                    <th style="width: 15%">Customer</th>
                    <th style="width: 10%">Due Date</th>
                    <th style="width: 10%">Total Custom Order (Rp)</th>
                    <th style="width: 15%">Created By</th>
                    <th style="width: 25%">Created On</th>
                    <th style="width: 5%">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datacustomer as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $row->IDCO }}</td>
                    <td>{{ $row->IDCustomer }} {{ $row->NamaCustomer }}</td>
                    <td>{{ $row->TglJatuhTempo }}</td>
                    <td>{{ $row->TotalHarga }}</td>
                    <td>{{ $row->CreatedBy }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td><a href="/customer/update/{{ $row->id }}" class="btn btn-primary"><i class="nav-icon fas fa-list-ul"></i></button></td>
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

    function validate(){
        if($('#customernama').val() == '' || $('#customeralamat').val() == 0 || $('#customertelepon').val() == '' || $('#customeremail').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else
            $('#create-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#customernama').val();
        var alamat = $('#customeralamat').val();
        var telepon = $('#customertelepon').val();
        var telepon2 = $('#customertelepon2').val();
        var email = $('#customeremail').val();
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
            },
            success:function(data){
                alert(data);
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