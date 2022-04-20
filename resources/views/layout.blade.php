<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <head><h2 class="body_title">商品管理システム</h2></head>
    @yield('content')
    <footer><p>Copyright © 2022 Kaito Wada</p></footer>
</body>
</html>
