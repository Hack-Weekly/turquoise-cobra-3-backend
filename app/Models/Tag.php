<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    // * Config
    protected $table = "tags";
    protected $primaryKey = "id";

    // * Mass Assignment
    protected $guarded = [];

    // * Data Protection
    protected $hidden = [];

    // * Data Formatting
    protected $casts = [];

    // * Accessors

    // * Mutators

    // * Relationships
    protected $with = [];

    // public function posts()
    // {
    //     return $this->hasManyThrough(Posts::class, "tags_posts");
    // }
    public function posts()
    {
        return $this->belongsToMany(Post::class, "tags_posts");
    }

    // * Methods

}
