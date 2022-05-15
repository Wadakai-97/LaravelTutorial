@extends('layout')
@section('title', '商品一覧')
@section('content')
<h3>商品一覧</h3>
<header>
    <form action="" method="POST">
        @csrf
        <label>商品名</label>
            <input type="text" name="product_keyword" id="productKeyword" value=""><br>
        <label>メーカー名</label>
            <select name="company_keyword" id="companyKeyword">
                <option disabled selected></option>
                @foreach ($companies as $company)
                <option>{{ $company->company_name }}</option>
                @endforeach
            </select><br>
        <label>価格（最低〜最高）</label>
            <select name="lowest_price" id="lowestPrice">
                <option disabled selected></option>
                @foreach ($products_price as $product_price)
                <option>{{ $product_price->price }}</option>
                @endforeach
            </select>
        <label>〜</label>
            <select name="highest_price" id="highestPrice">
                <option disabled selected></option>
                @foreach ($products_price as $product_price)
                <option>{{ $product_price->price }}</option>
                @endforeach
            </select><br>
        <label>在庫数（最低〜最高）</label>
        <select name="lowest_stock" id="lowestStock">
            <option disabled selected></option>
            @foreach ($products_stock as $product_stock)
            <option>{{ $product_stock->stock }}</option>
            @endforeach
        </select>
        <label>〜</label>
        <select name="highest_stock" id="highestStock">
            <option disabled selected></option>
            @foreach ($products_stock as $product_stock)
            <option>{{ $product_stock->stock }}</option>
            @endforeach
        </select>
        <input type="submit" value="検索" id="search">
    </form>
    <br><button onclick="location.href='{{ route('product.showForm') }}'">新規登録</button>
</header>
<br>
<table>
    <thead>
        <tr>
            <th id="0" data-sort="">id</th>
            <th id="1" data-sort="">商品画像</th>
            <th id="2" data-sort="">商品名</th>
            <th id="3" data-sort="">価格</th>
            <th id="4" data-sort="">在庫数</th>
            <th id="5" data-sort="">メーカー名</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="showAllProduct">
    </tbody>
    <table></table>
</table>
@endsection
