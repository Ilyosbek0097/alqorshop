<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpenses extends Model
{
    use HasFactory;
    protected $primaryKey = 'income_expense_id';
    protected $fillable = [
        'income_expense_id',
        'summa',
        'date',
        'comment',
        'status',
        'tip',
        'customer_id',
        'order_number',
        'delete_status'
    ];


}
