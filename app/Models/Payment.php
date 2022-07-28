<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'name', 'phone', 'reference', 'network', 'staff_id', 'email', 'region', 'district', 'circuit'];

    public function cpds()
    {
        return $this->hasMany(Cpd::class);
    }

}
