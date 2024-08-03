<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderitem';

    protected $fillable = [
        'orderId ',
        'courseId ',
        'name',
        'price',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

}
