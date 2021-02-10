<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Saving extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'savings';

    protected $fillable = [
        'customer_id',
        'bank_id',
        'selling_id',
        'trash_id',
        'trash_detail',
        'quantity',
        'unit',
        'buying_price',
        'selling_price',
        'payment_method',
        'description',
    ];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }

    public function trash(){
    	return $this->belongsTo(Trash::class);
    }

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    public function selling(){
    	return $this->belongsTo(Selling::class);
    }

    // public function transaction_detail(){
    // 	return $this->hasMany(TransactionDetail::class);
    // }
}
