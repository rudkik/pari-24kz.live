<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zayavki extends Model
{
    use HasFactory;
    protected $table = 'zayavki';
    protected $fillable = ['id', 'name', 'phone', 'created_at', 'updated_at'];
    protected  $guarded = ['id'];
}
