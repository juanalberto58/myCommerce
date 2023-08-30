<?php

namespace App\Models;
use App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'dni',
        'name',
        'lastname',
        'email',
        'type',
        'address',
        'phone',
        'user_id'
    ];

    public static function createContact($data,$selectedType)
    {
        $contact = self::create([
            'dni' => $data['dni'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'type' => $selectedType,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'user_id' => auth()->id()
        ]);
    
        return $contact;
    }
}

?>

