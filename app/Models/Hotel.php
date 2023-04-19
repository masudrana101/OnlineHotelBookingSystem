<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  use HasFactory;
  protected $table = 'hotels';
  protected $fillable = [
    'manager_id',
    'district_id',
    'name',
    'phone',
    'email',
    'logo',
    'address',
    'status',
  ];

  public function district()
  {
    return $this->hasOne('\App\Models\District', 'id', 'district_id');
  }

  public function rooms()
  {
    return $this->hasMany('\App\Models\Room', 'hotel_id', 'id');
  }
}
