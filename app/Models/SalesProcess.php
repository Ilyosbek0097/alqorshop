<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProcess extends Model
{
    use HasFactory;
    protected $table = "sales_process";
    protected $primaryKey = 'sales_id';

    protected $fillable = [
        'sales_id',
        'customer_id',
        'sales_date',
        'all_product_id',
        'sales_price_final',
        'sales_amount',
        'order_id',
        'order_number',
        'canceled',
        'canceled_date'
    ];
}
