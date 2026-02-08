<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stavka extends Model
{
    use HasFactory;
    protected $table = 'stavka';
    protected $fillable = ['id', 'v', 'k','summa', 'game_id', 'created_at', 'updated_at', 'status', 'user', 'dummy_id'];
    protected  $guarded = ['id'];
}
