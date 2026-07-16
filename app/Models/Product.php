<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_code',
        'product_name',
        'unit_id',
        'purchase_price',
        'stock',
        'minimum_stock',
        'image',
        'description',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incomingGoodDetails()
    {
        return $this->hasMany(IncomingGoodDetail::class);
    }

    public function outgoingGoodDetails()
    {
        return $this->hasMany(OutgoingGoodDetail::class);
    }

    public function unit()
{
    return $this->belongsTo(Unit::class);
}
}
