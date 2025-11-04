<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handover extends Model
{
    protected $fillable = [
        'item_id',
        'qty',
        'outcoming_date',
        'recipient',
        'info',
        'status',
        'pic'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
