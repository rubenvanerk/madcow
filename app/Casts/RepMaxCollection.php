<?php

namespace App\Casts;

use App\Enums\Exercise;
use App\Values\RepMax;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RepMaxCollection implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array<string, mixed>  $attributes
     * @return Collection<string, RepMax>
     */
    public function get($model, string $key, $value, array $attributes): Collection
    {
        if (is_string($value)) {
            $data = json_decode($value, true);
        } else {
            $data = [];
        }

        $oneRepMaxes = is_array($data) ? collect($data) : collect([]);

        $oneRepMaxes = $oneRepMaxes->mapWithKeys(
            fn (array $oneRepMax): array => [$oneRepMax['exercise'] => new RepMax(
                Exercise::from($oneRepMax['exercise']),
                (int) $oneRepMax['weight'],
                (int) $oneRepMax['reps']
            )]
        );

        return $this->getDefaults()->merge($oneRepMaxes);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array<string, mixed>  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    /**
     * @return Collection<string, RepMax>
     */
    private function getDefaults(): Collection
    {
        return collect(Exercise::cases())
            ->mapWithKeys(fn (Exercise $exercise) => [$exercise->value => new RepMax($exercise, 0, 5)]);
    }
}
