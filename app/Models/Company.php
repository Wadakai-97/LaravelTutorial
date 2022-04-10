<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
        'created_at',
        'updated_at',
    ];

    // product hasMany
    public function products() {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }
}
