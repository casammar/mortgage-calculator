<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    protected $fillable = [
        'loan_type',
        'loan_value',
        'years',
        'interest_rate'
    ];
}
