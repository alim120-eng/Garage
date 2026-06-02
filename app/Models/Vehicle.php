<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //


protected $fillable  = ['user_id', 'type', 'brand', 'model', 'year', 'price', 'image', 'status', 'images', 'mileage', 'fuel_type', 'color', 'description'];

protected $casts = [
    'images' => 'array',
];

public function orders() { return $this->hasMany(Order::class); }
public function seller() { return $this->belongsTo(User::class, 'user_id'); }
  
}