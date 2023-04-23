<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use PreemStudio\Conversations\Enum\ConversationSubType;
use PreemStudio\Conversations\Enum\ConversationType;
use PreemStudio\Conversations\Models\Conversation;

it('gets type from extra attributes', function (): void {
    $model = Conversation::factory()->create([
        'extra_attributes' => [
            'type' => ConversationType::TICKET,
        ],
    ]);

    expect($model->getType())->toBe(ConversationType::TICKET);
});

it('sets type in extra attributes', function (): void {
    $model = Conversation::factory()->create(['extra_attributes' => []]);

    $model->setType(ConversationType::TICKET);

    expect($model->getType())->toBe(ConversationType::TICKET);
});

it('gets subtype from extra attributes', function (): void {
    $model = Conversation::factory()->create([
        'extra_attributes' => [
            'subtype' => ConversationSubType::QUESTION,
        ],
    ]);

    expect($model->getSubType())->toBe(ConversationSubType::QUESTION);
});

it('sets subtype in extra attributes', function (): void {
    $model = Conversation::factory()->create(['extra_attributes' => []]);

    $model->setSubType(ConversationSubType::QUESTION);

    expect($model->getSubType())->toBe(ConversationSubType::QUESTION);
});
