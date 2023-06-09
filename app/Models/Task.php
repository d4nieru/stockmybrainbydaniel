<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'user_workspace')->withPivot('ownership', 'admin')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workspace')->withPivot('ownership', 'admin')->withTimestamps();
    }
}
