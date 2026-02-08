<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $table = 'catalog';
    protected $fillable = ['id', 'img', 'title','desc','price_new','price_old','text_full','marka','korobka','type_toplivo','year', 'created_at', 'updated_at'];
    protected  $guarded = ['id'];
}
