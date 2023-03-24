<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>BULGARIA | Invoice</title>

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
            size: portrait;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Height 150vh, Width 152vw -->
<div class="row" style="height: 30vh; width: 152vw; padding: 1.5% 1.5% 0% 2%;">
    <div class="col-12" style="background-image: url({{ asset('template/dist/img/invoice/inv_header.jpg') }});
        height: 100%; width: 100%; background-size: cover;">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6"><h6 style="margin-left: 10%; margin-top: 3%;">SO Date : <b>{{ $dataso[0]->TanggalSO }}</b></h6></div>
                    <div class="col-6"><h2 class="float-right"><b>INVOICE</b></h2></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5">
                <h5 class="float-right">No SO. : <b>{{ $dataso[0]->KodeSO }}</b></h5>
            </div>
        </div>

        <!-- Customer -->
        <br><div class="row">
            <div class="col-7"></div>
            <div class="col-5">
                <h7 class="float-right">To : <b>{{ $dataso[0]->NamaCustomer }}</b></h7>
            </div>
        </div>
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5">
                <h7 class="float-right"><b>{{ $dataso[0]->Telepon }}</b></h7>
            </div>
        </div>
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5" style="text-align: right;">
                <h7 class="float-right"><b>{{ $dataso[0]->Alamat }}</b></h7>
            </div>
        </div>
    </div>
</div>

<!-- Row -->
<div class="row" style="height: 7.5vh; width: 152vw; padding: 0% 1.5% 0% 2%;">
    <div class="col-12" style="background-image: url({{ asset('template/dist/img/invoice/row_header.jpg') }});
        height: 100%; width: 100%; background-size: cover;">
    </div>
</div>
<div class="row" style="height: 75vh; width: 152vw; padding: 0% 1.5% 0% 2%;">
    <div class="col-12" style="background-image: url({{ asset('template/dist/img/invoice/row_body.jpg') }});
        height: 100%; width: 100%; background-size: cover;">
        <div class="row" style="height: 100%; display: flex; align-items: center;">
            <div class="col-6" style="text-align: center;">
                <img src="{{ $dataso[0]->Path }}" style="max-width: 85%;">
            </div>
            <div class="col-6" style="text-align: center;"><h3><b>{{ $dataso[0]->KodeArticle }}</b></h3><br>{{ $dataso[0]->NamaArticle }},
                {{ $dataso[0]->BeratEmas }}, {{ $dataso[0]->Karat }}</div>
        </div>
    </div>
</div>

<!-- Amount -->
<div class="row" style="height: 12vh; width: 152vw; padding: 0% 1.5% 0% 2%;">
    <div class="col-12" style="background-image: url({{ asset('template/dist/img/invoice/amount.jpg') }});
        height: 100%; width: 100%; background-size: cover;">
        <div class="row">
            <div class="col-3" style="text-align: center; color: white;">
                <h4 class="float-right"><b>Amount &nbsp : </b></h4>
            </div>
            <div class="col-6" style="text-align: center; color: white;">
                <h4 class="float-left" id="amount">{{ $dataso[0]->HargaFinal }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6" style="text-align: center; color: white;">
                <h4 class="float-left" id="terbilang"></h4>
            </div>
        </div>
    </div>
</div>

<!-- Signature -->
<div class="row" style="height: 25.5vh; width: 152vw; padding: 0% 1.5% 1.5% 2%;">
    <div class="col-12" style="background-color: white;
        height: 100%; width: 100%; background-size: cover;">
        <br><div class="row">
            <div class="col-1"></div>
            <div class="col-5"><h3><b>Note : </b></h3></div>
            <div class="col-5">
                <div class="float-right"><h3><b>Signature</b></h3></div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</div>

</div>
</body>
</html>

<script>
    $( document ).ready(function() {
        var amount = $('#amount').html();
        $('#amount').html('<b>' + rupiah(amount) + '</b>');
        $('#terbilang').html('<b>' + terbilang(amount) + '</b>');
        window.addEventListener("load", window.print());
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

    function terbilang(bilangan) {
        bilangan    = String(bilangan);
        var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
        var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
        var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

        var panjang_bilangan = bilangan.length;

        /* pengujian panjang bilangan */
        if (panjang_bilangan > 15) {
        kaLimat = "Diluar Batas";
        return kaLimat;
        }

        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for (i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-(i),1);
        }

        i = 1;
        j = 0;
        kaLimat = "";


        /* mulai proses iterasi terhadap array angka */
        while (i <= panjang_bilangan) {

        subkaLimat = "";
        kata1 = "";
        kata2 = "";
        kata3 = "";

        /* untuk Ratusan */
        if (angka[i+2] != "0") {
            if (angka[i+2] == "1") {
            kata1 = "Seratus";
            } else {
            kata1 = kata[angka[i+2]] + " Ratus";
            }
        }

        /* untuk Puluhan atau Belasan */
        if (angka[i+1] != "0") {
            if (angka[i+1] == "1") {
            if (angka[i] == "0") {
                kata2 = "Sepuluh";
            } else if (angka[i] == "1") {
                kata2 = "Sebelas";
            } else {
                kata2 = kata[angka[i]] + " Belas";
            }
            } else {
            kata2 = kata[angka[i+1]] + " Puluh";
            }
        }

        /* untuk Satuan */
        if (angka[i] != "0") {
            if (angka[i+1] != "1") {
            kata3 = kata[angka[i]];
            }
        }

        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
        if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
            subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
        }

        /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
        kaLimat = subkaLimat + kaLimat;
        i = i + 3;
        j = j + 1;

        }

        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")) {
        kaLimat = kaLimat.replace("Satu Ribu","Seribu");
        }

        return kaLimat + "Rupiah";
    }
</script>
