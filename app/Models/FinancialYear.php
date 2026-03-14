<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    protected $fillable = ['year'];

    public function monthlySales()
    {
        return $this->hasMany(MonthlySale::class);
    }
}
