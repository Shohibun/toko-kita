<?php

// Model merupakan jembatan antara database dan code PHP
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Memungkinkan penggunaan factory (seeding, testing)
use Illuminate\Database\Eloquent\Model; // Parent class untuk semua model Eloquent

class Product extends Model
{
    use HasFactory;

    // $fillable adalah whitelist field
    // $Dengan $fillable, laravel hanya mengizinkan field yang telah ditentukan
    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];
}
