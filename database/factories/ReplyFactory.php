<?php

namespace Database\Factories;

use App\Models\Flashcard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $flashcards = Flashcard::all()->pluck('id')->toArray();
        $random_flashcard_id = $this->faker->unique()->randomElement($flashcards);
        $random_flashcard = Flashcard::query()->find($random_flashcard_id);
        $boolean = $this->faker->boolean();

        if ($boolean) $text = $random_flashcard->answer;
        else $text = $this->faker->text;


        return [
            'flashcard_id' => $random_flashcard,
            'text' => $text,
            'is_correct' => $boolean
        ];
    }
}
