<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalSales extends Model
{
    use HasFactory;
    protected $primaryKey = 'total_sales_id';
    protected $fillable = [
        'order_number',
        'total_cost',
        'canceled',
        'canceled_date'
    ];
}
