<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'reference',
        'name',
        'description',
        'weight',
        'width',
        'height',
        'length',
        'height',
        'price',
        'stock',
        'image',
        'user_id',
        'contact_id'
    ];
}

?>
