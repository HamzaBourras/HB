<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "sector_id",
        "description",
        "file",
        "user_id"
    ];


    public function user () {
        return $this->belongsTo(User::class);
    }

    public function sector () {
        return $this->belongsTo(Sector::class);
    }
}
