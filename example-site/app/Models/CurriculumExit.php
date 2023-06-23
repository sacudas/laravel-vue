<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CurriculumExit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function curriculum(): HasOne
    {
        return $this->hasOne(Curriculum::class);
    }
}
