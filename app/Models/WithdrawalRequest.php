<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'details', 'reason_for_rejection', 'sum', 'payment_gateway', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
