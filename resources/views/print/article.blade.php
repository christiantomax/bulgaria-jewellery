<!DOCTYPE html>
<html>
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<head>
    <style>
        html, body{
            margin: 2px;
        }
        *{
            font-size: 9px;
            font-family: 'Helvetica';
            font-weight: 700;
        }

        .wrapper{
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100%;
            /* padding-left: 70%; */
        }

        .section{
            height: 50%;
            width: 29%;
        }

        .kode{
            display: flex;
            justify-content: space-between;
        }
        .square {
            height: 2px;
            width: 2px;
            float: right;
            background-color: #000000;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="section" style="text-align: center; margin-left: 69%; margin-top: -5px;">
            <img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($article->KodeArticle, 'C128') !!}"
                                style="width: 100%; height: 50%;" alt="barcode"/>
            <br><b style="font-size: 12px;">{{ $article->KodeArticle }}</b>
            <br><div class="kode" style="margin-top: -2px;">
                <b style="float: left;">{{ $article->Kode }}</b>
                <b style="float: right;">{{ $article->KodeAwal }}</b>
            </div>
        </div>
        <div class="section" style="margin-left: 69%; position: relative; margin-top: 0.8%;">
            <div style="float: left; width: 100%; height: 50%; line-height: 1; position: absolute; top: 0;">
                <b style="font-size: 7px;" id="karat">{!! preg_replace("/\r\n|\r|\n/", '<br>', $article->Karat) !!}</b>
            </div>
            <div style="width: 100%; height: 20%; position: absolute; top: 60%;">
                <b style="float: right; font-size: 8px;">{{ $article->BeratEmas }} Gr.</b>
            </div>
            <div style="width: 100%; height: 25%; position: absolute; top: 80%;">
                <b style="float: right;">V{{ $article->SellingPrice * 178 }}</b>
            </div>
        </div>
    </div>
</body>

</html>
