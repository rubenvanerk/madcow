<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dates = [
        'started_at',
        'completed_at',
    ];

    /**
     * @return HasMany<Set>
     */
    public function sets(): HasMany
    {
        return $this->hasMany(Set::class, 'workout_id');
    }
}
