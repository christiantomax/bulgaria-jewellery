@extends('v_main')

@section('title','GL Entry')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>GL Entry List</b></h1>
                </div>    
                <div class="col-sm-6" style="display: flex; align-items: center;">
                    <div style="margin-left: auto;"><b><i>{{ $tanggal }}</i></b></div>
                </div>
            </div>
        </div>
    </div>

    <br><section class="content">
    <div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default elevation-2">
            <div class="card-header">
                <div class="row">
                    <h2 class="card-title" style="display: flex; align-items: center;"><b>Entry List</b></h2>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('indexGLPost') }}" method="POST">
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
                </form><br>

                @if($datagl != "")
                <div class="row">
                    <div class="col-12">
                    <table class="table table-bordered table-hover" id="tabel-gl">
                    <thead>
                        <tr>
                            <th style="width: 10%">Doc. Date</th>
                            <th style="width: 10%">Doc. No.</th>
                            <th style="width: 20%">Customer</th>
                            <th style="width: 25%">Article</th>
                            <th style="width: 10%">Price</th>
                            <th style="width: 10%">Debit</th>
                            <th style="width: 10%">Credit</th>
                            <th style="width: 5%">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datagl as $row)
                            <tr>
                                <td>{{ $row->TanggalDoc }}</td>
                                <td>{{ $row->KodeDoc }}</td>
                                <td>{{ $row->IDCustomer }} - {{ $row->NamaCust }}</td>
                                <td>{{ $row->KodeArticle }} - {{ $row->NamaArticle }}</td>
                                <td><b>{{ $row->Harga }}</b></td>
                                @if($row->Tipe == 'so')
                                    <td style="color: blue;"><b>{{ $row->HargaFinal }}</b></td>
                                    <td></td>
                                    <td>
                                        <a href="/transaction/sales/update/{{ $row->IDDoc }}" class="btn btn-block btn-primary">
                                        <i class="fas fa-eye"></i></a>
                                    </td>
                                @elseif($row->Tipe == 'bb')
                                    <td></td>
                                    <td style="color: red;"><b>{{ $row->HargaFinal }}</b></td>
                                    <td>
                                        <a href="/buyback/update/{{ $row->IDDoc }}" class="btn btn-block btn-primary">
                                        <i class="fas fa-eye"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    </div>
    </section>

</div>
@endsection

@section('js')
<script> 
    $ ( function () {
        $('#tabel-gl').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#tabel-gl_wrapper .col-md-6:eq(0)');
    })

    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#reservationdate2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
</script>
@endsection