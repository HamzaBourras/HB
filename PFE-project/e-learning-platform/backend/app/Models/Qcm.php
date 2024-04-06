<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qcm extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "user_id",
        "sector_id",
        "noteTotale"
    ];

    public function sector () {
        return $this->belongsTo(Sector::class);
    }

    public function questions () {
        return $this->hasMany(Question::class);
    }


}
