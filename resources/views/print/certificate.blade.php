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
        .gold{
            color: #E0CD67 ;
        }

        .font-table-1{
            font-size: 16px;
        }
        .font-table-2{
            font-size: 11px;
        }

        sub{
            font-size: 7px !important;
        }

    </style>
</head>

<body>

    <table class="table">
        <tr style="padding-top: 2px;" >
            <td colspan="4" class="text-left" style="padding: 10px 30px 5px 30px; position: relative;">
                <img src="{{ public_path('/storage/uploads/images/Logo.JPG') }}" style="height: 50px; margin: 15px 0px 5px 58px">
                <p style="font-weight: 700; font-size: 20px; text-align: center; margin: 0 0 0 0; padding: 0 0 0 0;">
                    Certificate of Authenticity
                </p>
                <img src="{{ public_path('/storage/uploads/images/frame-piece-top-right.jpg') }}" style="right: 0; top: 0px; height: 100px; position: absolute; z-index: -1;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-top-left.jpg') }}" style="left: 2px; top: 0px; height: 100px; position: absolute; z-index: -999;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-bottom-right.jpg') }}" style="bottom:-700px; right: 0;height: 100px; position: absolute; z-index: -1;">
                <img src="{{ public_path('/storage/uploads/images/frame-piece-bottom-left.jpg') }}" style="left: 2px; bottom: -700px; height: 100px; position: absolute; z-index: -1;">
                <div style="width: 100%; display:flex; justify-content: center; text-align: center; z-index:;">
                    <img src="{{ public_path('/storage/uploads/images/dummy-product.jpg') }}" style="height: 180px; margin: 35px 0px;">
                </div>
                <div style="width: 100%; display:flex; justify-content: start; text-align: left;">
                    <p class="gold" style="font-weight: 700; font-size: 17px; text-align: left; margin: 0 0 0 0; padding: 0 0 0 0;">Clarity Grade</p>
                    <table style="margin: 5px 0px 20px 0; padding: 0;">
                        <tr>
                            <td colspan="10" style="position: relative; border: 0; height: 1px;">
                                <img src="{{ public_path('/storage/uploads/images/check.jpg') }}" style="left: 45px; top: 2px; height: 50px; position: absolute; z-index: -999; opacity: 0.6;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"  class="font-table-1" style="text-align: center; padding: 2px 0;">
                                IF
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center; position: relative;">
                                VVS<sub>1</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                VVS<sub>2</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                VS<sub>1</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                VS<sub>2</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                SI<sub>1</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                SI<sub>2</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                I<sub>1</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                I<sub>2</sub>
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                I<sub>3</sub>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="width: 100%; display:flex; justify-content: start; text-align: left;">
                    <p class="gold" style="font-weight: 700; font-size: 17px; text-align: left; margin: 0 0 0 0; padding: 0 0 0 0;">Color Grade</p>
                    <table style="margin: 5px 0px 35px 0; padding: 0;">
                        <tr>
                            <td colspan="5" style="position: relative; border: 0; height: 1px;">
                                <img src="{{ public_path('/storage/uploads/images/check.jpg') }}" style="top: 0; height: 85px; position: absolute; z-index: -999; opacity: 0.6;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                DEF
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                GHIJ
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                KLM
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                NOPQR
                            </td>
                            <td colspan="1"  class="font-table-1" style="text-align: center;">
                                STUVWXYZ
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"  class="font-table-2" style="text-align: center;">
                                Colorless
                            </td>
                            <td colspan="1"  class="font-table-2" style="text-align: center;">
                                Near<br/>Colorless
                            </td>
                            <td colspan="1"  class="font-table-2" style="text-align: center;">
                                Faint<br/>Yellow
                            </td>
                            <td colspan="1"  class="font-table-2" style="text-align: center;">
                                Very Light<br/>Yellow
                            </td>
                            <td colspan="1"  class="font-table-2" style="text-align: center;">
                                Light<br/>Yellow
                            </td>
                        </tr>
                    </table>
                </div>
                <p style="font-weight: 700; font-size: 20px; text-align: center; margin: 0 0 0 0; padding: 0 0 0 0;">
                    Authorized Signature
                </p>
                <div style="width: 100%; margin-top: 105px; margin-bottom: 36px; text-align: center;">
                    <div style="width: 100%; text-align: center; ">
                        <p style="border-bottom: 1px solid #000; margin:0 auto; width: 50%; color: transparent"></p>
                    </div>
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
