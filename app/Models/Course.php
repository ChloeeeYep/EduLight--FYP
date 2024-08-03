<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description' ,
        'photo' ,
        'price' ,
        'duration' ,
        'instructor' ,
        'type' ,
        'level' ,
        'lesson' ,
        'language' ,
        'learn1' ,
        'learn2' ,
        'learn3',
        'status',
    ];

    public function videos()
    {
        return $this->hasMany(Videos::class, 'courseId');
    }


}
