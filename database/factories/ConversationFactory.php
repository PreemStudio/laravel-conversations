<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use BombenProdukt\Conversations\Enum\ConversationPriority;
use BombenProdukt\Conversations\Enum\ConversationSubType;
use BombenProdukt\Conversations\Enum\ConversationType;
use BombenProdukt\Conversations\Models\Conversation;

/**
 * @extends Factory<Conversation>
 */
final class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'extra_attributes' => [
                'priority' => $this->faker->randomElement(ConversationPriority::values()),
                'subtype' => $this->faker->randomElement(ConversationSubType::values()),
                'type' => $this->faker->randomElement(ConversationType::values()),
            ],
        ];
    }
}
