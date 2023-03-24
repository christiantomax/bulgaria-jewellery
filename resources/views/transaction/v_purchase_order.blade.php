@extends('v_main')

@section('title','Purchase Order')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Purchase Order List</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div>
        <br><div class="row">
            <div class="col-2">
                <a href="/transaction/po/create" class="btn btn-block btn-success">
                    <i class="fas fa-plus"></i> &nbsp &nbsp<b>Create PO</b>
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
            <h2 class="card-title"><b>Purchase Order</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="idpo">No PO</label>
                    <div class="col-sm-10">  
                        <input type="text" class="form-control" id="idpo" placeholder="Purchase Order ID" >
                    </div>
                </div>
            </div>
        
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">PO Create Date</label>
                    <div class="col-sm-5">
                        <input type="date" id="podateawal" class="form-control" >
                    </div>
                    <div class="col-sm-5">
                        <input type="date" id="podateakhir" class="form-control" >
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="supplier">Supplier</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" id="supplier" name="supplier" style="width : 100%;">
                                <option value="" {{ $req != '' ? ($req->creator == 'null' ? 'selected' : '') : '' }}>-- Select Supplier --</option>
                            @foreach($datasupplier as $row)
                                <option option value="{{ $row->id }}">{{ $row->IDSupplier }} - {{ $row->Nama }}</option>
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
                                <option value="" {{ $req != '' ? ($req->creator == 'null' ? 'selected' : '') : '' }}>-- Select User --</option>
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
                <button class="btn btn-block btn-primary" onclick="getdatapo()"><b>View PO</b></button>
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
            <h2 class="card-title" style="display: flex; align-items: center;"><b>PO List</b></h2>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-po">
            <thead>
                <tr>
                    <th style="width: 10%">PO No.</th>
                    <th style="width: 10%">Supplier</th>
                    <th style="width: 10%">Nota Supplier</th>
                    <th style="width: 10%">Total Purchase Price ($)</th>
                    <th style="width: 10%">Total Purchase Price (Rp)</th>
                    <th style="width: 10%">Exchange Rate</th>
                    <th style="width: 12%">Due Date</th>
                    <th style="width: 12%">PO create Date</th>
                    <th style="width: 12%">Creator</th>
                    <th style="width: 5%">View</th>
                </tr>
            </thead>
            <tbody id='tabel-body'>
                @foreach($datapo as $row)
                <tr>
                    <td>{{ $row->IDPO }}</td>
                    <td>{{ $row->Supplier }}</td>
                    <td>{{ $row->NotaSupplier }}</td>
                    <td>{{ $row->TotalPurchasePriceDollar }}</td>
                    <td>{{ $row->TotalPurchasePriceRupiah }}</td>
                    <td>{{ $row->ExchangeRate }}</td>
                    <td>{{ $row->TglJatuhTempo }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->users }}</td>
                    <td><a href="/transaction/po/detail/{{ $row->IDPO }}" class="btn btn-block btn-primary">
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

    function getdatapo(){
        var idpo = $('#idpo').val();
        var podateawal = $('#podateawal').val();
        var podateakhir = $('#podateakhir').val();
        var supplier = $('#supplier').val();
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
            url : "{{ route('getpofilter') }}",
            data : {
                "idpo" : idpo,
                "podateawal" : podateawal,
                "podateakhir" : podateakhir,
                "supplier" : supplier,
                "duedateawal" : duedateawal,
                "duedateakhir" : duedateakhir,
                "creator" : creator,
            },
            success:function(data){ 
                var t = $('#tabel-po').DataTable();
                $('#tabel-po').dataTable().fnClearTable();
                $('#tabel-po').dataTable().fnDraw();  
                for (var i = 0; i < data.length; i++) {  
                    t.row.add( [
                        data[i].IDPO,
                        data[i].Supplier,
                        data[i].NotaSupplier,
                        data[i].TotalPurchasePriceDollar,
                        data[i].TotalPurchasePriceRupiah,
                        data[i].ExchangeRate,
                        data[i].TglJatuhTempo,
                        data[i].created_at,
                        data[i].users,
                        '<a href="/transaction/po/detail/'+data[i].IDPO+'" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>',
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