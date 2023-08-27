<?php

namespace App\Models;
use App\Models\Purchase;
use App\Models\PurchaseOrderLine;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';

    protected $fillable = [
        'date',
        'contact_id',
        'user_id',
        'tax_base',
        'tax',
        'total',
    ];

    public function purchaseLines()
    {
        return $this->hasMany(PurchaseOrderLine::class);
    }

    public static function createPurchase($data)
    {
        $purchase = self::create([
            'date' => $data['date'],
            'contact_id' => $data['contact_id'],
            'user_id' => $data['user_id'],
            'tax_base' => $data['tax_base'],
            'tax' => $data['tax'],
            'total' => $data['total'],
        ]);

        foreach ($data['lineasPedido'] as $linea) {
            $purchaseOrderLine = PurchaseOrderLine::create([
                'purchase_id' => $purchase->id,
                'reference' => $linea['reference'],
                'quantity' => $linea['quantity'],
                'supplier' => $linea['supplier'],
                'wholesale_price' => $linea['tax_base'],
                'tax' => $linea['tax'],
                'total' => $linea['total'],
            ]);
        }
    
        return $purchase;
    }
}

?>
