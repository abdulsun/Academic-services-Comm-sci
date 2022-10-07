<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'news_name',
        'type',
        'description',
        'content',
        'admin'
    ];

    public function admin(){
        return $this->hasOne(admin::class,'id','admin');
    } 
}