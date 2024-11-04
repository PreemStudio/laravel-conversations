<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationStatus;
use BaseCodeOy\Conversations\Models\Conversation;

it('gets state from status', function (): void {
    $model = Conversation::factory()->create([]);
    $model->setState(ConversationStatus::WAITING_FOR_CUSTOMER);

    expect($model->getState())->toBe(ConversationStatus::WAITING_FOR_CUSTOMER);
});

it('sets state as status', function (): void {
    $model = Conversation::factory()->create([]);

    $model->setState(ConversationStatus::WAITING_FOR_CUSTOMER, 'Test reason');

    $status = $model->status();
    expect($status->name)->toBe(ConversationStatus::WAITING_FOR_CUSTOMER->value);
    expect($status->reason)->toBe('Test reason');
});
