<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $primaryKey = 'StationCode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'StationCode',
        'StationName',
        'Latitude',
        'Longitude',
    ];
}

