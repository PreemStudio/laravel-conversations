<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
