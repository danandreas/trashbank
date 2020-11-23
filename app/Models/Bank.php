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
    	return $this->hasMany('App\Models\Employee');
    }
}
