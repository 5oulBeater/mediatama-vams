<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoAccess extends Model
{
    protected $fillable = [
        'user_id',
        'video_id',
        'status',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
