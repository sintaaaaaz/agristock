<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoodDetail extends Model
{
    protected $fillable = [
        'incoming_good_id',
        'product_id',
        'quantity',
        'purchase_price'
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
    ];

    public function incomingGood()
    {
        return $this->belongsTo(IncomingGood::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
