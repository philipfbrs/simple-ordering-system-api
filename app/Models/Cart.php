<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cart';
    protected $fillable = [
        'id',
        'order_by',
        'product_id',
        'quantity',
        'status'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id','product_id')->select(['id','name','price']);
    }

    public function user(){
        return $this->hasOne(User::class, 'id','order_by')->select(['id','first_name','last_name','email']);
    }
}