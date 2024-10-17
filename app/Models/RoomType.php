<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'rooms_type';

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomTypeImages()
    {
        return $this->hasMany(RoomTypeImage::class);
    }
}
