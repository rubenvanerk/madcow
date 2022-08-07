<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Set extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @return BelongsTo<Workout, Set>
     */
    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
