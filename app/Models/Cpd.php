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

    protected $dateFormat = 'Y-m-d H:i:s';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
