<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "qcm_id",
        "note"
    ];

    public function qcm () {
        return $this->belongsTo(Qcm::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
