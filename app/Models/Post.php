<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // * Config
    protected $table = "posts";
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "tags_posts");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // * Methods

}
