<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'filter';
    protected $fillable = ['id', 'name'];
}
