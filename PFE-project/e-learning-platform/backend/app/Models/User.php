<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "username",
        "firstName",
        "lastName",
        "email",
        "password",
        "role_id",
        "departement_id",
        "sector_id",
        "bio"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    // if user is a professor

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'sectors_users', 'users_id', 'sectors_id');
    }

    public function qcms()
    {
        return $this->hasMany(Qcm::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // if user is a student
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
