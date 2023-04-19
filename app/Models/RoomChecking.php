<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChecking extends Model
{
    use HasFactory;
    protected $table = 'room_checkings';
    protected $fillable = [
      'room_id', 'booking_id', 'start_date', 'end_date', 'status'
    ];
}
