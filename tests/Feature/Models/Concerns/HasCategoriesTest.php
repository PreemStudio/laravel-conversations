<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use BaseCodeOy\Conversations\Models\Conversation;

it('can attach categories', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachCategory('Test Category 1');
    $model->attachCategories(['Test Category 2', 'Test Category 3']);

    $categories = $model->categories();
    expect($categories->count())->toBe(3);
    expect($categories->pluck('name')->toArray())->toBe(['Test Category 1', 'Test Category 2', 'Test Category 3']);
});

it('can detach categories', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachCategory('Test Category 1');
    $model->attachCategories(['Test Category 2', 'Test Category 3']);

    $categories = $model->categories();
    expect($categories->count())->toBe(3);
    expect($categories->pluck('name')->toArray())->toBe(['Test Category 1', 'Test Category 2', 'Test Category 3']);

    $model->detachCategories(['Test Category 2', 'Test Category 3']);

    $categories = $model->refresh()->categories();
    expect($categories->count())->toBe(1);
    expect($categories->pluck('name')->toArray())->toBe(['Test Category 1']);
});

it('can sync categories', function (): void {
    $model = Conversation::factory()->create([]);

    $model->attachCategory('Test Category 1');
    $model->attachCategories(['Test Category 2', 'Test Category 3']);

    $categories = $model->categories();
    expect($categories->count())->toBe(3);
    expect($categories->pluck('name')->toArray())->toBe(['Test Category 1', 'Test Category 2', 'Test Category 3']);

    $model->syncCategories([
        'Test Category 2',
        'Test Category 3',
    ]);

    $categories = $model->refresh()->categories();
    expect($categories->count())->toBe(2);
    expect($categories->pluck('name')->toArray())->toBe(['Test Category 2', 'Test Category 3']);
});
