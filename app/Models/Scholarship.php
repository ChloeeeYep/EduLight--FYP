<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $table = 'scholarship';

    protected $primaryKey = 'id';

    protected $fillable = [
        'userId',
        'title',
        'type' ,
        'fundType' ,
        'academic' ,
        'requirement' ,
        'description' ,
        'website' ,
        'file' ,
        'status' ,
    ];

    public function user()
    {
        // 'userId' is the foreign key in 'scholarship' table that relates to 'id' in 'users' table
        return $this->belongsTo('App\Models\User', 'userId');
    }

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'scholarshipId');
    }

}
