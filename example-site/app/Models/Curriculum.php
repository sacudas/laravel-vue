<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function curriculum_exit(): BelongsTo
    {
        return $this->belongsTo(CurriculumExit::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }


    public function employment(): BelongsTo
    {
        return $this->belongsTo(Employment::class);
    }
}
