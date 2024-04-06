<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "taskName",
        "user_id",
        "sector_id",
        "description",
        "deadline"
    ];
    

    public function sector () {
        return $this->belongsTo(Sector::class);
    }

    public function submissions () {
        return $this->hasMany(Submission::class);
    }
}
