<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='main_page';
    protected $fillable = ['title', 'header', 'body', 'foot_text', 'description'];
    
}
