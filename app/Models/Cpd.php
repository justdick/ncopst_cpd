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

    public function getCreatedAtAttribute()
    {
        return $this->created_at->format('yyyy-mm-dd H:i:s');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
