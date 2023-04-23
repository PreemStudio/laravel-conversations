<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PreemStudio\Conversations\Enum\ConversationPriority;
use PreemStudio\Conversations\Enum\ConversationSubType;
use PreemStudio\Conversations\Enum\ConversationType;
use PreemStudio\Conversations\Models\Conversation;

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
