<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_address',
        'phone_number',
    ];
}
