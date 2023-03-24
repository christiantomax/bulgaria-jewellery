<!DOCTYPE html>
<html>

<head>
    <style>
        html, body{
            margin: 12px;
        }
        *{
            font-size: 10px;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            height: 16px;
            border: 1px solid #dddddd;
            text-align: left;
            padding: 3px;
            width: 25%;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-justify{
            text-align: justify;
        }

        .parallelogram {
            padding: 2px 3px;
            height: 15px;
            display: inline-block;
            background: #D3D3D3;
            border: 1px solid transparent;
            transform: skewX(-20deg);
        }

        .grey *, .grey{
            background: #D3D3D3;
            color: #FFF;
        }
        .background-overlay{
            position: fixed;
            width: 100%;
        }
    </style>
</head>

<body>

    <table class="table">
        <tr>
            <th colspan="4" style="text-align: center; font-size: 15px; height: 40px !important;" class="grey">
                Terms and Condition
            </th>
        </tr>
        <tr style="padding-top: 2px;" >
            <td colspan="4" class="text-left" style="padding: 10px 80px 5px 40px; position: relative;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-top-right.jpg') }}" style="right: 0; top: 0px; height: 100px; position: absolute; z-index: -1;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-top-left.jpg') }}" style="left: 2px; top: 0px; height: 100px; position: absolute; z-index: -1;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-bottom-right.jpg') }}" style="bottom:-415px; right: 0;height: 100px; position: absolute; z-index: -1;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-bottom-left.jpg') }}" style="left: 2px; bottom: -415px; height: 100px; position: absolute; z-index: -1;">
                <ol type="1">
                <li><p style="margin-bottom: 0;">Faktur ini berfungsi sebagai bukti penjualan untuk perhiasan yang dibeli di <b>BULGARIA JEWELLERY</b></p></li>
                <li><p style="margin-bottom: 0;">Perhiasan berlian tertentu (kondisi baik) dapat dijual kembali kecuali cincin kawin</p></li>
                <li>
                    <p style="margin-bottom: 0;">
                    Perhiasan berlian tertentu (kondisi baik) dapat dijual kembali dengan ketentuan sebagai berikut
                    </p>
                    <table style="margin: 10px 0 0 0; padding: 0 40px;">
                        <tr>
                            <th colspan="1" style="text-align: center;">
                                Jangka<br/>Waktu
                            </th>
                            <th colspan="1" style="text-align: center;">
                                0 - 3 bulan
                            </th>
                            <th colspan="1" style="text-align: center;">
                                3 - 6 bulan
                            </th>
                            <th colspan="1" style="text-align: center;">
                                6 bulan - 1 tahun
                            </th>
                            <th colspan="1" style="text-align: center;">
                                1 - 2 tahun
                            </th>
                            <th colspan="1" style="text-align: center;">
                                > 2 tahun
                            </th>
                        </tr>
                        <tr>
                            <td colspan="1" style="text-align: center;">
                                Potongan<br/>dari Invoice
                            </td>
                            <td colspan="1" style="text-align: center;">
                                10%
                            </td>
                            <td colspan="1" style="text-align: center;">
                                15%
                            </td>
                            <td colspan="1" style="text-align: center;">
                                20%
                            </td>
                            <td colspan="1" style="text-align: center;">
                                25%
                            </td>
                            <td colspan="1" style="text-align: center;">
                                30%
                            </td>
                        </tr>
                    </table>
                    <p style="margin: 8px 0 0 0;">Apabila barang dinyatakan rusak maka potongan diatas ditambah 5%</p>
                </li>
                <li><p class="text-justify" style="margin-bottom: 0;">Pengembalian barang harus disertai dengan faktur barang yang bersangkutan</p></li>
                <li><p class="text-justify" style="margin-bottom: 0;">Pengembalian uang untuk pembelian barang dengan menggunakan kartu kredit akan dikenakan biaya tambahan sebesar 3%</p></li>
                <li><p class="text-justify" style="margin-bottom: 0;">Uang muka sebesar 50% akan dikenakan kepada pembeli untuk barang - barang pesanan (e.g cincin kawin) dan pelunasan barang harus dilakukan pada saat serah terima barang jika dalam kurun waktu 3 (tiga) bulan dari tanggal selesai yang dijanjikan perhiasan tidak diambil, <b>BULGARIA JEWELLERY</b> berhak untuk menjual dan uang muka yang telah dibayarkan tidak dapat dikembalikan.</p></li>
                <li><p class="text-justify" style="margin-bottom: 0;">Uang muka minimal sebesar 50$ dari harga perhiasan. jika dalam kurun waktu 1 (satu) tahun dari tanggal pembayaran uang muka perhiasan tidak diambil, maka <b>BULGARIA JEWELLERY</b> berhak untuk menjualnya dan uang muka yang telah dibayarkan tidak dapat dikemba</p>likan
                </li>
                <li><p class="text-justify" style="margin-bottom: 0;">Barang yang telah dibeli telah dites dengan diamond tester dan disaksikan oleh pihak pembeli</p></li>
                <li><p class="text-justify" style="margin-bottom: 0;"><b>BULGARIA JEWELLERY</b> berhak untuk mengubah syarat - syarat & ketentuan diatas.</p></li>
                </ol>
                <div class="text-center">
                    <img src="{{ public_path('/storage/uploads/images/Logo.JPG') }}" style="height: 30px; margin: 15px 0px 15px 75px">
                </div>
            </td>
        </tr>
        <tr style="height: 0.1px !important;">
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
        </tr>
    </table>

</body>

</html>
