<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'add_product_id',
        'date',
        'supplier',
        'all_product_id',
        'amount',
        'body_price_usd',
        'body_price_uzs',
        'user_id',
        'invoice_order',
        'check_status',
        'add_comment'
    ];
}
