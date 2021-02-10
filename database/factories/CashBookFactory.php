<?php

namespace Database\Factories;

use App\Models\CashBook;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CashBookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'        => Str::uuid(),
            'date'      => $this->faker->date('Y-m-d'),
            'note'      => $this->faker->unique()->text,
            'debit'     => $this->faker->unique()->numberBetween(500, 1000000000),
            'credit'    => $this->faker->unique()->numberBetween(500, 1000000000),
            'total'     => $this->faker->unique()->numberBetween(500, 9999999999)
        ];
    }
}
