<?php
    $empty_product = '<tr>
            <td colspan="2" rowspan="9" style="text-align: center; position: relative;">
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 1px !important;"></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Ukuran</td>
            <td colspan="1" style="border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Berat</td>
            <td colspan="1" style="border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Emas</td>
            <td colspan="1" style="border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Harga Emas</td>
            <td colspan="1" style="border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Ongkos Tukang</td>
            <td colspan="1" style="border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 1px !important;"></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>';
?>
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
    </style>
</head>

<body>
    <table>
        <tr>
            <th colspan="3" style="border: 0;">
                <img src="{{ public_path('/storage/uploads/images/Logo.JPG') }}" style="height: 40px; margin: 5px 0px">
            </th>
            <th colspan="1" style="padding: 15px 10px 10px 10px; border: 0;">
                PASAR ATOM MALL<br>
                Lantai Dasar, Stand D-03<br>
                Jl. Bunguran 45 - Surabaya 60161<br>
                Telp. (031) 3557276<br>
                WA. 0812 3557 8999<br>
            </th>
        </tr>
        <tr>
            <td colspan="4" style="height: 8px !important; border-right: 0; border-left: 0;"></td>
        </tr>
        <tr>
            <td colspan="4" style="height: 1px !important;"></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td colspan="3">{{$data[0]->Nama}}</td>
        </tr>
        <tr>
            <td>ALAMAT</td>
            <td colspan="3">{{$data[0]->Nama}}</td>
        </tr>
        <tr>
            <td>TELP / HP</td>
            <td colspan="3">{{$data[0]->Telepon}}/{{$data[0]->Telepon2}}</td>
        </tr>
        <tr>
            <td>PESANAN</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="4" style="height: 1px !important;"></td>
        </tr>

        <tr>
            <td colspan="2" rowspan="9" style="text-align: center; position: relative;">
                <img src="{{ public_path('/storage/uploads/images/dummy-product.jpg') }}" style="top: 10px; left: 30%;height: 153px; margin: 0px; position: absolute;">
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" style="height: 1px !important; font-weight: 700;">{{$data[0]->NamaJenisType}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Ukuran</td>
            <td colspan="1" style="border-left: 0;">: {{$data[0]->Size}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Berat</td>
            <td colspan="1" style="border-left: 0;">: {{$data[0]->Weight}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Emas</td>
            <td colspan="1" style="border-left: 0;">: {{$data[0]->MetalType}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Harga Emas</td>
            <td colspan="1" style="border-left: 0;">: {{$data[0]->GoldPrice}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0;">Ongkos Tukang</td>
            <td colspan="1" style="border-left: 0;">: {{$data[0]->LaborCost}}</td>
        </tr>
        <tr>
            <td colspan="2" style="height: 1px !important;"></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="4" style="height: 1px !important;"></td>
        </tr>
        @if(isset($data[1]))
            <tr>
                <td colspan="2" rowspan="9" style="text-align: center; position: relative;">
                    <img src="{{ public_path('/storage/uploads/images/dummy-product.jpg') }}" style="top: 10px; left: 30%;height: 153px; margin: 0px; position: absolute;">
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="height: 1px !important; font-weight: 700;">{{$data[1]->NamaJenisType}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Ukuran</td>
                <td colspan="1" style="border-left: 0;">: {{$data[1]->Size}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Berat</td>
                <td colspan="1" style="border-left: 0;">: {{$data[1]->Weight}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Emas</td>
                <td colspan="1" style="border-left: 0;">: {{$data[1]->MetalType}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Harga Emas</td>
                <td colspan="1" style="border-left: 0;">: {{$data[1]->GoldPrice}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Ongkos Tukang</td>
                <td colspan="1" style="border-left: 0;">: {{$data[1]->LaborCost}}</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 1px !important;"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        @else
            <?php echo $empty_product; ?>
        @endif
        <tr>
            <td colspan="4" style="height: 1px !important;"></td>
        </tr>

        @if(isset($data[1]))
            <tr>
                <td colspan="2" rowspan="9" style="text-align: center; position: relative;">
                    <img src="{{ public_path('/storage/uploads/images/dummy-product.jpg') }}" style="top: 10px; left: 30%;height: 153px; margin: 0px; position: absolute;">
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="height: 1px !important; font-weight: 700;">{{$data[2]->NamaJenisType}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Ukuran</td>
                <td colspan="1" style="border-left: 0;">: {{$data[2]->Size}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Berat</td>
                <td colspan="1" style="border-left: 0;">: {{$data[2]->Weight}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Emas</td>
                <td colspan="1" style="border-left: 0;">: {{$data[2]->MetalType}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Harga Emas</td>
                <td colspan="1" style="border-left: 0;">: {{$data[2]->GoldPrice}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: 0;">Ongkos Tukang</td>
                <td colspan="1" style="border-left: 0;">: {{$data[2]->LaborCost}}</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 1px !important;"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        @else
            <?php echo $empty_product; ?>
        @endif
        <tr>
            <td colspan="4" style="height: 1px !important;"></td>
        </tr>
        <tr>
            <td colspan="1">HARGA JADI</td>
            <td colspan="3">{{$hargaJadi}}</td>
        </tr>
        <tr>
            <td colspan="1">UANG MUKA</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="1">KURANG</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="4" style="border: 0; height: 1px;"></td>
        </tr>
        <tr>
            <td colspan="4" style="height: 1px !important; border: 0;"></td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="padding-left: 10px;">
                    Jika pesanan tidak diambil selama 2 bulan, kami
                    berhak menjualnya dan nota pesanan ini tidak berlaku
                    lagi. Untuk ongkos tukang ditanggung pemesan
                </p>
            </td>
            <td colspan="1" style="height: 5px; border: 0;"></td>
        </tr>
        <tr style="padding-top: 20px;">
            <td colspan="2" class="text-center" style="border: 0;">
                <p>Surabaya, 30 Maret 2021</p>
                <p>Penerima,</p>
                <p style="margin-top: 50px;">(Penerima,)</p>
            </td>
            <td colspan="2" class="text-center" style="border: 0;">
                <p>Surabaya, 30 Maret 2021</p>
                <p>Penerima,</p>
                <p style="margin-top: 50px;">(Penerima,)</p>
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
