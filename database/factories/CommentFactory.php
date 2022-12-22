<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Message;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'commentaire' => fake()->paragraph(),
            // 'image' => fake()->image(),
            'tags' => fake()->words(3, true),
            'message_id' => rand(1, Message::count()),
            'user_id' => rand(1, User::count())
        ];
    }
}
