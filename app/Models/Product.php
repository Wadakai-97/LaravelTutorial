<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Support\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at',
    ];
    // 商品情報の新規登録
    public function editDataSave(ProductRequest $request) {
        DB::transaction(function () use ($request) {
            $post = new Product;

            if(!$request->file('img_path')) {
                $post->product_name = $request->product_name;
                $post->company_id = $request->company_id;
                $post->price = $request->price;
                $post->stock = $request->stock;
                $post->comment = $request->comment;
                $post->save();
            } else {
                $post->product_name = $request->product_name;
                $post->company_id = $request->company_id;
                $post->price = $request->price;
                $post->stock = $request->stock;
                $post->comment = $request->comment;
                $post->save();

                $path = $request->file('img_path')->storeAs('public/img_path', $post->id.'.'.$request->img_path->extension());
                $filename = basename($path);
                $post->img_path = $filename;
                $post->save();
            };
        });
        return $post->save();
    }
    // 商品名検索
    public function scopeSearchByProduct($query, $product_keyword) {
        return $query->where('product_name', 'LIKE', "%{$product_keyword}%");
    }
    // 会社名検索
    public function scopeSearchByCompany($query, $company_keyword, $request) {
        return $query->select('products.*')
        ->where('company_name', 'LIKE', "%{$company_keyword}%")
        ->join('companies', function($query) use ($request) {
        $query->on('products.company_id', '=', 'companies.id');
        });
    }
    // salesテーブル hasMany
    public function sales() {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }
    // companiesテーブル belongs to
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
