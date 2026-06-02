<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['user_id', 'vehicle_id', 'status', 'phone', 'address', 'notes'];

    public function user() { return $this->belongsTo(User::class); }
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function messages() { return $this->hasMany(Message::class); }


}
