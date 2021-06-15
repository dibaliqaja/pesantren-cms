<?php

namespace Database\Factories;

use App\Models\Cost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'            => Str::uuid(),
            'spp'           => 50000,
            'construction'  => 50000,
            'facilities'    => 50000,
            'wardrobe'      => 50000
        ];
    }
}
