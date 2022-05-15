@extends('layout')
@section('title', '新規登録')
@section('content')
<h3>商品情報新規登録</h3>
@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
@endif
<table>
    <thead>
        <tr>
            <th>商品名</th>
            <th>メーカー</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>コメント</th>
            <th>商品画像</th>
        </tr>
    </thead>
    <form action="" method="post" enctype="multipart/form-data">
    @csrf
    <tbody>
        <tr>
            <td value="商品名"><input type="text" name="product_name"></td>
            <td value="メーカー">
                <select name="company_id">
                    <option disabled selected>未選択</option>
                    @foreach ($products->unique('company_id') as $product)
                    <option value="{{ $product->company_id }}" name="company_id">{{ $product->company->company_name }}</option>
                    @endforeach
                </select>
            </td>
            <td value="価格"><input type="tel" name="price"></td>
            <td value="在庫数"><input type="tel" name=stock></td>
            <td value="コメント"><textarea name="comment"></textarea></td>
            <td value="商品画像"><input type="file" name="img_path"></td>
            <td><input type="submit" value="登録"></td>
        </tr>
    </tbody>
    </form>
</table>
<button onclick="location.href='{{ route('product.list') }}'">戻る</button>
@endsection
