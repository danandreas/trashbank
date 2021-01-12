<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $guard = 'banks';
    protected $table = 'banks';
    protected $fillable = ['code','name','phone','address'];

    public function employee(){
    	return $this->hasMany(Employee::class);
    }

    public function customer(){
    	return $this->hasMany(Customer::class);
    }

    public function savings(){
    	return $this->hasMany(Saving::class);
    }

    public function message(){
    	return $this->hasMany(Message::class);
    }

    public function transaction(){
    	return $this->hasMany(Transaction::class);
    }
}
