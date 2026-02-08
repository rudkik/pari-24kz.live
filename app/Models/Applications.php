<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = ['id', 'fio', 'phone', 'ref', 'created_at', 'updated_at'];
    protected  $guarded = ['id'];
    public $timestamps = false;
}
