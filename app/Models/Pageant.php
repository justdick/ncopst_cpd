<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pageant extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'contact', 'dateofbirth', 'gender', 'schoolname', 'image', 'inspiration'];
}
