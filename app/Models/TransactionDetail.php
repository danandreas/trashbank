<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TransactionDetail extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'saving_id',
        'income',
    ];

    public function transaction(){
    	return $this->belongsTo(Transaction::class);
    }

    public function savings(){
    	return $this->belongsTo(Saving::class);
    }
}
