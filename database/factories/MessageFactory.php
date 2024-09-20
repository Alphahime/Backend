<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'contenu' => $this->faker->text,
            'date_envoie' => now(),
            'date_mise_a_jour' => now(),
        ];
    }
}
