<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Связь "один ко многим" с TeamUser
    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class);
    }

    // Связь "многие ко многим" с User через TeamUser
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->using(TeamUser::class)
            ->withTimestamps();
    }

    // Связь с задачами
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
