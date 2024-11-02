<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'id_blog';

    protected $fillable = [
        'judul_blog',
        'isi_blog',
        'gambar_cover',
        'tanggal_penulisan',
        'kategori',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            if (!$blog->slug || $blog->isDirty('judul_blog')) {
                $blog->slug = Str::slug($blog->judul_blog);

                $originalSlug = $blog->slug;
                $counter = 1;

                while (static::where('slug', $blog->slug)->exists()) {
                    $blog->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }
}
