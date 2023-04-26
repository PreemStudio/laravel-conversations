<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use BombenProdukt\Conversations\Enum\ConversationPriority;
use BombenProdukt\Conversations\Models\Conversation;

it('gets priority from extra attributes', function (): void {
    $model = Conversation::factory()->create([
        'extra_attributes' => [
            'priority' => ConversationPriority::NORMAL,
        ],
    ]);

    expect($model->getPriority())->toBe(ConversationPriority::NORMAL);
});

it('sets priority in extra attributes', function (): void {
    $model = Conversation::factory()->create(['extra_attributes' => []]);

    $model->setPriority(ConversationPriority::HIGH);

    expect($model->getPriority())->toBe(ConversationPriority::HIGH);
});
