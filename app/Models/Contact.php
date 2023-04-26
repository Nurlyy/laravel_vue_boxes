<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'contact';
    protected $fillable = ['phone_number', 'email', 'address'];


    /**
     * Find a contact by ID
     *
     * @param int $id
     * @return Contact|null
     */
    public static function findById(int $id): ?Contact
    {
        return self::find($id);
    }
}