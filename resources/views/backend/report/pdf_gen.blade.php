<!DOCTYPE html>

<html lang="bangla">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="<?php echo(\Config::get('app.url').'public/css/style.css');?>" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <style>
        @font-face {
            font-family: 'SolaimanLipi';
            /* src: url('http://localhost/super_shop/public/fonts/SolaimanLipi.ttf') format("truetype"); */
            /* src: url('{{ URL::asset('/public/fonts/SolaimanLipi.ttf') }}') format("truetype"); */
            
            src: url("<?php echo(\Config::get('app.url').'public/fonts/SolaimanLipi.ttf'); ?>") format('truetype');
            /* src: url({{ public_path('fonts/SolaimanLipi.ttf') }}) format('truetype'); */
            font-weight: 200;
            font-style: normal;

        }
        </style>

</head>

<body>


    <div class="set">
       
    </div>
    <div class="head">
        <div class="head-left">
            <!-- <img src="<?php echo(\Config::get('app.url') . 'public/images/J1.png');?>"> -->
        </div>
        </div>
   
    <div class="wrap" style="font-family: SolaimanLipi;">
    প্রায় ২,৪৩,০০,০০,০০০টি ফলাফল (০.৩৪ সেকেন্ড) 
     </div>
       
</body>

</html>