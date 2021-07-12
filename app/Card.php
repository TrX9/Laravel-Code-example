<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'companyName', 'customerName', 'supplierName', 'companyNumber', 'companyAddress'
    ];
}