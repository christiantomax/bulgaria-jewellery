@extends('v_main')

@section('title','Item List')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Item List</b></h1>
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
            <div class="card-body">
                <form method="POST" action="{{ route('articleListPost') }}">
                @csrf
                <br><div class="row">
                    <div class="col-12"><label>Item Types</label></div>
                    <div class="col-4">
                        <select class="form-control select2bs4" name="artype" style="width : 100%;">
                            @foreach($datartype as $row)
                                <option value="{{ $row->IDArticleType }}" {{ $idtype != '' ? ($idtype == $row->IDArticleType ? 'selected' : '') : '' }}>{{ $row->KodeAwal }} - {{ $row->NamaJenisArticle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-block btn-primary"><b>View</b></button>
                    </div>
                </div>
                </form><br>

                <div class="row">
                    <div class="col-12">
                    <table class="table table-bordered table-hover" id="tabel-article">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 5%">Item Code</th>
                            <th style="width: 25%">Item Name</th>
                            <th style="width: 5%">Gold Weight</th>
                            <th style="width: 15%">Gold Carat</th>
                            <th style="width: 15%">Selling Price</th>
                            <th style="width: 25%">Image</th>
                            <th style="width: 5%">Print</th>
                            <th style="width: 5%">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="jml" value="{{ count($article) }}">
                        @foreach($article as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->KodeArticle }}</td>
                                <td>{{ $row->NamaArticle }}</td>
                                <td>{{ $row->BeratEmas }}</td>
                                <td>{!! preg_replace("/\r\n|\r|\n/", '<br>', $row->Karat) !!}</td>
                                <td id="harga{{ $loop->iteration }}">{{ $row->SellingPrice }}</td>
                                <td>
                                <img id="preview" src="{{ $row->path }}" alt="preview image" style="max-width: 100%;">
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('printArtKode') }}">
                                        @csrf
                                        <input type="hidden" name="kode" value="{{ $row->KodeArticle }}">
                                        <button id="print" type="submit" class="btn btn-block bg-gradient-info" formtarget="_blank">
                                        <i class="fas fa-print"></i>
                                    </form>
                                </td>
                                <td><a href="/article/list/{{ $row->KodeArticle }}" class="btn btn-block btn-primary">
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
    </div>
    </div>
    </section>

</div>
@endsection

@section('js')
<script> 
    $( document ).ready(function() {
        for(var i = 1; i <= $('#jml').val(); i++){
            $('#harga'+i).html(rupiah($('#harga'+i).html()));
        }
    });

    $ ( function () {
        $('#tabel-article').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })

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

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
@endsection