<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo'; // Defining the table name

    protected $primaryKey = 'id_promo'; // Setting the primary key

    protected $fillable = [
        'nama_promo',
        'gambar_promo',
        'deskripsi',
    ]; // Defining fillable fields

}
