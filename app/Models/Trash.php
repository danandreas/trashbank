<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;
    protected $guard = 'trashes';
    protected $table = 'trashes';
    protected $fillable = ['name'];
    //public $timestamps = false;
}
