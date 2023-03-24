@extends('v_main')

@section('title','User - Update')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Update User</b></h1>
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
            <input type="hidden" id="idu" value="{{ $datauser->id }}">
            <h1 class="card-title" style="display: flex; align-items: center;">
                <b>{{ $datauser->KodeUser }}</b></h1>
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
                    <label class="col-sm-4 col-form-label" for="level">User Level</label>
                        <div class="col-sm-7">
                        <select class="form-control" id="level">
                            @foreach($datalevel as $row)
                                @if($datauser->IDLevel == $row->IDLevel)
                                <option value="{{ $row->IDLevel }}" selected>{{ $row->Level }}</option>
                                @else
                                <option value="{{ $row->IDLevel }}">{{ $row->Level }}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="nama">Full Name</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama" placeholder="User Full Name" value="{{ $datauser->NamaUser }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="alamat">Address</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="alamat" placeholder="User Address" value="{{ $datauser->AlamatUser }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <label class="col-sm-4 col-form-label" for="username">Username</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="username" placeholder="Username" value="{{ $datauser->username }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="creator">Creator / Updater</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="creator" value="{{ $datauser->Maker }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" >Last Date Modified</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{ $datauser->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-4 col-form-label" for="username">Active</label>
                        <div class="col-sm-7">
                            @if($datauser->Status == 1)
                            <input type="checkbox" class="icheck-success d-inline col-sm-1" id="status" name="status" checked>
                            @else
                            <input type="checkbox" class="icheck-success d-inline col-sm-1" id="status" name="status">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Notes</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="note">{{ $datauser->Note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Button -->
            <br><div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-3">
                    <button id="reset" onclick="reset()" class="btn btn-block btn-success"><i class="fas fa-key"></i> &nbsp<b>Password Reset</b></button>
                </div>
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
        if($('#nama').val() == '' || $('#alamat').val() == 0 || $('#username').val() == '' || 
            $('#level').val() == '' || $('#note').val() == ''){
            $('#error-msg').html('Please check your data!');
            $('#update-error').modal('show');
        }else
            $('#update-validation').modal('show');
    }

    function reset(){
        $('#reset-validation').modal('show');
    }

    function resetPost(){
        $("#post_reset").attr("disabled", true);
        $("#reset").attr("disabled", true);

        var idu = $('#idu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('resetPass') }}",
            data : {
                "idu" : idu,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#reset-validation').modal('hide');
                    $("#post_reset").attr("disabled", false);
                    $("#reset").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#reset-validation').modal('hide');
                    $('#update-scd').modal('show');
                }
           }
        });
    }

    function del(){
        $('#delete-validation').modal('show');
    }

    function delPost(){
        $("#post_delete").attr("disabled", true);
        $("#delete").attr("disabled", true);

        var idu = $('#idu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('delUser') }}",
            data : {
                "idu" : idu,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#delete-validation').modal('hide');
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else{
                    $('#delete-validation').modal('hide');
                    $('#delete-scd').modal('show');
                    window.location.href = "/user/setup";
                }
           }
        });
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        var username = $('#username').val();
        var level = $('#level').val();
        var note = $('#note').val();
        var idu = $('#idu').val();
        var status = 0;
        if($('input[name="status"]').is(":checked"))
            status = 1;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateUserPost') }}",
            data : {
                "nama" : nama,
                "alamat" : alamat,
                "username" : username,
                "level" : level,
                "note" : note,
                "idu" : idu,
                "status" : status,
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
                    window.location.href = "/user/setup";
                }
           }
        });
    }
</script>
@endsection