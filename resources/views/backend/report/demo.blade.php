<!DOCTYPE html>
<html lang="bangla">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            Delivery Order Report
        </title>
    <link rel="stylesheet" type="text/css" href="{{Config::get('app.url').'public/css/bootstrap/bootstrap.min.css'}}">
    <style>
    .page-break {
    page-break-after: always;
    }

    @font-face {
            font-family: 'SolaimanLipi';
            /* src: url('http://localhost/ryutsu_van/public/fonts/migmix-2p-regular.ttf') format("truetype"); */
            /* src: url('{{ URL::asset('/public/fonts/migmix-2p-regular.ttf') }}') format("truetype"); */
            /* src: url("<?php echo(\Config::get('app.url').'public/fonts/migmix-2p-regular.ttf'); ?>") format("truetype"); */
            src: url({{ public_path('fonts/SolaimanLipi.ttf') }}) format('truetype');
            font-weight: 200;
            font-style: normal;

        }
    body{ font-family:SolaimanLipi !important; background: transparent;}
    .box{
        border: 1px solid gray;
        height: 50px;
        text-align: center;
        width: 180px;
    }
    .table tr td{
        word-wrap:break-word;
    }
    </style>
</head>
<body style="font-family:SolaimanLipi;">
    
        <img src="<?php echo(\Config::get('app.url').'/public/images/1832307968.jpg');?>" width="10%" alt="">
        <h3 style="font-family: MigMix 2p; text-align: center;">
        আমা
</h3>
        <br/>

    <br>
    <br>
    <table class="table table-bordered" style="text-align: center;">
        <tr>
            <td width="5%">No</td>
            <td width="30%">sdfsd</td>
            <td width="10%">sdfsdf</td>
            <td width="10%">sdf</td>
            <td width="10%">sdfsdf</td>
            <td width="10%">sdfsdf</td>
            <td width="25%">sdfsdfds</td>
        </tr>
    
    </table>
</body>
</html>