@extends('v_main')

@section('title','Storage')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Storage List</b></h1>
            </div>
            </div>
        </div>
    </div>

    <br><section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-3 col-12">
            <div class="row" style="height: 100%;">
                <div class="col-12" style="padding-bottom: 10%;">
                    <div class="card card-default elevation-2" style="height: 100%;">
                        <div class="card-body">
                            <h5><b>User</b><br>{{ Auth::user()->NamaUser }}</h5>
                            <h5 style="margin-top: 10%;"><b>Date</b><br>{{ $tanggal }}</h5>
                            
                            <form method="POST" action="{{ route('indexStorage') }}">
                                @csrf
                                <h5 style="margin-top: 10%;"><b>Storage</b></h5>
                                <select class="form-control select2bs4" id="storage" name="storage" style="width : 100%;">
                                        <option value="all">-- All Allocation --</option>
                                    @foreach($datatype as $row)
                                        <option value="{{ $row->IDZAlloc }}" {{  $post != '' ? ($post->storage == $row->IDZAlloc ? 'selected' : '') : '' }}>
                                            {{ $row->KodeAlloc }} - {{ $row->NamaAlloc }}</option>
                                    @endforeach
                                </select><br>
                                <button type="submit" class="btn btn-block btn-primary"><b>View Items</b></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-default elevation-2" style="height: 100%;">
                        <div class="card-header">
                            <div class="row">
                                <h2 class="card-title"><b>Summary</b></h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-summary" class="table table-striped">
                                <tbody>
                                    @foreach($summary as $row)
                                    <tr>
                                        <td>{{ $row->NamaJenisArticle }}</td>
                                        <td><b>{{ $row->Jumlah }}</b></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kolom Kiri -->

        <!-- Kolom Kanan -->
        <div class="col-md-9 col-12">
            <div class="card card-default elevation-2" style="height: 100%;">
                <div class="card-header">
                    <div class="row">
                        <h2 class="card-title"><b>Item List</b></h2>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table-article" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 20%;">Item Code</th>
                                <th style="width: 30%;">Item Name</th>
                                <th style="width: 20%;">Gold Weight</th>
                                <th style="width: 20%;">Gold Carat</th>
                                <th style="width: 5%;">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($article as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->KodeArticle }}</td>
                                <td>{{ $row->NamaArticle }}</td>
                                <td>{{ $row->BeratEmas }}</td>
                                <td>{!! preg_replace("/\r\n|\r|\n/", '<br>', $row->Karat) !!}</td>
                                <td><a href="article/list/{{ $row->KodeArticle }}" class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Kolom Kanan -->
    </div>
    </div>
    </section>

</div>
@endsection

@section('js')
<script> 
    $ ( function () {
        $('#table-article').DataTable({
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
</script>
@endsection