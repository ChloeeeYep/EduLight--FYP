<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'userId',
        'name',
        'total',
        'paymentMethod',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'orderId');
    }
}
