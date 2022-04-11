<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
// 一覧
    // 商品情報の一覧表示
    public function showList() {
        $products = Product::all();
        $companies = Company::all();
        return view('management.show_list', compact('products', 'companies'));
    }

    // 商品情報の部分一致検索
    public function productSearch(Request $request) {
        $product_keyword = $request->input('product_keyword');
        $company_keyword = $request->input('company_keyword');
        $query = Product::query();
        $companies = Company::all();

        // 部分一致検索
        if (!empty($product_keyword)) {
            $query->where('product_name', 'LIKE', "%{$product_keyword}%");
            $products = $query->get();
        }
        if (!empty($company_keyword)) {
            $query->select('products.*');
            $query->where('company_name', 'LIKE', "%{$company_keyword}%");
            $query->join('companies', function($query) use ($request) {
                $query->on('products.company_id', '=', 'companies.id');
                // dd($query->get());
            });
            $products = $query->get();
        }

        return view('management.show_list', compact('products', 'companies', 'product_keyword', 'company_keyword'));
    }

    // 商品情報の削除
    public function productDelete($id) {
        DB::transaction(function() use ($id) {
            $delete_product = Product::find($id);
            if ($delete_product != null) {
                $delete_product->delete();
                return redirect('product/showist');
            }
        });
        return redirect('product/showlist');
    }
// 詳細
    // 商品詳細画面を表示
    public function showDetail($id) {
        $product = Product::find($id);
        return view('management.show_detail', compact('product'));
    }
// 編集
    // 商品情報編集画面の表示
    public function editView($id) {
        $products = Product::all();
        $product = Product::find($id);
        return view('management.product_edit', compact('products', 'product'));
    }

    // 商品情報の入力情報保存
    public function productEdit($id, Request $request) {
        DB::transaction(function () use ($id, $request) {
            $product = Product::find($id);

            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->save();

            $path = $request->file('img_path')->storeAs('public/img_path', $post->id.'.'.$request->img_path->extension());
            $filename = basename($path);
            $post->img_path = $filename;
            $post->save();
        });
        return back()->withInput();
    }
// 新規登録
    // 商品情報の代入
    public function showForm(Request $request) {
        $query = Product::query();
        $company_keyword = $request->input('company_id');
        $products = $query->get();
        return view('management.new_registration', compact('products','company_keyword'));
    }

    // 商品情報の新規登録
    public function newRegistration(Request $request) {
        DB::transaction(function () use ($request) {
            $post = new Product;
            $request->validate([
                'product_name' => ['required'],
                'company_id' => ['required'],
                'price' => ['required', 'regex:/^[!-~]+$/'],
                'stock' => ['required', 'regex:/^[!-~]+$/'],
            ],
                [
                    'product_name.required' => '必須',
                    'company_id.required' => 'メーカーを選択して下さい。',
                    'price.required' => '価格を入力して下さい。',
                    'stock.required' => '在庫数を入力して下さい。',
                ]);

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
        });
        return redirect('product/newregistration');
    }

}
