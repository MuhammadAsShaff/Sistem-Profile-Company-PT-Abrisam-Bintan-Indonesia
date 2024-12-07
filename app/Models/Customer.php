<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'nik',
        'nama_customer',
        'alamat_customer',
        'nomor_hp_customer',
        'email_customer',
        'status_customer',
        'jenis_kelamin',
        'provinsi',
        'latitude',
        'longitude',
        'kota',
        'kelurahan',
        'kode_pos',
    ];

    public $incrementing = true;
    // Timestamps are enabled by default, no need to specify

    // Relasi ke produk
    public function berlangganan()
    {
        return $this->hasMany(Berlangganan::class, 'id_customer');
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'berlangganan', 'id_customer', 'id_produk');
    }

}
