<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo( Account::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sourceTransactions()
    {
        return $this->hasMany(Transaction::class, 'source_card_id');
    }

    public function destinationTransactions()
    {
        return $this->hasMany(Transaction::class, 'destination_card_id');
    }
}
