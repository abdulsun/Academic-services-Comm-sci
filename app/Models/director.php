<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class director extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [   
        'name',
        'keyword',
        'date_back',
        'location',
        'year'
    ];
}
