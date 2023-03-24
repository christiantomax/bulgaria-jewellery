@extends('v_main')

@section('title','Buy Back')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Buy Back List</b></h1>
            </div>    
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
            </div>
        </div>
        <br><div class="row">
            <div class="col-2">
                <a href="/buyback/create" class="btn btn-block btn-success">
                    <i class="fas fa-plus"></i> &nbsp &nbsp<b>Create BB</b>
                </a>
            </div>
        </div>

<!-- Filter Card -->
<form action="{{ route('indexPostBB') }}" method="POST">
@csrf
<br><section class="content">
<div class="row">
<!-- General Filter -->
<div class="col-md-4 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title"><b>General Filter</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Buy Back No.</label>
                <input type="text" class="form-control" id="bbno" name="bbno" placeholder="Buy Back No." value="{{ $req != '' ? ($req->bbno) : '' }}">
            </div>
            <div class="col-sm-12" style="margin-bottom: 5%;">
                <label class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="null" {{ $req != '' ? ($req->status == 'null' ? 'selected' : '') : '' }}>-- All Status --</option>
                    <option value=1 {{ $req != '' ? ($req->status == 1 ? 'selected' : '') : '' }}>Active</option>
                    <option value=2 {{ $req != '' ? ($req->status == 2 ? 'selected' : '') : '' }}>Disabled</option>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
<!-- General Filter -->

<!-- Additional Filter -->
<div class="col-md-8 col-12">
<div class="card elevation-2" style="height: 100%;">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title"><b>Additional Filter</b></h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row form-horizontal">
            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Buy Back Date</label>
                    <div class="col-sm-5">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" id="bbdate1" name="bbdate1" class="form-control datetimepicker-input" 
                                data-target="#reservationdate" placeholder="Begin Date" value="{{ $req != '' ? ($req->bbdate1) : '' }}"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <input type="text" id="bbdate2" name="bbdate2" class="form-control datetimepicker-input" 
                                data-target="#reservationdate2" placeholder="End Date"  value="{{ $req != '' ? ($req->bbdate2) : '' }}"/>
                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer" name="customer" value="{{ $req != '' ? ($req->customer) : '' }}" placeholder="Customer Name">
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Item</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="article" name="article" placeholder="Item Code or Name" value="{{ $req != '' ? ($req->article) : '' }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Creator</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" id="creator" name="creator" style="width : 100%;">
                                <option value="null" {{ $req != '' ? ($req->creator == 'null' ? 'selected' : '') : '' }}>-- Select User --</option>
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
                <button type="submit" class="btn btn-block btn-primary"><b>View BB</b></button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Additional Filter -->
</div><br>
</form>
<!-- Row Atas -->

@if($databb != '')
<div class="row">
<div class="col-12">
<div class="card elevation-2">
    <div class="card-header">
        <div class="row">
            <h2 class="card-title" style="display: flex; align-items: center;"><b>Buy Back List</b></h2>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="tabel-bb">
            <thead>
                <tr>
                    <th style="width: 5%">Status</th>
                    <th style="width: 15%">BB No.</th>
                    <th style="width: 30%">Customer</th>
                    <th style="width: 30%">Item</th>
                    <th style="width: 30%">BB Date</th>
                    <th style="width: 20%">Creator</th>
                    <th style="width: 5%">View</th>
                </tr>
            </thead>
            <tbody id='tabel-body'>
                @foreach($databb as $row)
                    <tr>
                        @if($row->Status == 1)
                            <td><span class="right badge badge-success">Active</span></td>
                        @else
                            <td><span class="right badge badge-danger">Disabled</span></td>
                        @endif
                        <td>{{ $row->KodeBB }}</td>
                        <td>{{ $row->NamaCustomer }}</td>
                        <td>{{ $row->NamaArticle }}</td>
                        <td>{{ $row->BBDate }}</td>
                        <td>{{ $row->NamaUserCreator }}</td><td><a href="/buyback/update/{{ $row->IDBuyBack }}" class="btn btn-block btn-primary">
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
@endif

</section>
    </div>
</div>
</div>
@endsection

@section('js')
<script> 
    $ ( function () {
        $('#tabel-bb').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel", "pdf"]
        });buttons().container().appendTo('#tabel-bb_wrapper .col-md-6:eq(0)');
    })

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#reservationdate2').datetimepicker({
        format: 'DD/MM/YYYY'
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
</script>
@endsection