<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\AlqorProduct;

class AllProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'all_product_id';
    protected $fillable = [
        'all_product_id',
        'product_code',
        'barcode',
        'product_name'

    ];
    public function alqor_product()
    {
        return $this->hasOne('App\Models\AlqorProduct','product_id','all_product_id');
    }
}
