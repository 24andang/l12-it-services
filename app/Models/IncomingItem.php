<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingItem extends Model
{
    protected $fillable = [
        'item_id',
        'incoming_date',
        'qty',
        'pic'
    ];

    public function item()
    {
        return $this->hasOne(Item::class);
    }
}
