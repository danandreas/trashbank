<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'bank_id',
        'account_number',
        'name',
        'gender',
        'phone',
        'address',
        'saldo',
        'email',
        'password',
        'status',
    ];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
}
