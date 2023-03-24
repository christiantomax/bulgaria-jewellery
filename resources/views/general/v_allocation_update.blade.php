@extends('v_main')

@section('title','Allocation - Update')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Update Allocation</b></h1>
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
            <input type="hidden" id="ida" value="{{ $datatype->IDZAlloc }}">
            <input type="hidden" id="kode" value="{{ $datatype->KodeAlloc }}">
            <h2 class="card-title" style="display: flex; align-items: center;">
                <b>{{ $datatype->KodeAlloc }} - {{ $datatype->NamaAlloc }}</b></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <button onclick="del()" id="delete" class="btn btn-block btn-danger"><i class="fas fa-trash"></i> &nbsp<b>Delete</b></button>
                </div>
            </div><br>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="nama">Allocation Name</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama" placeholder="Allocation Name" value="{{ $datatype->NamaAlloc }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" >Creator / Updater</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $datatype->NamaUser }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Note</label>
                        <div class="col-sm-7">
                        <input type="text" id="note" class="form-control" placeholder="Allocation Notes" value="{{ $datatype->Note }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" >Last Date Modified</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $datatype->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <br><div class="row">
                <div class="col-sm-9"></div>
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
                    <p>Are you sure want to delete data?</p>
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
                    <a href="/allocation/setup" class="btn btn-default"><b>Close</b></a>
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
                    <a href="/allocation/setup" class="btn btn-default"><b>Close</b></a>
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
        if($('#nama').val() == '' || $('#note').val() == '' || $('#kode').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#update-error').modal('show');
        }else
            $('#update-validation').modal('show');
    }

    function del(){
        if($('#nama').val() == '' || $('#note').val() == '' || $('#kode').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#update-error').modal('show');
        }else
            $('#delete-validation').modal('show');
    }

    function delPost(){
        $("#post_delete").attr("disabled", true);
        $("#delete").attr("disabled", true);

        var ida = $('#ida').val();
        var kode = $('#kode').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('delAlloc') }}",
            data : {
                "ida" : ida,
                "kode" : kode,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#delete-validation').modal('hide');
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#delete-validation').modal('hide');
                    $('#delete-scd').modal('show');
                    window.location.href = "/allocation/setup";
                }
           }
        });
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#nama').val();
        var ida = $('#ida').val();
        var note = $('#note').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateAllocPost') }}",
            data : {
                "nama" : nama,
                "ida" : ida,
                "note" : note,
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
                    window.location.href = "/allocation/setup";
                }
           }
        });
    }
</script>
@endsection