<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingGood extends Model
{
    protected $fillable = [
        'transaction_code',
        'supplier_id',
        'transaction_date',
        'purpose',
        'user_id',
        'note',
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function outgoingGoodDetails()
    {
        return $this->hasMany(OutgoingGoodDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
