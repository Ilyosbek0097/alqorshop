<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code',
        'barcode',
        'product_name'

    ];
}
