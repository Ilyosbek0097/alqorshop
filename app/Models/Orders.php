<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'all_product_id',
        'ammount',
        'selling_price',
        'order_status',
        'order_comment',
        'user_id',
        'customer_id'
    ];
}
