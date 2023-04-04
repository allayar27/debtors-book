<?php

namespace Database\Factories;

use App\Models\Debtor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebtorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Debtor::class;


    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->numberBetween('100', '9000'),
        ];
    }
}
