<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>NBOOKS - Nhà Sách Trực Tuyến</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logos/logo.png') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body>
         @include('partials.header')
    
        <main>
        @yield('content')
        
        </main>

         @include('partials.footer')

       
    </body>
    </html>