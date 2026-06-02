<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    //

  protected $fillable = [
    'user_id',
    'type',
    'brand',
    'model',
    'year',
    'issue',
    'status',
    'cost',
    'duration',
    'image',
    'images'
];

protected $casts = [
    'images' => 'array',
];

public function user() { return $this->belongsTo(User::class); }

}
