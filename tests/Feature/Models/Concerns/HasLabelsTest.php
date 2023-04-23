<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use PreemStudio\Conversations\Models\Conversation;

it('can attach labels', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachLabel('Test Label 1');
    $model->attachLabels([
        'Test Label 2',
        'Test Label 3',
    ]);

    $labels = $model->labels();
    expect($labels->count())->toBe(3);
    expect($labels->pluck('name')->toArray())->toBe(['Test Label 1', 'Test Label 2', 'Test Label 3']);
});

it('can detach labels', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachLabel('Test Label 1');
    $model->attachLabels([
        'Test Label 2',
        'Test Label 3',
    ]);

    $labels = $model->labels();
    expect($labels->count())->toBe(3);
    expect($labels->pluck('name')->toArray())->toBe(['Test Label 1', 'Test Label 2', 'Test Label 3']);

    $model->detachLabels(['Test Label 2', 'Test Label 3']);

    $labels = $model->refresh()->labels();
    expect($labels->count())->toBe(1);
    expect($labels->pluck('name')->toArray())->toBe(['Test Label 1']);
});

it('can sync labels', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachLabel('Test Label 1');
    $model->attachLabels([
        'Test Label 2',
        'Test Label 3',
    ]);

    $labels = $model->labels();
    expect($labels->count())->toBe(3);
    expect($labels->pluck('name')->toArray())->toBe(['Test Label 1', 'Test Label 2', 'Test Label 3']);

    $model->syncLabels([
        'Test Label 2',
        'Test Label 3',
    ]);

    $labels = $model->refresh()->labels();
    expect($labels->count())->toBe(2);
    expect($labels->pluck('name')->toArray())->toBe(['Test Label 2', 'Test Label 3']);
});
