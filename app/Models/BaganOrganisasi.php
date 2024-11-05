<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaganOrganisasi extends Model
{
    use HasFactory;

    /**
     * Define the table associated with the model.
     */
    protected $table = 'bagan';

    /**
     * Define the primary key of the table.
     */
    protected $primaryKey = 'id';

    /**
     * Specify the attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'title',
        'img_url',
        'parent_id'
    ];

    /**
     * Define the parent-child relationship.
     * Each position can have one parent and multiple children.
     */
    public function parent()
    {
        return $this->belongsTo(BaganOrganisasi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BaganOrganisasi::class, 'parent_id');
    }
}
