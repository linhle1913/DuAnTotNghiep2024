<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_types'; //merge thì lấy chỗ này nhé, sửa lại tên bảng

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomTypeImages()
    {
        return $this->hasMany(RoomTypeImage::class);
    }

}
