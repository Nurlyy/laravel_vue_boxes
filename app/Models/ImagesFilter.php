<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesFilter extends Model
{
    use HasFactory;
    protected $table = 'images_filter';
    protected $fillable = ['id', 'image_id', 'filter_id'];

}
