@extends('layout')
@section('title', '商品一覧')
@section('content')
<h3>商品一覧</h3>
<header>
    <form action="{{ route('product.search') }}" method="post">
        @csrf
        <label>商品名</label>
            <input type="text" name="product_keyword" id="productKeyword">
        <label>メーカー名</label>
            <select name="company_keyword" id="companyKeyword">
                <option disabled selected>未選択</option>
                @foreach ($companies as $company)
                <option>{{ $company->company_name }}</option>
                @endforeach
            </select>
        <input type="submit" value="検索">
    </form>
    <input type="submit" value="新規登録" onclick="{{ route('product.showForm') }}">
</header>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr id="productList">
            <td value="id">{{ $product->id }}</td>
            <td value="商品画像"><img src="{{ asset('/storage/img_path/' . $product->img_path) }}" class="img_path"></td>
            <td value="商品名">{{ $product->product_name }}</td>
            <td value="価格">{{ $product->price }}</td>
            <td value="在庫数">{{ $product->stock }}</td>
            <td value="メーカー名">{{ $product->company->company_name }}</td>
            <td>
                <form action="{{ route('product.showdetail', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <input type="submit" value="詳細表示">
                </form>
            </td>
            <td>
                <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <input type="submit" value="削除" onclick="clickDelete();return false;">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <table></table>
</table>
@endsection
