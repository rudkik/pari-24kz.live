<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = ['dogovor_id', 'name', 'odds'];

    public function dogovor()
    {
        return $this->belongsTo(Dogovor::class);
    }
}
