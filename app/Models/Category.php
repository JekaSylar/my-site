<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'slug', 'description', 'meta_description', 'meta_keywords'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->meta_description)) {
                $category->meta_description = $category->description;
            }

            if (empty($category->meta_keywords)) {
                $category->meta_keywords = $category->name;
            }
        });
    }
}
