<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flashcard>
 */
class FlashcardFactory extends Factory
{

    public function definition()
    {
        return [
            'question' => $this->faker->text(10),
            'answer' => $this->faker->name
        ];
    }
}
