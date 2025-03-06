<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = ['country', 'currency_name', 'currency_symbol', 'currency_code'];
}
