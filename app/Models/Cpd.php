<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'network', 'email', 'staff_id', 'region', 'district', 'circuit', 'reference', 'attended'
    ];

    protected $cast = [
        'created_at' => 'datetime',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
