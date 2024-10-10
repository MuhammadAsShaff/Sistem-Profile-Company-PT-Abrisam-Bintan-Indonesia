<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiStreaming extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows Laravel's naming convention)
    protected $table = 'aplikasi_streaming';

    // Specify the primary key field name (optional if it's 'id')
    protected $primaryKey = 'id_aplikasi';

    // Define the fillable attributes for mass assignment
    protected $fillable = ['nama_aplikasi'];

    // Disable auto-increment if the primary key is not auto-incrementing
    public $incrementing = true;

    // Define the data type of the primary key
    protected $keyType = 'int';
}
