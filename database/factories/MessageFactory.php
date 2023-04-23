<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use PreemStudio\Conversations\Models\Conversation;
use PreemStudio\Conversations\Models\Message;
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
