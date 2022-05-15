<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    // 注文記録＋在庫数の減少
    public function order(Request $request, $id) {

        $order = Product::find($id);
        $stock_num = $order->stock;
        $sale = new Sale;

        if($stock_num >= 1) {
            $order->save();
            $order->decrement('stock');
            $sale->product_id = $order->id;
            $sale->save();

            return response()->json($order);
        } else {
            $no_stock = "<script type='text/javascript'>alert('商品の在庫がなくなりました。');</script>";
            echo $no_stock;
            echo "商品の在庫がなくなりました。";
        }
    }
}
