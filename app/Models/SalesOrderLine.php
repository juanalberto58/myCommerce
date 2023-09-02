<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $table = 'sale_order_lines';

    protected $fillable = [
        'sale_id',
        'quantity',
        'product_id',
        'wholesale_price',
        'tax',
        'margin',
        'total',
        'salePrice',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
