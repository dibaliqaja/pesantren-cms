<?php

namespace Database\Factories;

use App\Models\InMail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InMailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InMail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'            => Str::uuid(),
            'mail_number'   => $this->faker->numerify('0##').'/KOMPLEK-TENGAH/XI/'.$this->faker->year($max = 'now'),
            'mail_date'     => $this->faker->date('Y-m-d'),
            'note'          => $this->faker->text(50),
            'sender'        => $this->faker->unique()->name(),
            'recipient'     => $this->faker->unique()->name(),
            'record_date'   => $this->faker->date('Y-m-d'),
            // 'file_in'       => $this->faker->file(public_path('tmp'), public_path('storage/in-mail'), false),
        ];
    }
}
