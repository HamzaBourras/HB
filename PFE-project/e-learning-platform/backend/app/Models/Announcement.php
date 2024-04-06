<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        "announcement",
        "sector_id",
        "user_id"
    ];

    public function sector () {
        return $this->belongsTo(Sector::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
