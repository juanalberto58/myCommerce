<?php

namespace App\Models;
use App\Models\Sale;
use App\Models\SalesOrderLine;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'date',
        'contact_id',
        'user_id',
        'tax_base',
        'tax',
        'margin',
        'total',
    ];

    
    public function saleLines()
    {
        return $this->hasMany(SalesOrderLine::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createSale($data)
    {
        $sale = self::create([
            'date' => $data['date'],
            'contact_id' => $data['contact_id'],
            'user_id' => $data['user_id'],
            'tax_base' => $data['tax_base'],
            'tax' => $data['tax'],
            'margin' => $data['margin'],
            'total' => $data['total'],
        ]);

        foreach ($data['lineasPedido'] as $linea) {
            $saleOrderLine = SalesOrderLine::create([
                'sale_id' => $sale->id,
                'quantity' => $linea['quantity'],
                'product_id' => $linea['product_id'],
                'wholesale_price' => $linea['tax_base'],
                'tax' => $linea['tax'],
                'margin' => $linea['margin'],
                'total' => $linea['total'],
                'salePrice' => $linea['salePrice'],
            ]);
        }
    
        return $sale;
    }
}

?>
