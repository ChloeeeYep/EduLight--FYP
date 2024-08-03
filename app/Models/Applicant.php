<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';

    protected $fillable = [
        'scholarshipId',
        'userId',
        'name',
        'gender',
        'birthday',
        'nric',
        'email',
        'address',
        'contact',
        'course',
        'qualification',
        'file',
        'status',
        'universityId'
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'scholarshipId');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university() {
        return $this->belongsTo(User::class, 'universityId');
    }
    
}
