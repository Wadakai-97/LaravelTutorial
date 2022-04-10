<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $Sale = 'sales';
    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    // test_product belongsTo
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
