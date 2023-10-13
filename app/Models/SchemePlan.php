<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static orderBy(string $string)
 */
class SchemePlan extends Model
{
    use HasFactory;
    // * Config
    protected $table = "scheme_plans";
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

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, "scheme_plans_posts");
    }
}
