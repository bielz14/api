<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // Связь "один ко многим" с TeamUser
    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class);
    }

    // Связь "многие ко многим" с Team через TeamUser
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->using(TeamUser::class)
            ->withTimestamps();
    }

    // Связь с задачами
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
