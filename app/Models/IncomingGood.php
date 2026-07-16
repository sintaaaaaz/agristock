<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGood extends Model
{
    protected $fillable = [
        'supplier_id',
        'transaction_code',
        'transaction_date',
        'note'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function incomingGoodDetails()
    {
        return $this->hasMany(IncomingGoodDetail::class);
    }
}
