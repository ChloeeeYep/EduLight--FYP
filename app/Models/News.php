<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'introduction',
        'image',
        'title',
        'description',
        'title1',
        'description1',
    ];
}