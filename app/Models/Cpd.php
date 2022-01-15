<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpd extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'network', 'email', 'staff_id', 'region', 'district', 'circuit'];
}
