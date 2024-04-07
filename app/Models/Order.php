<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'payment_method',
        'payment_status',
        'condition',
        'delivery_charge',
        'delivery_address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }

    // public function productOrders()
    // {
    //     return $this->hasMany(ProductOrder::class);
    // }
}
