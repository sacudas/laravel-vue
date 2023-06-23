<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description'
    ];

      /**
     * Get the parent imageable model (user or post).
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'model');
    }
}
