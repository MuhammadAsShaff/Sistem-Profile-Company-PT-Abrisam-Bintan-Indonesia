<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaQ extends Model
{
    use HasFactory;

    // Define the table name (optional if the name follows Laravel's convention)
    protected $table = 'faq';

    // Specify the primary key
    protected $primaryKey = 'id_faq';

    // Fields that are mass assignable
    protected $fillable = ['judul_faq', 'isi_faq'];

    // Specify that primary key is auto-incrementing (default behavior in Laravel)
    public $incrementing = true;

    // Timestamps are enabled by default, so you don't need to specify
}
