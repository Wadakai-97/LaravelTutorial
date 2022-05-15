@extends('layout')
@section('title', '商品情報編集')
@section('content')
<h3>商品情報編集画面</h3>
<table>
    <thead>
        <tr>
            <th>商品情報ID</th>
            <th>商品名</th>
            <th>メーカー</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>コメント</th>
            <th>商品画像</th>
        </tr>
    </thead>
    <form action="{{ route('product.edit', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
    <tbody>
        <tr>
            <td>{{ $product->id }}</td>
            <input type="hidden" name="_method" value="PATCH">
            <td><input type="text" name="product_name" value="{{ $product->product_name }}"></td>
            <input type="hidden" name="_method" value="PATCH">
            <td>
                <select name="company_keyword" value="{{ $product->company->company_name}}">
                    @foreach ($products->unique('company_id') as $company)
                    <option value="{{ old('$company->company_id') }}">{{ $company->company->company_name }}</option>
                    @endforeach
                </select>
            </td>
            <input type="hidden" name="_method" value="PATCH">
            <td><input type="number" name="price" value="{{ $product->price }}"></td>
            <input type="hidden" name="_method" value="PATCH">
            <td><input type="number" name="stock" value="{{ $product->stock }}"></td>
            <input type="hidden" name="_method" value="PATCH">
            <td><textarea name="comment">{{ $product->comment }}</textarea></td>
            <input type="hidden" name="_method" value="PATCH">
            <td><img src="{{ asset('/storage/img_path/' . $product->img_path) }}" class="img_path"><input type="file" name="img_path" accept="image/jpeg" value="{{ $product->img_path }}"></td>
            <td><input type="submit" value="更新"></td>
        </tr>
    </tbody>
    </form>
</table>
<form action="{{ route('product.showdetail', ['id' => $product->id]) }}" enctype="multipart/form-data">
    @csrf
    <button>戻る</button>
</form>
@endsection
