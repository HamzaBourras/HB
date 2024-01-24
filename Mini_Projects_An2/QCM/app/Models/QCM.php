<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QCM extends Model
{
    use HasFactory;

    protected $table = "q_c_m_s";

    protected $fillable = [
        "title",
        "user_id"
    ];

    public function questions () {
        return $this->HasMany(Question::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
