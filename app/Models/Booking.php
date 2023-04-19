<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
      'user_id',
      'room_id',
      'check_in',
      'check_out',
      'amount',
      'payment_by',
      'card_no',
      'cvc_no',
      'month',
      'year',
      'status',
    ];



  public function user(){
    return $this->hasOne('\App\Models\User', 'id', 'user_id');
  }


  public function room(){
    return $this->hasOne('\App\Models\Room', 'id', 'room_id');
  }
}
