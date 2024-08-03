<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $table = 'tutorials';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'details',
        'type',
        'example',
        'question',
        'option1',
        'option2',
    ];
}
