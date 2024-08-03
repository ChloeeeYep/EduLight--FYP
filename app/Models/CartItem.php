<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cartitem';

    protected $fillable = [
        'cartId', 
        'courseId',
        'courseName',
        'courseLevel',
        'coursePrice',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }
}
