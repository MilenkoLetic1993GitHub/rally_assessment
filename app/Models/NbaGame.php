<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NbaGame extends Model
{
    use HasFactory;

    protected $fillable = ['away_team_id', 'home_team_id', 'away_team_score', 'home_team_score'];
}
