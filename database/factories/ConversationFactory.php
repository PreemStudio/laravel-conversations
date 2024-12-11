<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Database\Factories;

use BaseCodeOy\Conversations\Enum\ConversationPriority;
use BaseCodeOy\Conversations\Enum\ConversationSubType;
use BaseCodeOy\Conversations\Enum\ConversationType;
use BaseCodeOy\Conversations\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

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
