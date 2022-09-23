<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getIncome($id){
        $data = IncomeExpenses::select(DB::raw("SUM(income_expenses.summa) as chiqim"))
            ->where('income_expenses.customer_id','!=','0')
            ->where('income_expenses.status','=', '0')
            ->where('income_expenses.tip','=', '0')
            ->where('income_expenses.delete_status','=', '0')
            ->where('income_expenses.customer_id','=', $id)
            ->first();

        return $data->chiqim;
    }

    public function getExpense($id){
        $data = IncomeExpenses::select(DB::raw("SUM(income_expenses.summa) as kirim"))
            ->where('income_expenses.customer_id','!=','0')
            ->where('income_expenses.status','=', '1')
            ->where('income_expenses.tip','=', '0')
            ->where('income_expenses.delete_status','=', '0')
            ->where('income_expenses.customer_id','=', $id)
            ->first();

        return $data->kirim;
    }
}
