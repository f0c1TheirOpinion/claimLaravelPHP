<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'number',
        'email',
        'uslug',
        'comm',
        'status'

    ];
}
