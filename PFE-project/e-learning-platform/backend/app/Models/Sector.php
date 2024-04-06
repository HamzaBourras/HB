<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "departement_id"
    ];

    public function departement () {
        return $this->belongsTo(Departement::class);
    }

    public function tasks () {
        return $this->hasMany(Task::class);
    }

    //if user is a professor 
    public function user()
    {
        return $this->belongsToMany(User::class, 'sectors_users', 'sectors_id', 'users_id');
    }


    // if user is astudent
    public function users() {
        return $this->hasMany(User::class);
    }


    public function documents () {
        return $this->hasMany(Document::class);
    }

    public function qcms () {
        return $this->hasMany(Qcm::class);
    }

    public function announcements () {
        return $this->hasMany(Announcement::class);
    }
}
