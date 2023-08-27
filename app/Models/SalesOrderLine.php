<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $table = 'sale_order_lines';

    protected $fillable = [
        'sale_id',
        'reference',
        'quantity',
        'supplier',
        'wholesale_price',
        'tax',
        'margin',
        'total',
        'salePrice',
    ];

    // public function sale()
    // {
    //     return $this->belongsTo(Sale::class);
    // }
}
