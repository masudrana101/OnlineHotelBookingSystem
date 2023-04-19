<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
      'hotel_id',
      'room_type_id',
      'room_number',
      'amount',
      'description',
      'attached_bath',
      'type',
    ];

  public function roomType()
  {
    return $this->hasOne('\App\Models\RoomType', 'id', 'room_type_id');
  }

  public function hotel()
  {
    return $this->hasOne('\App\Models\Hotel', 'id', 'hotel_id');
  }
}
