<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'appointment_user')->withPivot("workspace_id")->withTimestamps();
    }
}
