<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationSeverity;
use BaseCodeOy\Conversations\Models\Conversation;

it('gets severity from extra attributes', function (): void {
    $model = Conversation::factory()->create([
        'extra_attributes' => [
            'severity' => ConversationSeverity::SEV3,
        ],
    ]);

    expect($model->getSeverity())->toBe(ConversationSeverity::SEV3);
});

it('sets severity in extra attributes', function (): void {
    $model = Conversation::factory()->create(['extra_attributes' => []]);

    $model->setSeverity(ConversationSeverity::SEV3);

    expect($model->getSeverity())->toBe(ConversationSeverity::SEV3);
});
