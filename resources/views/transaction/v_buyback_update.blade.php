@extends('v_main')

@section('title','Buy Back - Update')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Update Buy Back</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
                <input type="hidden" id="idbb" value="{{ $databb->IDBuyBack }}">
            </div>
        </div><br>
        <div class="row">
            <div class="col-2">
                <a href="/buyback" class="btn btn-block btn-success"><b>
                    <i class="fa fa-arrow-left"></i>&nbsp Back</b></a>
            </div>
        </div>

<br><section class="content">
<!-- <div class="container"> -->
<div class="row">
<!-- SO Card -->
<div class="col-md-4 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title" style="display: flex; align-items: center;"><b>Buy Back Card</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">Buy Back No.</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Buy Back Number" value="{{ $databb->KodeBB }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="nama">User Creator</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="User Name" value="{{ $databb->NamaUserCreator }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">SO No.</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="sobb" value="{{ $databb->KodeSO }}" disabled>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label">Buy Back Date</label>
                    <div class="col-sm-8">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" value="{{ $databb->BBDate }}" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="note">Note</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" disabled>{{ $databb->Note }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- SO Card -->

<!-- Customer Card -->
<div class="col-md-8 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title col-9" style="display: flex; align-items: center;"><b>Customer Card</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="customer">Customer</label>
            
            <div class="col-sm-10 col-10">
            <input type="text" class="form-control" value="{{ $databb->NamaCustomer }}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone No.</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" value="{{ $databb->Telepon }}" disabled>
                    </div>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control"  value="{{ $databb->Telepon2 }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" id="lahir" value="{{ $databb->TanggalLahir }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5 col-5">
                        <input type="text" class="form-control" value="{{ $databb->Email }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" disabled>{{ $databb->Alamat }}</textarea>
                    </div>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="col-sm-12"><p style="float: right;" id="loadingcust"><br></p></div>
        </div><br>
    </div>
</div>
</div>
<!-- Customer Card -->

</div><br>
<!-- </div> -->
<!-- Row Atas -->

<!-- Row Article -->
<div class="row">
<div class="col-md-12">
    <div class="card elevation-2">
        <div class="card-header">
            <div class="row">
                <h2 class="card-title" style="display: flex; align-items: center;"><b>Article Card</b></h2>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12" style="background-color: #dbdbdb; border-radius: 5px; padding: 1%;">
                <table id="table-article" class="table table-bordered" style="background: white;">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Item Code</th>
                            <th style="width: 25%;">Item Name</th>
                            <th style="width: 10%;">Gold Weight</th>
                            <th style="width: 20%;">Gold Carat</th>
                            <th style="width: 20%;">Final Price</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f7f7f7;">
                        <tr>
                            <td>{{ $databb->KodeArticle }}</td>
                            <td>{{ $databb->NamaArticle }}</td>
                            <td>{{ $databb->BeratEmas }} gr</td>
                            <td>{!! preg_replace("/\r\n|\r|\n/", '<br>', $databb->Karat) !!}</td>
                            <td id="hargafinal">{{ $databb->HargaFinal }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><label class="form-label" style="float: right;">Preview Image : </label></td>
                            <td>
                                <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <img src="{{ $databb->Path }}" alt="Article Image" style="width: 100%;">
                                </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-12">
                    <p style="float: right;" id="loading"><br></p>
                </div>
                <div class="col-7"></div>
                <div class="col-5">
                    @if($databb->Status == 1 && Auth::user()->IDLevel != 3)
                        <button id="submit" onclick="validate()" class="btn btn-block btn-danger"><b>Deactive</b></button>
                    @endif   
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
                    Are you sure want to update this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                    <button type="button" id="post_submit" class="btn btn-primary" onclick="postData()"><b>Submit</b></button>
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
                    <h4 class="modal-title">Update Success</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Success!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Close</b></button>
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
    $( document ).ready(function() {
        $('#hargafinal').html(rupiah( $('#hargafinal').html() ));
    });


    function rupiah(price){
        price = parseFloat(price).toFixed(2);
        var bil_bulat = price.toString().split('.')[0];
        var koma = price.toString().split('.')[1];
        var reverse = bil_bulat.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
        var rp = 'Rp '+ribuan+','+koma;
        return rp;
    }

    function validate(){
        $('#update-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var idbb = $('#idbb').val();
        var status = $('#status').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateBBPost') }}",
            data : {
                "idbb" : idbb,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $('#update-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is an error...');
                    $('#update-error').modal('show');
                }else if(JSON.stringify(data).split('"').join('') == 'bb'){
                    $('#update-validation').modal('hide');
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#error-msg').html('There is no active SO...');
                    $('#update-error').modal('show');
                }else{
                    $('#update-validation').modal('hide');
                    $('#update-scd').modal('show');
                    window.location.href = "/buyback";
                }
           }
        });
    }
</script>
@endsection