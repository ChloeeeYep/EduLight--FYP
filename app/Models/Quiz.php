<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'question',
        'correct',
        'wrong1',
        'wrong2',
        'wrong3',
    ];
}
