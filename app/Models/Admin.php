<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
  use HasFactory;

  protected $table = 'admins';
  protected $primaryKey = 'id';
  public $incrementing = true;
  protected $keyType = 'int';

  public $timestamps = true;

  protected $fillable = ['email_admin', 'nama_admin', 'password', 'posisi', 'foto_admin', 'status'];

}
