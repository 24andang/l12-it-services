<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PC extends Model
{
    protected $fillable = [
        'p_c_user_id',
        'unit',
        'processor',
        'ram',
        'hdd',
        'ssd',
        'vga',
        'monitor',
        'os'
    ];

    public function pcuser()
    {
        return $this->belongsTo(PCUser::class, 'p_c_user_id');
    }
}
