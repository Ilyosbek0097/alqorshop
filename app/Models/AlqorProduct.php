<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlqorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'alqor_product_id',
        'product_id',
        'body_price_usd',
        'body_price_uzs',
        'selling_price'
    ];
    // public function all_product_name()
    // {
    // //     return $this->belongsTo(User::class, 'all_product_id', 'product_id');
    // }

}
