@extends('v_main')

@section('title','Item - Detail')

@section('content')
<!-- Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Update Item</b></h1>
                    <input type="hidden" id="id" value="{{ $datart->IDArticle }}">
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
                <h2 class="card-title"><b>{{ $datart->KodeArticle }} - {{ $datart->NamaArticle }}</b></h2>
            </div>
        </div>
        <div class="card-body">
            <!-- Barcode -->
            <form method="POST" action="{{ route('printArtKode') }}">
                @csrf
                <div class="row">
                    </br><div class="col-4"><img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($datart->KodeArticle, 'C128') !!}" 
                        style="width: 20vw; height: 10vh;" alt="barcode"/></div>
                        <div></div>
                        <input type="hidden" id="kode" name="kode" value="{{ $datart->KodeArticle }}">
                        <div class="col-2"><button id="print" type="submit" class="btn btn-block bg-gradient-info" formtarget="_blank"><b>
                            <i class="fas fa-print"></i>&nbsp Print</b></button>
                        </div>
                        @if($datart->Buyback == 1 && (Auth::user()->IDLevel == 1 || Auth::user()->IDLevel == 2))
                        <div class="col-6">
                            <div class="float-right"><b><i><a style="color:red;">* Buyback Item</a></b></i></div>
                        </div>
                        @endif
                </div><br>
            </form>

            <div class="row">
                <!-- Kiri -->
                <div class="col-6">
                    <div class="form-group row" style="margin-right: 2%;">
                        <label class="col-sm-4 col-form-label">Item Name <a style="color:red;">*</a></label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" value="{{ $datart->NamaArticle }}">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-right: 2%;">
                        <label class="col-sm-4 col-form-label">Item Type</label>
                        <div class="col-sm-8">
                            <select class="form-control select2bs4" id="artype" style="width : 100%;" disabled>
                                @foreach($datartype as $row)
                                    @if($row->IDArticleType == $datart->IDArticleType)
                                        <option value="{{ $row->IDArticleType }}" selected>{{ $row->KodeAwal }} - {{ $row->NamaJenisArticle }}</option>
                                    @else
                                        <option value="{{ $row->IDArticleType }}">{{ $row->KodeAwal }} - {{ $row->NamaJenisArticle }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-right: 2%;">
                        <label class="col-sm-4 col-form-label">Allocation</label>
                        <div class="col-sm-8">
                            <select class="form-control select2bs4" id="alloc" style="width : 100%;" disabled>
                                @foreach($datalloc as $row)
                                    @if($row->IDZAlloc == $datart->IDZAlloc)
                                        <option value="{{ $row->IDZAlloc }}" selected>{{ $row->KodeAlloc }} - {{ $row->NamaAlloc }}</option>
                                    @else
                                        <option value="{{ $row->IDZAlloc }}">{{ $row->KodeAlloc }} - {{ $row->NamaAlloc }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-right: 2%;">
                        <label class="col-4 col-form-label">Supplier</label>
                        <div class="col-8">
                            <input class="form-control" type="text" value="{{ $datart->Kode}} - {{ $datart->NamaSupplier }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-form-label">Note</label>
                        <div class="col-12">
                            <textarea class="form-control" id="note">{{ $datart->Note }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Kanan -->
                <div class="col-6">
                    <div class="form-group row" style="margin-left: 2%;">
                        <label class="col-sm-4 col-form-label">Selling Price <a style="color:red;">*</a></label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" id="harga" value="{{ $datart->SellingPrice }}">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-left: 2%;">
                        <label class="col-sm-4 col-form-label">Gold Weight <a style="color:red;">*</a></label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="berat" value="{{ $datart->BeratEmas }}">
                        </div>
                        <label class="col-sm-1 col-form-label"><b>gr</b></label>
                    </div>
                    <div class="form-group row" style="margin-left: 2%;">
                        <label class="col-sm-4 col-form-label">Carat <a style="color:red;">*</a></label>
                        <div class="col-8">
                            <textarea class="form-control" rows="5" id="karat">{{ $datart->Karat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-left: 2%;">
                        <label class="col-4 col-form-label">Blocked</label>
                        <div class="col-4">
                            @if($datart->Block == 1)
                                <input type="checkbox" class="icheck-success d-inline col-2" id="block" checked>
                            @else
                                <input type="checkbox" class="icheck-success d-inline col-2" id="block">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" style="margin-left: 2%;">
                        <label class="col-4 col-form-label">Image <a style="color:red;">*</a></label>
                        <div class="col-8">
                            <form method="post" id="upload-image-form" enctype="multipart/form-data" accept="image/*">
                                @csrf
                                <div class="form-group">
                                    <input type="file" id="file" onchange="fileValidation()" class="form-control" >
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-left: 2%;">
                        <div class="col-md-12" style="text-align: right;">
                            <img id="preview" src="{{ $datart->Path }}"
                                alt="preview image" style="max-width: 50%;">
                        </div>
                    </div>
                </div>
            </div>
        
            @if(Auth::user()->IDLevel == 1 || Auth::user()->IDLevel == 2)
            <br><div class="form-group row">
                <div class="col-8"></div>
                <div class="col-4">
                    <button onclick="validate()" class="btn btn-block btn-primary"><b>Update</b></button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>

</section>

    <!-- Update Error -->
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
                <p>Are you sure want to update this data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                <button type="button" id="post_submit" class="btn btn-primary" onclick="postData()"><b>Submit</b></button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script> 
    $(document).ready(function (e) {
        $('#file').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });

    function refresh(){
        window.location.reload();
    }
    
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    function fileValidation() {
        var fileInput =  document.getElementById('file');
        var filePath = fileInput.value;
      
        // Allowing file type
        var allowedExtensions = 
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;
          
        if (!allowedExtensions.exec(filePath)) {
            $('#error-msg').html('Please check your article image');
            $('#update-error').modal('show');
            fileInput.value = null;
            return false;
        }else 
            return true;
    }

    function validate(){
        if($('#nama').val() == '' || $('#artype').val() == '' || $('#alloc').val() == '' || $('#artype').val() == 0 || $('#alloc').val() == 0
            || $('#berat').val() == '' || $('#karat').val() == '' || $('#harga').val() <= 0){
            $('#error-msg').html('Please check your data!');
            $('#create-error').modal('show');
        }else
            $('#update-validation').modal('show');
    }

    function postData(){
        $("#post_submit").attr("disabled", true);
        $("#submit").attr("disabled", true);
        var fd = new FormData();
        fd.append("id", $('#id').val());
        fd.append("kode", $('#kode').val());
        fd.append("nama", $('#nama').val());
        fd.append("artype", $('#artype').val());
        fd.append("alloc", $('#alloc').val());
        fd.append("note", $('#note').val());
        fd.append("berat", $('#berat').val());
        fd.append("karat", $('#karat').val());
        fd.append("harga", $('#harga').val());
        fd.append("file", file.files[0]);
        var block = 0;
        if($("#block").is(":checked"))
            block = 1;
        fd.append("block", block);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : "POST",
            url : "{{ route('updateArtPost') }}",
            contentType: false,
            processData: false,
            data: fd,
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
                    refresh();
                }
           }
        });
    }
</script>
@endsection