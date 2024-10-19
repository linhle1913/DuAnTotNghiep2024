<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class); 
    }

    public function status()
{
    return $this->belongsTo(Status::class, 'status_id');
}

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
