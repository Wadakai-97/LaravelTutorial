<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;

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

    // salesテーブル hasMany
    public function sales() {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }

    // companiesテーブル belongs to
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
