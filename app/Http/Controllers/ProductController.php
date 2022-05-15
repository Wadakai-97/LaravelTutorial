<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
// 一覧
// 商品情報の一覧表示
    public function showList() {
        $companies = Company::all();
        $products_price = Product::orderBy('price', 'ASC')->get();
        $products_stock = Product::orderBy('stock', 'ASC')->get();
        return view('management.show_list', compact('companies', 'products_price', 'products_stock'));
    }
    // 商品情報の部分一致検索
    public function productSearch(Request $request) {
        $product_keyword = $request->input('product_keyword');
        $company_keyword = $request->input('company_keyword');
        $query = Product::query();
        $companies = Company::all();
        $products_price = Product::orderBy('price', 'ASC')->get();
        $products_stock = Product::orderBy('stock', 'ASC')->get();

        // 部分一致検索
        if (!empty($product_keyword)) {
            $products = Product::searchbyproduct($product_keyword)->get();
        }
        if (!empty($company_keyword)) {
            $products = Product::searchbycompany($company_keyword, $request)->get();
        }
        return view('management.show_list', compact('companies', 'product_keyword', 'company_keyword', 'products_price', 'products_stock'));
    }
    // 商品情報の削除
    public function productDelete($id) {
        DB::transaction(function() use($id) {
            $delete_product = Product::find($id);
            $delete_product->delete();
            $status = '削除に成功しました。';

            return response($status);
            return redirect('product/showlist');
        });
        return redirect('product/showlist');
    }
// 詳細
    // 商品詳細画面を表示
    public function showDetail($id) {
        $product = Product::find($id);
        $companies = Company::all();
        return view('management.show_detail', compact('product', 'companies'));
    }
// 編集
    // 商品情報編集画面の表示
    public function optionView($id) {
        $query = Product::query();
        $product = Product::find($id);
        $products = $query->get();
        return view('management.product_edit', compact('products', 'product'));
    }
    // 商品情報の入力情報保存
    public function productEdit($id, Request $request) {
        DB::transaction(function() use($id, $request) {
            $product = Product::find($id);
            if (!$request->file('img_path')) {
                $product->product_name = $request->product_name;
                $product->price = $request->price;
                $product->stock = $request->stock;
                $product->comment = $request->comment;
                $product->save();
            } else {
                $product = Product::find($id);
                $product->product_name = $request->product_name;
                $product->price = $request->price;
                $product->stock = $request->stock;
                $product->comment = $request->comment;
                $product->save();
                $path = $request->file('img_path')->storeAs('public/img_path', $product->id.'.'.$request->img_path->extension());
                $filename = basename($path);
                $product->img_path = $filename;
                $product->save();
            }
        });
        $query = Product::query();
        $product = Product::find($id);
        $products = $query->get();
        return view('management.product_edit', compact('products', 'product'));
    }
// 新規登録
    // 商品情報の代入
    public function showForm(Request $request) {
        $companies = Company::all();
        $query = Product::query();
        $company_keyword = $request->input('company_id');
        $products = $query->get();
        return view('management.newregistration', compact('products', 'company_keyword'));
    }
    // 商品情報の新規登録
    public function newRegistration(ProductRequest $request) {
        DB::transaction(function() use($request) {
            $post = new Product;

            if (!$request->file('img_path')) {
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
        $query = Product::query();
        $company_keyword = $request->input('company_id');
        $products = $query->get();
        return view('management.newregistration', compact('products', 'company_keyword'));
    }
}
