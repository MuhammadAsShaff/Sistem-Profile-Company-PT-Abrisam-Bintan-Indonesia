<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    // Define the table name (optional if the name follows Laravel's convention)
    protected $table = 'paket';

    // Specify the primary key
    protected $primaryKey = 'id_paket';

    // Fields that are mass assignable
    protected $fillable = ['nama_paket','deskripsi'];

    // Specify that primary key is not auto-incrementing (since you are using the default)
    public $incrementing = true;
    // Timestamps are enabled by default, no need to specify

    // Relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_paket');
    }
}
