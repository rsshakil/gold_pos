<!DOCTYPE html>

<html lang="bangla">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barcode</title>
    <link href="<?php echo(\Config::get('app.url').'public/css/bootstrap/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo(\Config::get('app.url').'public/css/invoice.css');?>" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <style>
    .page-break {
    page-break-after: always;
    }

    /* @font-face {
            font-family: 'MigMix 2p';
            src: url('http://localhost/super_shop/public/fonts/migmix-2p-regular.ttf') format("truetype");
            src: url('{{ URL::asset('/public/fonts/migmix-2p-regular.ttf') }}') format("truetype"); 
            src: url("<?php echo(\Config::get('app.url').'public/fonts/migmix-2p-regular.ttf'); ?>") format("truetype");
            font-weight: 200;
            font-style: normal;

        } */
    body{ font-family: MigMix 2p; background: transparent;text-align:center;}
    div{
        text-align:center;
    }
    body{
        margin:0!important;
        padding:0!important;
        margin:0 auto !important;
    }
    </style>  

</head>

<body>
<div class="barcode_list" style="text-align:center;">
<?php

// echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
// echo '<img src="data:image/png,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
// echo DNS1D::getBarcodeSVG('4445645656', 'C39');
// echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
// echo DNS2D::getBarcodePNGPath('4445645656', 'PDF417');
// echo DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX');
// echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('4', 'PDF417') . '" alt="barcode"   />';
// echo 'ean working<br>';
// echo DNS1D::getBarcodeHTML('4445645656', 'C39');
// echo DNS1D::getBarcodeHTML('4445645656', 'C39+');
// echo DNS1D::getBarcodeHTML('4445645656', 'C39E');
// echo DNS1D::getBarcodeHTML('4445645656', 'C39E+');
// echo DNS1D::getBarcodeHTML('4445645656', 'C93');
// echo DNS1D::getBarcodeHTML('4445645656', 'S25');
// echo DNS1D::getBarcodeHTML('4445645656', 'S25+');
// echo DNS1D::getBarcodeHTML('4445645656', 'I25');
// echo DNS1D::getBarcodeHTML('4445645656', 'I25+');
// echo DNS1D::getBarcodeHTML('4445645656', 'C128');
// echo DNS1D::getBarcodeHTML('4445645656', 'C128A');
// echo DNS1D::getBarcodeHTML('4445645656', 'C128B');
// echo DNS1D::getBarcodeHTML('4445645656', 'C128C');
// echo 'ean working<br>';
// echo DNS1D::getBarcodeHTML('44455656', 'EAN2');
// echo DNS1D::getBarcodeHTML('4445656', 'EAN5');
// echo DNS1D::getBarcodeHTML('4445', 'EAN8');
// echo DNS1D::getBarcodeHTML('4445', 'EAN13');
// echo DNS1D::getBarcodeHTML('4445645656', 'UPCA');
// echo DNS1D::getBarcodeHTML('4445645656', 'UPCE');
// echo DNS1D::getBarcodeHTML('4445645656', 'MSI');
// echo DNS1D::getBarcodeHTML('4445645656', 'MSI+');
// echo DNS1D::getBarcodeHTML('4445645656', 'POSTNET');
// echo DNS1D::getBarcodeHTML('4445645656', 'PLANET');
// echo DNS1D::getBarcodeHTML('4445645656', 'RMS4CC');
// echo DNS1D::getBarcodeHTML('4445645656', 'KIX');
// echo DNS1D::getBarcodeHTML('4445645656', 'IMB');
// echo DNS1D::getBarcodeHTML('4445645656', 'CODABAR');
// echo DNS1D::getBarcodeHTML('4445645656', 'CODE11');
// echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA');
// echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');

?>
<!--<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('11', 'C39')}}" alt="barcode" />

<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('12', 'C39+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('13', 'C39E')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('14', 'C39E+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('15', 'C93')}}" alt="barcode" />
	<br/>
	<br/>
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('19', 'S25')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('20', 'S25+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('21', 'I25')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('22', 'MSI+')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('23', 'POSTNET')}}" alt="barcode" />
	<br/>
	<br/>
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('16', 'QRCODE')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('17', 'PDF417')}}" alt="barcode" />
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('18', 'DATAMATRIX')}}" alt="barcode" />-->
@foreach($product_list as $value)
    <p style="margin:0">Fariha Jewellers</p>
    <p style="margin:0;text-align:center;">{{$value->product_carat_type}} CARAT</p>
    <div style="margin:0;text-align:center;display:inline-flex;"><?php
    // echo $barcode = $value->barcode;exit;
    echo DNS1D::getBarcodeHTML(".$barcode.", 'EAN13');
    ?></div>
    <p  style="margin:0">{{$value->weight}} GRAM</p>
@endforeach
</div>
</body>

</html>