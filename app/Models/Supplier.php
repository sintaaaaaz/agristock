<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'phone',
        'email',
        'address'
    ];

    public function incomingGoods()
    {
        return $this->hasMany(IncomingGood::class);
    }
}
