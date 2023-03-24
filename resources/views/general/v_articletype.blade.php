@extends('v_main')

@section('title','Item Type')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Setup Item Type</b></h1>
            </div>
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div>

<br><section class="content">
<div class="row">
<div class="col-md-12">
<div class="card elevation-2">
    <div>
        <div class="card-header">
            <div class="row">
                <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Add New Item Type</b></h2>
                <div class="col-3"><button onclick="refresh()" class="btn btn-block btn-success"><b>New Type</b></button></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Item Code <a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode" placeholder="Item Code Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="nama">Item Type Name <a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama" placeholder="Item Type">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">User Creator</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ Auth::user()->NamaUser }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="note">Notes <a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="note" placeholder="Item Type Notes">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9" style="color: red">
                    <b>* Please fill only 3 character for Item Code!</b>
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
        <table class="table table-bordered table-hover" id="tabel-type">
            <thead>
                <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 15%">Item Code</th>
                    <th style="width: 30%">Item Type Name</th>
                    <th style="width: 30%">User ID</th>
                    <th style="width: 20%">Last Date Modified</th>
                    <th style="width: 5%">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datatype as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $row->KodeAwal }}</td>
                    <td>{{ $row->NamaJenisArticle }}</td>
                    <td>{{ $row->NamaUser }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td><a href="/article/type/update/{{ $row->KodeAwal }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i></button></td>
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
        $('#tabel-type').DataTable({
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
        if($('#nama').val() == '' || $('#kode').val().length > 3 || $('#kode').val() == '' || $('#note').val() == ''
            || $('#kode').val() == 'ADM' || $('#kode').val() == 'STD' || $('#kode').val() == 'SUP' || $('#kode').val() == 'CUS'
            || $('#kode').val() == 'COI'){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else
            $('#create-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#nama').val();
        var kode = $('#kode').val();
        var note = $('#note').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('createArType') }}",
            data : {
                "nama" : nama,
                "kode" : kode,
                "note" : note,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#create-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#create-error').modal('show');
                }else{
                    $('#kode').attr("disabled", true);
                    $('#create-validation').modal('hide');
                    $('#create-scd').modal('show');
                }
           }
        });
    }
</script>
@endsection