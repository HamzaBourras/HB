<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CHOIX extends Model
{
    use HasFactory;

    protected $fillable = [
        "text",
        "tr_fl",
        "question_id"
    ];
}
