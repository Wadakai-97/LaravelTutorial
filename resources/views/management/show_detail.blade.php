@extends('layout')
@section('title', '商品詳細')
@section('content')
<h3>商品情報詳細</h3>

<table>
    <thead>
        <tr>
            <th>商品情報ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>メーカー</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>コメント</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td value="商品情報ID">{{ $product->id }}</td>
            <td value="商品画像">{{ $product->img_path }}</td>
            <td value="商品名">{{ $product->product_name }}</td>
            <td value="メーカー">{{ $product->company->company_name }}</td>
            <td value="価格">{{ $product->price }}</td>
            <td value="在庫数">{{ $product->stock }}</td>
            <td value="コメント">{{ $product->comment }}</td>
            <td>
                <form action="/tutorial/public/product/edit/{{ $product->id }}" method="POST">
                    @csrf
                    <input type="submit" value="編集">
                </form>
            </td>
        </tr>
    </tbody>
</table>

<input type="submit" value="戻る" onclick="location.href='/tutorial/public/product/showlist'">
@endsection
