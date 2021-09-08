<?php

namespace App\Models;

class Product
{
    use HasFactory;
    protected $table='products';
    protected $fillable=['product_code','product_name','product_price','product_image'];
}
