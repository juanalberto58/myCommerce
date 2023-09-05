<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Purchase;

class PurchaseControllerTest extends TestCase
{
    public function test_create_new_purchase(): void
    {
        $data = [
            'date' => '2023-08-31',
            'contact_id' => 14, 
            'user_id' => 2,
            'tax_base' => '21',
            'tax' => 21,
            'total' => 121,
            'lineasPedido' => [
                [
                    'product_id' => 12,
                    'quantity' => 5,
                    'wholesale_price' => 20,
                    'tax' => 21,
                    'total' => 100,
                ],
            ],
        ];
    
        $response = $this->json('POST', route('store.purchases'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('purchases', [
            'date' => $data['date'],
            'contact_id' => $data['contact_id'],
            'user_id' => $data['user_id'],
            'tax_base' => $data['tax_base'],
            'tax' => $data['tax'],
            'total' => $data['total'],
        ]);
    
        $this->assertDatabaseHas('purchase_order_lines', [
            'product_id' => $data['lineasPedido'][0]['product_id'],
            'quantity' => $data['lineasPedido'][0]['quantity'],
            'wholesale_price' => $data['lineasPedido'][0]['wholesale_price'],
            'tax' => $data['lineasPedido'][0]['tax'],
            'total' => $data['lineasPedido'][0]['total'],
        ]);
    
        $response->assertJson(['success' => true]);
    }
    
    
    
}
