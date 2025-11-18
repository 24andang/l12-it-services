<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'asset_id',
        'loaned_at',
        'loans',
        'info',
        'return_at',
        'pic'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
