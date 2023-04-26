<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Message;
use Tests\Fixtures\User;

/**
 * @extends Factory<Message>
 */
final class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'conversation_id' => Conversation::factory(),
            'author_id' => User::factory(),
            'author_type' => User::class,
            'body' => $this->faker->text(),
        ];
    }

    /**
     * @return Factory<Message>
     */
    public function author(Model $author): Factory
    {
        return $this->state(fn (): array => [
            /** @phpstan-ignore-next-line */
            'author_id' => $author->id,
            'author_type' => $author::class,
        ]);
    }

    /**
     * @return Factory<Message>
     */
    public function conversation(Conversation $conversation): Factory
    {
        return $this->state(fn (): array => [
            'conversation_id' => $conversation->id,
        ]);
    }
}
