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

        .parallelogram {
            padding: 2px 3px;
            height: 15px;
            display: inline-block;
            background: #D3D3D3;
            border: 1px solid transparent;
            transform: skewX(-20deg);
        }

        .grey *, .grey{
            background: #00008B;
            color: #FFF;
        }

        .emerald *, .emerald{
            background: #D3D3D3;
            color: #FFF;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th colspan="2" rowspan="2" style="border: 0;">
                <img src="{{ public_path('/storage/uploads/images/Logo.JPG') }}" style="height: 70px; margin: 5px 0px">
            </th>
            <th colspan="3" style="padding: 2px 10px 2px 10px; border: 0; text-align: right; font-size: 13px;">
                <p style="text-align: right: margin: 0; padding: 0; color: #00008B; font-size: 15px;">INVOICE</p>
            </th>
        </tr>
        <tr>
            <th colspan="3" style="padding: 1px 10px 1px 270px; border: 0;">
                <div style="margin-top: -20px;">
                    <p style="margin-bottom: 3px;">To : {{$data->Nama}} / {{$data->Telepon}}</p>
                    <p style="margin-bottom: 3px; margin-top: 0px;">Invoice ID &nbsp;: {{$data->KodeSO}}</p>
                    <p style="margin-top: 0px;">Issue Date : {{$data->created_at}}</p>
                </div>
            </th>
        </tr>
        <tr style="padding-top: 2px;" class="grey">
            <td colspan="2" class="text-center">
                Image
            </td>
            <td colspan="2" class="text-center">
                Item Description
            </td>
            <td colspan="1" class="text-center">
                Amount
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="height: 20px !important;">
                <img src="{{ public_path($data->Path) }}" style="height: 160px; margin: 5px 0px">
            </td>
            <td colspan="2" class="text-left">
                <table>
                    <tr>
                        <td style="border: 0; width: 25%;">{{$data->KodeArticle}}</td>
                        <td style="border: 0; width: 75%;"></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 25%;">Nama Barang</td>
                        <td style="border: 0; width: 75%;">: {{$data->NamaArticle}}</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 25%;">Berat Emas</td>
                        <td style="border: 0; width: 75%;">: {{$data->BeratEmas}} gr</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 25%;">Karat</td>
                        <td style="border: 0; width: 75%;">: {{$data->Karat}}</td>
                    </tr>
                </table>
            </td>
            <td colspan="1" class="text-center">
                <span>{{$data->HargaFinal}}</span>
                <br/>
                <span style="text-transform: capitalize;">({{$data->HargaFinalTerbilang}})</span>
            </td>
        </tr>
        <tr style="padding-top: 0px;">
            <td colspan="5" class="text-left" style="height: 1px !important; border: 0;">
            </td>
        </tr>
        <tr style="padding-top: 0px;">
            <td colspan="3" class="text-left" style="border: 0; padding: 0px; ">
                <table style="margin: 25px 0 0 0;">
                    <tr class="emerald">
                        <th colspan="5" style="text-align: center; font-size: 7px">
                            Ketentuan Buyback / Tukar Tambah
                        </th>
                    </tr>
                    <tr class="emerald">
                        <th colspan="3" style="text-align: center; font-size: 7px">
                            Nilai Potongan Dari Harga Nota
                        </th>
                        <th colspan="1" style="text-align: center; font-size: 7px">
                            Jual Kembali
                        </th>
                        <th colspan="1" style="text-align: center; font-size: 7px">
                            Tukar Tambah
                        </th>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: left; font-size: 7px">
                            Perhiasan Berlian
                        </td>
                        <td colspan="1" style="text-align: center; font-size: 7px">
                            15%
                        </td>
                        <td colspan="1" style="text-align: center; font-size: 7px">
                            10%
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: left; font-size: 7px">
                            Perhiasan Berlian dengan Batu Berwarna
                        </td>
                        <td colspan="1" style="text-align: center; font-size: 7px">
                            20%
                        </td>
                        <td colspan="1" style="text-align: center; font-size: 7px">
                            15%
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: left; font-size: 7px">
                            Cincin Nikah, Barang Special dan Pesanan
                        </td>
                        <td colspan="2" style="text-align: center; font-size: 7px">
                            Tidak dapat dijual kembali
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left; font-size: 7px">
                            <p style="margin-bottom: 0px; padding: 0; margin-top:0; margin: 0; font-weight: 700; font-size: 7px">Kondisi Khusus</p>
                            <p style="text-align: justify; margin-top:0; margin-bottom: 0px; font-size: 7px">
                                Apabila di kemudian hari ada kondisi pasar yang menyebabkan Toko tidak dapat melakukan penjualan kembali atau tukar tambah maka pihak Bulgaria Jewellery akan membantu untuk titip jual. Pemilik barang tidak dapat menuntut pihak Bulgaria Jewellery untuk membeli kembali barang. Kondisi khusus ini meliputi Krisis Global, Bencana alam, Pandemi , dan tidak menutup kemungkinan hal-hal lain yang dapat terjadi di masa mendatang.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td colspan="2" class="text-right" style="border: 0;">
                <p style="text-align:center; font-weight: 700; margin-left: 30px; margin-top: -30px;">
                    Issued By : {{$data->NamaUserCreator}}<br/>
                    Authorized Signature
                </p>
            </td>
        </tr>
        </tr>
        <tr style="height: 0.1px !important;">
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
            <td colspan="1" style="height: 1px !important; border: 0;"></td>
        </tr>
    </table>

</body>

</html>
