<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dogovor extends Model
{
    use HasFactory;
    protected $table = 'dogovor';
    protected  $guarded = ['id'];
    public $timestamps = true; // Включаем временные метки

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'dogovor_id');
    } 
    protected $fillable = [
        'name',
        'name_1', 
        'name_2',
        'game_start',
        'game_end',
        'p',
        'p_1',
        'p_2', // Убедитесь, что это поле здесь есть
        'd_1',
        'd_2',
        'd_12',
    ];
}
