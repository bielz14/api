<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamUser extends Pivot
{
    protected $table = 'team_user'; // Убедитесь, что имя таблицы правильно

    protected $fillable = [
        'team_id',
        'user_id',
        // Добавьте дополнительные поля, если они есть
    ];

    // Связь с моделью Team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Связь с моделью User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
