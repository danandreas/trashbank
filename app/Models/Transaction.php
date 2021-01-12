<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Transaction extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'transactions';

    protected $fillable = [
        'bank_id',
        'name',
        'description',
        'price_per_weight',
    ];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }

    public function transaction_detail(){
    	return $this->hasMany(TransactionDetail::class);
    }
}
