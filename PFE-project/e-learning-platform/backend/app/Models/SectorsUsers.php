<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorsUsers extends Model
{
    use HasFactory;

    protected $table = "sectors_users";

    protected $fillable = [
        'sectors_id',
        'users_id'
    ];
}
