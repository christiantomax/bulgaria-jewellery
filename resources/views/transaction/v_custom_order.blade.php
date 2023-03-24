@extends('v_main')

@section('title','Custom Order')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Custom Order List</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div>
        <br><div class="row">
            <div class="col-2">
                <a href="/transaction/co/create" class="btn btn-block btn-success">
                    <i class="fas fa-plus"></i> &nbsp &nbsp<b>Create CO</b>
                </a>
            </div>
        </div>

<!-- Filter Card -->
@csrf
<br><section class="content">
<div class="row">
<div class="col-md-12 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title"><b>Custom Order</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="idco">No CO</label>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="idco" placeholder="Custom Order ID" >
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">CO Create Date</label>
                    <div class="col-sm-5">
                        <input type="date" id="codateawal" class="form-control" >
                    </div>
                    <div class="col-sm-5">
                        <input type="date" id="codateakhir" class="form-control" >
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" id="customer">
                            <option selected="" value="" {{ $req != '' ? ($req->creator == '' ? 'selected' : '') : '' }}>-- Select Customer --</option>
                            @foreach($datacustomer as $row)
                            <option value="{{ $row->id }}">{{ $row->IDCustomer }} - {{ $row->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-5">
                        <input type="date" id="duedateawal" class="form-control" >
                    </div>
                    <div class="col-sm-5">
                        <input type="date" id="duedateakhir" class="form-control" >
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Creator</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" id="creator" name="creator" style="width : 100%;">
                                <option value="" {{ $req != '' ? ($req->creator == '' ? 'selected' : '') : '' }}>-- Select User --</option>
                            @foreach($user as $row)
                                <option value="{{ $row->id }}" {{ $req != '' ? ($req->creator == $row->id ? 'selected' : '') : '' }}>{{ $row->KodeUser }} - {{ $row->NamaUser }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <button class="btn btn-block btn-primary" onclick="getdataco()"><b>View CO</b></button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Additional Filter -->
</div><br>
<!-- Row Atas -->

<div class="row">
<div class="col-12">
<div class="card elevation-2">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title" style="display: flex; align-items: center;"><b>CO List</b></h2>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-po">
            <thead>
                <tr>
                    <th style="width: 15%">CO No.</th>
                    <th style="width: 15%">Order Type</th>
                    <th style="width: 15%">Customer</th>
                    <th style="width: 15%">Total Nilai Pekerjaan (Rp)</th>
                    <th style="width: 15%">Due Date</th>
                    <th style="width: 15%">CO Create Date</th>
                    <th style="width: 15%">Creator</th>
                    <th style="width: 5%">View</th>
                </tr>
            </thead>
            <tbody id='tabel-body'>
                @foreach($dataco as $row)
                <tr>
                    <td>{{ $row->IDCO }}</td>
                    <td>{{ $row->NamaJenisType }}</td>
                    <td>{{ $row->Customer }}</td>
                    <td>{{ $row->TotalHarga }}</td>
                    <td>{{ $row->TglJatuhTempo }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->users }}</td>
                    <td><a href="/transaction/co/detail/{{ $row->IDCO }}" class="btn btn-block btn-primary">
                        <i class="fas fa-eye"></i>
                    </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

</section>
    </div>
</div>
</div>
@endsection

@section('js')
<script> 
    $ ( function () {
        $('#tabel-so').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    $('#reservationdate2').datetimepicker({
        format: 'L'
    });

    function getdataco(){
        var idco = $('#idco').val();
        var codateawal = $('#codateawal').val();
        var codateakhir = $('#codateakhir').val();
        var customer = $('#customer').val();
        var duedateawal = $('#duedateawal').val();
        var duedateakhir = $('#duedateakhir').val();
        var creator = $('#creator').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('getcofilter') }}",
            data : {
                "idco" : idco,
                "codateawal" : codateawal,
                "codateakhir" : codateakhir,
                "customer" : customer,
                "duedateawal" : duedateawal,
                "duedateakhir" : duedateakhir,
                "creator" : creator,
            },
            success:function(data){  
                console.log(data);
                var t = $('#tabel-po').DataTable();
                $('#tabel-po').dataTable().fnClearTable();
                $('#tabel-po').dataTable().fnDraw();  
                for (var i = 0; i < data.length; i++) {  
                    t.row.add( [
                        data[i].IDCO,
                        data[i].NamaJenisType,
                        data[i].Customer,
                        data[i].TotalHarga,
                        data[i].TglJatuhTempo,
                        data[i].created_at,
                        data[i].users,
                        '<a href="/transaction/co/detail/'+data[i].IDCO +'" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>',
                    ] ).draw( false );
                }
           },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
                console.log(err);
            }
        });
    
    }

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
</script>
@endsection