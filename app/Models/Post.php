<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static findOrFail(string $id)
 * @method static create(array $array)
 * @property mixed $content
 */
class Post extends Model
{
    use HasFactory;

    // * Config
    /**
     * @var bool|mixed
     */
    protected $table = "posts";
    protected $primaryKey = "id";

    // * Mass Assignment
    protected $guarded = [];

    // * Data Protection
    protected $hidden = [];

    // * Data Formatting
    protected $casts = [];

    // * Accessors
    protected $appends = ["description"];

    public function getDescriptionAttribute(): string
    {
        return substr(preg_replace("/<img[^>]+\>/i", "", $this->content), 0, 150);
    }
    // * Mutators

    // * Relationships
    protected $with = [];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, "events_posts");
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, "locations_posts");
    }

    public function schemePlans(): BelongsToMany
    {
        return $this->belongsToMany(SchemePlan::class, "scheme_plans_posts");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // * Methods

}
