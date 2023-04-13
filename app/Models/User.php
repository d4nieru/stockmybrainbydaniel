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
        'name',
        'email',
        'admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'user_workspace')->withPivot('ownership', 'admin')->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_workspace')->withTimestamps();
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_user')->withPivot("workspace_id")->withTimestamps();
    }

    public function googleAccounts()
    {
        return $this->hasMany(GoogleAccount::class);
    }
}