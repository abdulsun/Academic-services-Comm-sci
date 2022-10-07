<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class lucture extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'year',
        'keyword',
        'lucture_name',
        'project_name',
        'date_start',
        'date_end',
        'location'
    ];
}
