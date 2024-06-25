<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $primaryKey = 'TrainNumber';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'TrainNumber',
        'TrainName',
        'Route',
    ];

    protected $casts = [
        'Route' => 'array',
    ];

    public function getRouteAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function setRouteAttribute($value)
    {
        $this->attributes['Route'] = is_array($value) ? implode(',', $value) : $value;
    }
}
