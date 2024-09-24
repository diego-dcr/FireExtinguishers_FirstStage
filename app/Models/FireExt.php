<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireExt extends Model
{
    use HasFactory;
    protected $table = 'fire_extinguishers';

    protected $fillable = [
        'id',
        'size',
        'type',
        'expiration_date',
        'location',
        'place',
        'floor',
        'observations',
    ];
}
