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
            background: #00A300;
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
                <p style="text-align: right: margin: 0; padding: 0; color: #00008B;">CUSTOM ORDER</p>
            </th>
        </tr>
        <tr>
            <th colspan="3" style="padding: 20px 10px 1px 250px; border: 0; margin-top: 15px;">
                <div style="margin-top: -20px;">
                    <p style="margin-bottom: 3px; margin-top: 0px">To : {{$data->Nama}} / {{$data->Telepon}}</p>
                    <p style="margin-bottom: 3px; margin-top: 0px">Address : {{$data->Alamat}}</p>
                    <p style="margin-bottom: 3px; margin-top: 0px;">Custom Order ID &nbsp;: {{$data->IDCO}}</p>
                    <p style="margin-bottom: 3px; margin-top: 0px">Issue Date : {{$data->created_at}}</p>
                    <p style="margin-top: 0px;">Order Type : {{$data->NamaJenisType}}</p>
                </div>
            </th>
        </tr>
        <tr style="padding-top: 2px;" class="grey">
            <td colspan="2" class="text-center">
                Image
            </td>
            <td colspan="2" class="text-center">
                Note
            </td>
            <td colspan="1" class="text-center">
                Item Description
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="height: 20px !important;">
                <img src="{{ public_path($data->Path) }}" style="height: 160px; margin: 5px 0px">
            </td>
            <td colspan="2" class="text-left">
                <div style="display: flex; align-items: start; height: 150px; padding: 5px">
                    {{$data->Note}}
                </div>
            </td>
            <td colspan="1" class="text-center">
                <table style="margin-top: -25px;">
                    <tr>
                        <td style="border: 0; width: 50%;">Size</td>
                        <td style="border: 0; width: 50%;">: {{$data->Size}}</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 50%;">Weight</td>
                        <td style="border: 0; width: 50%;">: {{$data->Weight}} gr</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 50%;">Metal Type</td>
                        <td style="border: 0; width: 50%;">: {{$data->MetalType}}</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 50%;">Stone Quality</td>
                        <td style="border: 0; width: 50%;">: {{$data->Quality}}</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 50%;">Labor Cost</td>
                        <td style="border: 0; width: 50%;">: {{$data->LaborCost}}</td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 50%;">Gold Price</td>
                        <td style="border: 0; width: 50%;">: {{$data->GoldPrice}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="padding-top: 2px;">
            <td colspan="5" class="text-left" style="height: 1px !important; border: 0;">
            </td>
        </tr>
        {{-- <tr style="padding-top: 2px;">
            <td colspan="5">
                <p style="margin-bottom: 0px; font-weight: 700; font-size: 10px; margin:0; padding:0;">Kondisi Khusus</p>
                <p style="text-align: justify; margin-bottom: 0px; margin:0; padding:0;">
                    Apabila di kemudian hari ada kondisi pasar yang menyebabkan Toko tidak dapat melakukan penjualan kembali atau tukar tambah maka pihak Bulgaria Jewellery akan membantu untuk titip jual. Pemilik barang tidak dapat menuntut pihak Bulgaria Jewellery untuk membeli kembali barang. Kondisi khusus ini meliputi Krisis Global, Bencana alam, Pandemi , dan tidak menutup kemungkinan hal-hal lain yang dapat terjadi di masa mendatang.
                </p>
            </td>
        </tr> --}}
        <tr style="border: 0; padding:0;">
            <td colspan="5" style="border: 0; padding:0; margin:0;">
                <table style="border: 0; padding:0; margin:0;">
                    <tr style="border: 0; padding:0; margin:0;">
                        <td style="border: 0; width: 25%; margin: 0px; font-weight: 700; font-size: 10px;">Estimated Price</td>
                        <td style="border: 0; width: 75%;">: {{$data->HargaFinal}} </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="border: 0; padding: 0; margin:0;">
            <td colspan="5" style="border: 0; padding: 0; margin:0;">
                <table style="border: 0; padding: 0; margin:0;">
                    <tr style="border: 0; padding: 0; margin:0;">
                        <td style="border: 0; width: 25%; margin: 0px; font-weight: 700; font-size: 10px;">Down Payment</td>
                        <td style="border: 0; width: 75%;">: {{$data->downpayment}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="border: 0; padding:0;">
            <td colspan="1" class="text-left" style="border: 0;">
                <p style="display: flex; align-items: start; justify-content: start; font-weight: 700; margin-top: -45px;">
                    <span style="line-height: 30px;">
                        Issued By : {{$data->NamaUser}}
                    </span><br/>
                    Sign Toko
                </p>
            </td>
            <td colspan="3" class="text-left" style="border: 0; padding:0;">
                <p style="border: 1px solid #dddddd; padding: 10px 15px; margin-top: 65px;">
                    Disclaimer jika pesanan tidak diambil dalam 3 bulan maka pesanan ini dianggap batal dan uang hangus
                </p>
            </td>
            <td colspan="1" class="text-right" style="border: 0;">
                <p style="display: flex; align-items: start; justify-content: start; font-weight: 700; margin-top: -45px;">
                    <span style="line-height: 30px;">
                        Due Date : {{$data->TglJatuhTempo}}
                    </span><br/>
                    Sign Customer
                </p>
            </td>
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
