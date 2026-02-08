<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sports extends Model
{
    use HasFactory;
    protected $table = 'sports';
    protected $fillable = ['id', 'title', 'img', 'id_api', 'created_at', 'updated_at'];
    protected  $guarded = ['id'];

    public function leagues()
    {
        return $this->hasMany(League::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
