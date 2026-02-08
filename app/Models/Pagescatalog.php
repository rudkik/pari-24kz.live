<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagescatalog extends Model
{
    use HasFactory;
    protected $table = 'pagescatalog';
    protected $fillable = ['id', 'title', 'txt','slug', 'created_at', 'updated_at'];
    protected  $guarded = ['id'];
}
