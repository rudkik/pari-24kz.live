<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description', 'image', 'sport_id'];

    public function sport()
    {
        return $this->belongsTo(Sports::class, 'sport_id');
    }
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
