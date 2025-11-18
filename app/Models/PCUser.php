<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PCUser extends Model
{
    protected $fillable = [
        'departement_id',
        'initial',
        'name',
        'has_pc',
        'ip_lan',
        'ip_wifi'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
