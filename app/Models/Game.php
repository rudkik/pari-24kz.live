<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id', 'league_id', 'title', 'team1', 'team2', 'game_start', 'coefficient1',
        'coefficient2', 'coefficient1_min', 'coefficient1_max', 'coefficient2_min',
        'coefficient2_max', 'type'
    ];

    public function sport()
    {
        return $this->belongsTo(Sports::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function updateCoefficientsAndDate($days)
    {
        $this->coefficient1 = self::generateRandomCoefficient($this->coefficient1_min, $this->coefficient1_max);
        $this->coefficient2 = self::generateRandomCoefficient($this->coefficient2_min, $this->coefficient2_max);

        $minDays = (int)$days[0];
        $maxDays = (int)$days[1];
        $randomDays = rand($minDays, $maxDays);
        $this->game_start = now()->addDays($randomDays);

        $this->save();
    }

    public static function generateRandomCoefficient($min, $max)
    {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), 2);
    }


}
