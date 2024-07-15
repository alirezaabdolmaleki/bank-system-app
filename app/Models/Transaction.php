<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_card_id',
        'destination_card_id',
        'amount'
    ];

    public function fee()
    {
        return $this->hasOne(Fee::class);
    }

    public function sourceCard()
    {
        return $this->belongsTo(Card::class, 'source_card_id');
    }

    public function destinationCard()
    {
        return $this->belongsTo(Card::class, 'destination_card_id');
    }
}
