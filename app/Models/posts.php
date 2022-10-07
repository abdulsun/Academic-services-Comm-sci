<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class posts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'post_name',
        'img_post',
        'content',
        'admin'
    ];
}
