<?php

namespace App\Models;

use App\Models\WithdrawalRequest;
use Laravel\Sanctum\HasApiTokens;
use App\Models\VerificationRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'country',
        'label_admin',
        'socument_suc',
        'ban',
        'no_money',
        'no_vivod',
        'no_transfer',
        'money',
        'cur',
        'bonus',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public function depositHistory()
    {
        return $this->hasMany(DepositHistory::class);
    }

    public function verificationRequest()
    {
        return $this->hasMany(VerificationRequest::class);
    }

}
