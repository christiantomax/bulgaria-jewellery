@extends('v_main')

@section('title','Stock Mutation')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Mutation</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div>

<br><section class="content">
<div class="row">
<!-- Kiri -->
<div class="col-md-8 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title"><b>Item Details</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 3%;">
                <label class="form-label">Item Type List</label>
                <select class="form-control select2bs4" id="artype" style="width : 100%;">
                    <option value="null">-- Select Item Type --</option>
                    @foreach($artype as $row)
                        <option value="{{ $row->IDArticleType }}">{{ $row->KodeAwal }} - {{ $row->NamaJenisArticle }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Item List</label>
                <select class="form-control select2bs4" id="article" style="width : 100%;">
                    <option value="null">-- Select Item --</option>
                    @foreach($article as $row)
                        <option value="{{ $row->KodeArticle }}">{{ $row->KodeArticle }} - {{ $row->NamaArticle }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-4"><b>Gold Weight</b></div>
                    <div class="col-8">
                        <input class="form-control" type="text" id="berat" value="-" disabled>
                    </div><br>
                    
                    <div class="col-4"><b>Gold Carat</b></div>
                    <div class="col-12">
                        <textarea class="form-control" id="karat" rows="5" disabled>-</textarea>
                    </div><br>
                </div>
            </div>
            <div class="col-6">
                <img id="preview" src="" alt="Article Image" style="max-width: 100%;">
            </div>
        </div>
    </div>
</div>
</div>

<!-- Kanan -->
<div class="col-md-4 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title"><b>Transfer</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Current Allocation</label>
                <select class="form-control" id="from" name="from" disabled>
                    <option value="null">-- Select Allocation --</option>
                    @foreach($alloc as $row)
                        <option value="{{ $row->IDZAlloc }}">{{ $row->KodeAlloc }} - {{ $row->NamaAlloc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Transfer To</label>
                <select class="form-control" id="to" name="to">
                    <option value="null">-- Select Allocation --</option>
                    @foreach($alloc as $row)
                        @if($row->IDZAlloc != 4)
                            <option value="{{ $row->IDZAlloc }}">{{ $row->KodeAlloc }} - {{ $row->NamaAlloc }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Note</label>
                <textarea id="note" class="form-control"></textarea>
            </div>
        </div>
        <br><div class="row">
            <div class="col-6">
                <p id="loading"></p>
            </div>
            <div class="col-6">
                <button onclick="validate()" id="submit" class="btn btn-block btn-primary"><b>Transfer</b></button>
            </div>
        </div>
    </div>
</div>
</div>
</div><br>

<div class="row">
<div class="col-12">
<div class="card elevation-2">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title" style="display: flex; align-items: center;"><b>Mutation List</b></h2>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('mutationFilter') }}" method="POST">
        @csrf
        <div class="row">
            <label class="col-2 col-form-label">Date Filter :</label>
            <div class="col-sm-3">
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="date1" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Begin Date" value="{{ $post != '' ? ($post->date1) : '' }}"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                    <input type="text" name="date2" class="form-control datetimepicker-input" data-target="#reservationdate2" placeholder="End Date" value="{{ $post != '' ? ($post->date2) : '' }}"/>
                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <br><div class="row">
            <div class="col-2"></div>
            <div class="col-6">
                <button type="submit" class="btn btn-block btn-primary"><b>View List</b></button>
            </div>
        </div>
        </form>

        <br><br><div class="row">
        <div class="col-12">
        <table class="table table-bordered table-hover" id="tabel-mutasi">
            <thead>
                <tr>
                    <th style="width: 10%">Mutation Date</th>
                    <th style="width: 15%">Document No.</th>
                    <th style="width: 25%">Item</th>
                    <th style="width: 15%">Transfer From</th>
                    <th style="width: 15%">Transfer To</th>
                    <th style="width: 5%">User</th>
                    <th style="width: 15%">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mutationlist as $row)
                    <tr>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->DocumentNo }}</td>
                        <td>{{ $row->KodeArticle }} - {{ $row->NamaArticle }}</td>
                        <td>{{ $row->NamaAllocFrom }}</td>
                        <td>{{ $row->NamaAllocTo }}</td>
                        <td>{{ $row->NamaUser }}</td>
                        <td>{{ $row->Note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
</div>
</div>

</section>

    <!-- Transfer Error -->
    <div class="modal fade" id="transfer-error">
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

    <!-- Transfer Validation -->
    <div class="modal fade" id="transfer-validation">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Validate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to transfer article allocation?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                <button type="button" id="post_submit" class="btn btn-primary" onclick="postData()"><b>Submit</b></button>
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
        document.getElementById("preview").style.display = "none";
    });

    function refresh(){
        window.location.reload();
    }

    $ ( function () {
        $('#tabel-mutasi').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#tabel-mutasi_wrapper .col-md-6:eq(0)');
    })

    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    $('#reservationdate2').datetimepicker({
        format: 'L'
    });

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#article').on('change', function() {
        if(this.value != "null"){
            $('#loading').html('<b>Loading...</b>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "POST",
                url : "{{ route('mutationGetArticleDet') }}",
                data : {
                    "kode" : this.value,
                },
                success:function(data){
                    $('#berat').val(JSON.stringify(data[0]['BeratEmas']).split('"').join('') + ' gr');
                    $('#karat').val(data[0]['Karat']);
                    document.getElementById("preview").style.display = "block";
                    $('#preview').attr('src', data[0]['Path']);

                    $('#loading').html('<br>');
                    var alloc = document.getElementById('from');
                    for(var i = 0; i <= alloc.length; i++) {
                        var al = alloc[i];
                        if (al.value == data[0]['IDZAlloc'])
                            alloc.selectedIndex = i;
                    }
                }
            });
        }else{
            $('#berat').val('-');
            $('#karat').val('-');
            document.getElementById("preview").style.display = "none";
            $('#loading').html('<br>');
        }
    });

    $('#artype').on('change', function() {
        if(this.value != "null"){
            $('#article').empty();
            $('#loading').html('<b>Loading...</b>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "POST",
                url : "{{ route('mutationGetArticle') }}",
                data : {
                    "idtype" : this.value,
                },
                success:function(data){
                    $('#article').select2({
                        data: [{id: "null", text: "-- Select Item --"}]
                    });
                    for(var i=0; i<data.length; i++){                
                        $('#article').select2({
                            data: [
                                {
                                    id: data[i]['KodeArticle'], 
                                    text: data[i]['KodeArticle'] + " - " + data[i]['NamaArticle']
                                }]
                        });
                    }
                    
                    $('#article').select2({
                        theme: 'bootstrap4'
                    })
                    $('#loading').html('<br>');
                }
            });
        }else{
            $('#berat').val('-');
            $('#karat').val('-');
            document.getElementById("preview").style.display = "none";
            $('#loading').html('<br>');
        }
    });

    function validate(){
        if($('#from').val() == $('#to').val() || $('#from').val() == 'null' || 
            $('#to').val() == 'null' || $('#article').val() == 'null'){
            $('#error-msg').html('Please check your data!');
            $('#transfer-error').modal('show');
        }else
            $('#transfer-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);

        var article = $('#article').val();
        var from = $('#from').val();
        var to = $('#to').val();
        var note = $('#note').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('mutationPost') }}",
            data : {
                "article" : article,
                "from" : from,
                "to" : to,
                "note" : note,
            },
            success:function(data){
                if(JSON.stringify(data).split('"').join('') == 'error'){
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#transfer-validation').modal('hide');
                    $('#transfer-error').modal('show');
                    $('#error-msg').html('There is an error...');
                }else if(JSON.stringify(data).split('"').join('') == 'so'){
                    $("#post_submit").attr("disabled", false);
                    $("#submit").attr("disabled", false);
                    $('#transfer-validation').modal('hide');
                    $('#transfer-error').modal('show');
                    $('#error-msg').html('There is SO with this item...');
                }
                else{
                    refresh();
                }
           }
        });
    }
</script>
@endsection