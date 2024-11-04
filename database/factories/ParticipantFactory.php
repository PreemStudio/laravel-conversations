<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations\Database\Factories;

use BaseCodeOy\Conversations\Models\Conversation;
use BaseCodeOy\Conversations\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Tests\Fixtures\User;

/**
 * @extends Factory<Participant>
 */
final class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition()
    {
        return [
            'conversation_id' => Conversation::factory(),
            'model_id' => User::factory(),
            'model_type' => User::class,
        ];
    }

    /**
     * @return Factory<Participant>
     */
    public function conversation(Conversation $conversation): Factory
    {
        return $this->state(fn (): array => [
            'conversation_id' => $conversation->id,
        ]);
    }

    /**
     * @return Factory<Participant>
     */
    public function participant(Model $participant): Factory
    {
        return $this->state(fn (): array => [
            /** @phpstan-ignore-next-line */
            'model_id' => $participant->id,
            'model_type' => $participant::class,
        ]);
    }
}
