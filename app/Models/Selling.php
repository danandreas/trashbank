<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;
    protected $table = 'sellings';
    protected $fillable = ['bank_id','name','date_start','date_end','status'];

    public function savings(){
    	return $this->hasMany(Saving::class);
    }

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
}