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
        'trash_id',
        'trash_detail',
        'weight',
        'buying_price',
        'selling_price',
        'bank_total_price',
        'customer_total_price',
        'profit',
        'payment_method',
        'description',
        'transaction_status',
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

    public function transaction_detail(){
    	return $this->hasMany(TransactionDetail::class);
    }
}
