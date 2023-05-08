<?php

namespace Database\Factories;

use App\Models\CashBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashBook>
 */
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'date' => Carbon::now(),
            'note' => $this->faker->sentence(5),
            'debit' => $this->faker->randomFloat(2, 10, 100),
            'credit' => $this->faker->randomFloat(2, 10, 100),
            'registration_cost_id' => null,
            'syahriah_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
