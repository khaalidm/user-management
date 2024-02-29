<?php

namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date(),
            'language' => $this->faker->randomElement(['english', 'spanish', 'french', 'german', 'italian']),
            'interests' => $this->faker->randomElement(['hockey', 'guitar', 'reading', 'running', 'painting', 'tennis', 'chess']),
        ];
    }
}
