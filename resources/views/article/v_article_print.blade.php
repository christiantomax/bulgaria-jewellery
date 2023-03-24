<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>BULGARIA | Barcode</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  
    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>
    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('template/dist/img/Logo.png') }}">

    <style type="text/css">
        @page {
            size: auto;
        }
	.square {
  		height: 1vw; margin-right: 1%;
  		width: 1vw; float: right;
  		background-color: #000000;
	}
    </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="line-height: 1;">

<!-- Header -->
<div class="row" style="height: 75vh;">
	<div class="col-3"></div>
	<div class="col-2" style="text-align: center; margin-left: 3.1%;">
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($article->KodeArticle, 'C128')}}" 
                    style="width: 38vw; height: 35vh;" alt="barcode"/>
		<br><b style="font-size: 15vh;">{{ $article->KodeArticle }}</b>
		<br><div class="row">
			<div class="col-6">
				<b style="font-size: 12vh;">{{ $article->Kode }}</b>
				
			</div>
			<div class="col-6">
				<b style="font-size: 12vh;">{{ $article->KodeAwal }}</b><br>
			</div>
		</div>
	</div>
</div>

<div class="row" style="height: 40vh;">
	<div class="col-3"></div>
	<div class="col-2" style="margin-left: 3.4%; line-height: 0.7;">
			<b style="font-size: 12vh;" id="karat">{{ $article->Karat }}</b>
	</div>
</div>

<div class="row">
	<div class="col-3"></div>
	<div class="col-2" style="margin-left: 1.2%; float: right;">
		<b style="font-size: 11vh; float: right;">{{ $article->BeratEmas }} Gr.</b><br> 
		<b style="font-size: 14vh;  float: right;" id="harga">{{ $article->SellingPrice * 178 }}</b><br>
		@if($article->Buyback == 1)
			<div class="square"></div>
		@endif
	</div>
</div>

</div>
</body>
</html>

<script>
    $( document ).ready(function() {
	var car = $('#karat').html();
	var karat = car.split(/\n/);
	var karathtml = '';
	if(karat.length > 6 ){
		for(var i=0; i < 6; i++)
			karathtml = karathtml + karat[i] + '<br>';
		karathtml = karathtml + 'check';
	}else{
		for(var i=0; i < karat.length; i++)
			karathtml = karathtml + karat[i] + '<br>';
	}
	$('#karat').html(karathtml);
	
        var harga = $('#harga').html();
        $('#harga').html('<b>'+ harga +'</b>');
        window.addEventListener("load", window.print());
    });

    function rupiah(price){
        price = parseFloat(price).toFixed(2);
        var bil_bulat = price.toString().split('.')[0];
        var koma = price.toString().split('.')[1];
        var reverse = bil_bulat.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
        var rp = ribuan;
        return rp;
    }
</script>
