<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berlangganan extends Model
{
    protected $table = 'berlangganan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_customer',
        'id_produk',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
