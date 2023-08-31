<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
{
    protected $table = 'purchase_order_lines';

    protected $fillable = [
        'purchase_id',
        'quantity',
        'product_id',
        'wholesale_price',
        'price',
        'tax',
        'total',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
