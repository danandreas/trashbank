<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = ['bank_id','customer_id','sender','message'];

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
}
