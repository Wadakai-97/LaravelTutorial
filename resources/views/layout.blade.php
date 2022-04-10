<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/pop.js') }}"></script>
</head>
<body>
    <head><h2 class="body_title">商品管理システム</h2></head>
    @yield('content')
    <footer><p>Copyright © 2022 Kaito Wada</p></footer>
</body>
</html>
