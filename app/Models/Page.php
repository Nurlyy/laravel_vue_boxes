<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='page';
    protected $fillable = ['id', 'name', 'slug', 'title', 'body', 'keyword', 'description', 'show'];
    
}
