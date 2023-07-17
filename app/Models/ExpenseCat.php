<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCat extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_type',
        
    ];

}
