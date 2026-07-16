<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingGoodDetail extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'purchase_price',
    ];

    public function outgoingGood()
    {
        return $this->belongsTo(OutgoingGood::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
