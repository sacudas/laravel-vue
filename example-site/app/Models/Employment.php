<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'address'
    ];


    public function curriculum(): HasOne
    {
        return $this->hasOne(Curriculum::class);
    }
}
